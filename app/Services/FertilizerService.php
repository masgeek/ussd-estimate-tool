<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\Constants\Languages;
use App\Fertilizer;
use App\FertilizerPriceRange;
use App\Helpers\CurrencyHelper;
use App\PriceRange;
use App\USSDSession;

class FertilizerService
{
    public static function getFertilizer(USSDSession $session, $index)
    {
        #currency math
        $helper = new CurrencyHelper();

        #Get the fertilizer
        $fertilizer = self::getFertilizers($session->currency)[$index - 1];

        #Build response
        $response = self::getTranslation()['header'][$session->language];
        #Replace [FERT] with fertilizer name
        $response = str_replace('[FERT]',$fertilizer->name,$response)."\n";

        #Add first option
        $response .= "1. ".self::getTranslation()['first_option'][$session->language]."\n";
        $pricesRanges = PriceRange::all();
        $i = 2;
        foreach ($pricesRanges as $range) {
            $response .= $i . ". " . $helper->convert($session->currency, $range->min) . "-"
                . $helper->convert($session->currency, $range->max)
                . " " . $session->currency . "\n";
            $i++;
        }
        $response .= $i .". ".self::getTranslation()['last_option'][$session->language]."\n";

        return $response;

    }

    public static function getFertilizers($currency)
    {
        return Fertilizer::whereAvailability("*")->orWhere("availability", substr($currency, 0, 2))->get();
    }

    public static function setFertilizer(USSDSession $session, $selectedFertilizerId, $selectedOption)
    {
        if (self::isValidOption($selectedOption)) {

            #Get selected fertilizer
            $selectedFertilizer = self::getFertilizers($session->currency)[$selectedFertilizerId - 1];

            //get fertilizer price range
            $fertilizerPriceRange = FertilizerPriceRange::whereFertilizerId($selectedFertilizer->id)
                ->where("session_id", $session->id)
                ->first();

            $priceRanges = PriceRange::all();

            if ($selectedOption == $priceRanges->count() + 2) {
                #delete if it exists
                if ($fertilizerPriceRange)
                    $fertilizerPriceRange->delete();
            } else {

                if (!$fertilizerPriceRange)
                    $fertilizerPriceRange = new FertilizerPriceRange();

                #set defaults
                $fertilizerPriceRange->session_id = $session->id;
                $fertilizerPriceRange->fertilizer_id = $selectedFertilizer->id;

                #add to fertilizer price range uf selected
                if ($selectedOption > 1) {
                    $range = $priceRanges[$selectedOption - 2];
                    $fertilizerPriceRange->price_range_id = $range->id;
                }

                #save
                $fertilizerPriceRange->save();

            }

            return true;
        }
        return false;
    }

    public static function isValidOption($selectedOption)
    {
        return is_numeric($selectedOption) && $selectedOption >= 1 && $selectedOption <= PriceRange::count() + 2;
    }

    public static function getCount($currency)
    {
        return Fertilizer::whereAvailability("*")->orWhere("availability", substr($currency, 0, 2))->count();
    }

    private static function getTranslation()
    {
        return [
            'header' => [
                Languages::ENGLISH => 'How much (in NGN) is a 50kg bag of [FERT] at your local agro-dealer?',
                Languages::YORUBA => 'Naira melo ni ajile [FERT] apo 50kg ni agbegbe yin?',
                Languages::IBO => 'Ego ole (na naira) bu akpa ntuezi [FERT] 50kg n’ime obodo gi?'
            ],
            'first_option' => [
                Languages::ENGLISH => 'I am not sure',
                Languages::YORUBA => 'Ko da mi loju',
                Languages::IBO => 'Odoghi m anya'
            ],
            'last_option' => [
                Languages::ENGLISH => 'The fertilizer is not available',
                Languages::YORUBA => 'Ko si ajile yi ni agbegbe mi',
                Languages::IBO => 'Anaghi enweta udi ntuezi bekeea'
            ]
        ];
    }
}