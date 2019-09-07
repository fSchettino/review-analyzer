<?php

namespace App\Modules\Review;

use App\Modules\Hotel\Interfaces\HotelServiceInterface;
use App\Modules\Rule\Interfaces\RuleServiceInterface;

class ReviewAnalyzer
{
    public function __construct(HotelServiceInterface $hotelServiceInterface, RuleServiceInterface $ruleServiceInterface)
    {
        $this->hotelServiceInterface = $hotelServiceInterface;
        $this->ruleServiceInterface = $ruleServiceInterface;
    }

    // Semantic analysis algorithm
    public function calculateScore($hotelId, $reviewTitle, $reviewDescription)
    {
        // Get hotel info
        $hotelInfo = $this->hotelServiceInterface->find($hotelId);

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
                $ruleInfo = $this->ruleServiceInterface->find($rule->id);
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
                                        $phraseScore-= $negativeScore;
                                    }
                                    $tempScoreCount = 0;
                                }
                            }
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
            } else {
                // If phrase contains more than 1 positive keywords add +2 points to review score for curren phrase
                if ($positiveWordCount > 1) {
                    $positiveScore+= $bonusScore;
                    $reviewScore+= $positiveScore;
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
