<?php

namespace App\Http\Services;

use App\Http\Models\Review;
use App\Http\Services\HotelsService;
use App\Http\Services\RulesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsService
{
    protected $reviewModel;
    protected $hotelsServiceClass;
    protected $rulesServiceClass;

    public function __construct()
    {
        $this->reviewModel = new Review();
        $this->hotelsServiceClass = new HotelsService();
        $this->rulesServiceClass = new RulesService();
    }

    // Add a hotel review
    public function add(Request $request)
    {
        try {
            $this->reviewModel->hotel_id = $request->hotelId;
            $this->reviewModel->title = $request->title;
            $this->reviewModel->description = $request->description;
            $this->reviewModel->score = $this->analyzeReview($request->hotelId, $request->title, $request->description);
            $this->reviewModel->save();

            // update hotel score
            $this->hotelsServiceClass->updateHotelScore($this->reviewModel->hotel_id);
            
            return 'Review inserted';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    // Delete a hotel review
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $review = $this->reviewModel->find($id);
            $review->delete();
            DB::commit();

            // update hotel score
            $this->hotelsServiceClass->updateHotelScore($review->hotel->id);

            return 'Review deleted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    // Semantic analysis algorithm
    public function analyzeReview($hotelId, $reviewTitle, $reviewDescription)
    {
        // Get hotel info
        $hotelInfo = $this->hotelsServiceClass->show($hotelId);

        // Define analysis counters and variables
        $serviceMatch = false;
        $positiveWordCount = 0;
        $negativeWordCount = 0;
        $tempScoreCount = 0;
        $positiveScore = 0;
        $negativeScore = 0;
        $phraseScore = 0;
        $reviewScore = 0;
        $bonusScore = 2;
        $specialChars = ['  ', ' ', ';', ',', ':', '|', '!', '¡', '"', '\'', '£', '$', '%', '&', '/', '\\', '(', ')', '=', '?', '¿', '*', '+', '-', '@', '€', '<', '>', '-', '_', '#', '°', '[', ']', '{', '}', '§', '`'];

        // Split review text data (title and description) generating an array of phrases
        $reviewTextData = $reviewTitle . '. ' . $reviewDescription;
        $reviewPhrases = \preg_split('/[.]/', $reviewTextData);

        // Process each phrase and generate an array of words
        foreach ($reviewPhrases as $phrase) {
            $phraseStr = $phrase;
            $phraseStrProcessingStep1 = str_replace($specialChars, ' ', $phraseStr);
            $phraseStrProcessingStep2 = str_replace('  ', ' ', $phraseStrProcessingStep1);
            $phraseStrProcessed = explode(' ', $phraseStrProcessingStep2);

            // Analyze phrase based on hotel rules
            foreach ($hotelInfo->rules as $rule) {
                $ruleInfo = $this->rulesServiceClass->show($rule->id);
                $ruleService = strtolower($ruleInfo->service->name);

                // Check if rule service appears in the phrase
                foreach ($phraseStrProcessed as $word) {
                    if ($ruleService != strtolower($word)) {
                        $serviceMatch = false;
                    } else {
                        $serviceMatch = true;
                        // If rule service appears in the phrase, get rule keywords info
                        foreach ($ruleInfo->keywords as $keyword) {
                            $keywordType = $keyword->type;
                            $keywordName = strtolower($keyword->name);
                            $keywordWeight = $keyword->weight;

                            // Scan phrase looking for current keyword
                            foreach ($phraseStrProcessed as $word) {
                                if ($keywordName == strtolower($word)) {
                                    $tempScoreCount+= $keywordWeight;
                                    if ($keywordType == 'positive') {
                                        $positiveWordCount+= 1;
                                        $positiveScore+= $tempScoreCount;
                                        $phraseScore+= $positiveScore;
                                    } elseif ($keywordType == 'negative') {
                                        $negativeWordCount+= 1;
                                        $negativeScore+= $tempScoreCount;
                                        $phraseScore-= $positiveScore;
                                    }
                                    $tempScoreCount = 0;
                                }
                            }
                            // echo('positive score: ' . $positiveScore . '<br>');
                            // echo('negative score: ' . $negativeScore . '<br>');
                        }
                    }
                }
            }
            // If phrase contains both positive and negative keywords phrase is declared null
            if (($positiveWordCount >= 1) && ($negativeWordCount >= 1)) {
                $phraseScore = 0;
                $positiveWordCount = 0;
                $negativeWordCount = 0;
                $positiveScore = 0;
                $negativeScore = 0;
            // echo('both positive and negative keywords' . '<br>');
            } else {
                // If phrase contains more than 1 positive keywords add +2 points to review score for curren phrase
                if ($positiveWordCount > 1) {
                    $positiveScore+= $bonusScore;
                    $reviewScore+= $positiveScore;
                    // echo('positive bonus added - positive score: ' . $positiveScore . '<br>');
                    $phraseScore = 0;
                    $positiveWordCount = 0;
                    $negativeWordCount = 0;
                    $positiveScore = 0;
                    $negativeScore = 0;
                }
                // If phrase contains more than 1 negative keywords decrease -2 points from review score for curren phrase
                if ($negativeWordCount > 1) {
                    $negativeScore+= $bonusScore;
                    $reviewScore-= $negativeScore;
                    // echo('negative bonus added - negative score: ' . $negativeScore . '<br>');
                    $phraseScore = 0;
                    $positiveWordCount = 0;
                    $negativeWordCount = 0;
                    $positiveScore = 0;
                    $negativeScore = 0;
                }
            }
            $reviewScore+= $phraseScore;
            $phraseScore = 0;
        }
        return $reviewScore;
    }
}
