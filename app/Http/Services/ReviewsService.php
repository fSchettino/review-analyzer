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

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $review = $this->reviewModel->find($id);
            $review->delete();
            DB::commit();

            return 'Review deleted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function analyzeReview($hotelId, $reviewTitle, $reviewDescription)
    {
        // Process review text data and store each word as an array item
        $reviewTextData = $reviewTitle . ' ' . $reviewDescription;
        $reviewTextDataProcessingStep1 = str_replace(['  ', ' ', ';', ',', ':'], ' ', $reviewTextData);
        $reviewTextDataProcessingStep2 = str_replace('  ', ' ', $reviewTextDataProcessingStep1);
        $reviewTextDataProcessed = explode(' ', $reviewTextDataProcessingStep2);

        // Get hotel info
        $hotelInfo = $this->hotelsServiceClass->show($hotelId);

        // Define analysis counters
        $serviceMatch = false;
        $positiveWordCount = 0;
        $negativeWordCount = 0;
        $tempScoreCount = 0;
        $positiveScore = 0;
        $negativeScore = 0;
        $reviewScore = 0;

        // Analyze review text base on hotel rules
        foreach ($hotelInfo->rules as $rule) {
            $ruleInfo = $this->rulesServiceClass->show($rule->id);
            $ruleService = strtolower($ruleInfo->service->name);

            // Check if hotel service appears in the review text data
            foreach ($reviewTextDataProcessed as $word) {
                if ($ruleService != strtolower($word)) {
                    $serviceMatch = false;
                } else {
                    $serviceMatch = true;
                    // Get rule info
                    foreach ($ruleInfo->keywords as $keyword) {
                        $keywordType = $keyword->type;
                        $keywordName = strtolower($keyword->name);
                        $keywordWeight = $keyword->weight;
                        echo('keywordType: ' . $keywordType . '<br>');

                        // scan review text data looking for rule keywords
                        foreach ($reviewTextDataProcessed as $word) {
                            if ($keywordName == strtolower($word)) {
                                $tempScoreCount+= $keywordWeight;
                            }

                            if ($keywordType == 'positive') {
                                $positiveWordCount+= 1;
                                $positiveScore+= $tempScoreCount;
                                $tempScoreCount = 0;
                            } elseif ($keywordType == 'negative') {
                                $negativeWordCount+= 1;
                                $negativeScore+= $tempScoreCount;
                                $tempScoreCount = 0;
                            }
                        }
                    }
                    // Break scan and pass to next service
                    break;
                }
            }
        }

        if ($positiveWordCount > 1) {
            $positiveScore+= 2;
        }
        if ($negativeWordCount > 1) {
            $negativeScore+= 2;
        }
        echo('Positive score: ' . $positiveScore . '<br>');
        echo('Negative score: ' . $negativeScore . '<br>');

        $reviewScore = $positiveScore - $negativeScore;

        echo('Review score: ' . $reviewScore . '<br>');
        
        return $reviewScore;
    }
}
