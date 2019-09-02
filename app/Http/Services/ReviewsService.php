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
        // Process review text data (title and description) and store each word as an array item
        $reviewTextData = $reviewTitle . ' ' . $reviewDescription;
        $specialChars = ['  ', ' ', ';', ',', ':', '|', '!', '¡', '"', '\'', '£', '$', '%', '&', '/', '\\', '(', ')', '=', '?', '¿', '*', '+', '-', '@', '€', '<', '>', '-', '_', '#', '°', '[', ']', '{', '}', '§', '`'];
        $reviewTextDataProcessingStep1 = str_replace($specialChars, ' ', $reviewTextData);
        $reviewTextDataProcessingStep2 = str_replace('  ', ' ', $reviewTextDataProcessingStep1);
        $reviewTextDataProcessed = explode(' ', $reviewTextDataProcessingStep2);

        // Get hotel info
        $hotelInfo = $this->hotelsServiceClass->show($hotelId);

        // Define analysis counters and variables
        $serviceMatch = false;
        $positiveWordCount = 0;
        $negativeWordCount = 0;
        $tempScoreCount = 0;
        $positiveScore = 0;
        $negativeScore = 0;
        $reviewScore = 0;

        // Analyze review text based on hotel rules
        foreach ($hotelInfo->rules as $rule) {
            $ruleInfo = $this->rulesServiceClass->show($rule->id);
            $ruleService = strtolower($ruleInfo->service->name);

            // Check if rule service appears in the review
            foreach ($reviewTextDataProcessed as $word) {
                if ($ruleService != strtolower($word)) {
                    $serviceMatch = false;
                } else {
                    $serviceMatch = true;
                    // If rule service appears in the review, get rule keywords info
                    foreach ($ruleInfo->keywords as $keyword) {
                        $keywordType = $keyword->type;
                        $keywordName = strtolower($keyword->name);
                        $keywordWeight = $keyword->weight;

                        // Scan review looking for current keyword
                        foreach ($reviewTextDataProcessed as $word) {
                            if ($keywordName == strtolower($word)) {
                                $tempScoreCount+= $keywordWeight;

                                if ($keywordType == 'positive') {
                                    $positiveWordCount+= 1;
                                    $positiveScore+= $tempScoreCount;
                                } elseif ($keywordType == 'negative') {
                                    $negativeWordCount+= 1;
                                    $negativeScore+= $tempScoreCount;
                                }
                            }
                            $tempScoreCount = 0;
                        }
                    }
                    // Break scan and follow with next rule service
                    break;
                }
            }
        }

        // If review contains both positive and negative Keywords review score is set to 0
        // and review is declared null witch means that deosn't will be taked into account during
        // hotel average score calculation
        if (($positiveScore >= 1) && ($negativeScore >= 1)) {
            $reviewScore = 0;
            return $reviewScore;
        }

        if ($positiveWordCount > 1) {
            $positiveScore+= 2;
        }
        if ($negativeWordCount > 1) {
            $negativeScore+= 2;
        }

        $reviewScore = $positiveScore - $negativeScore;
        
        return $reviewScore;
    }
}
