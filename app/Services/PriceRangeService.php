<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/4/18
 * Time: 9:47 AM
 */

namespace App\Services;


use App\FertilizerPriceRange;
use App\Helpers\CurrencyHelper;
use App\PriceRange;
use App\USSDSession;

class PriceRangeService
{
    public static function getRanges(USSDSession $session, $index)
    {
        $fertilizerPriceRange = FertilizerPriceRange::whereSessionId($session->id)->get()[$index - 1];
        $response = "State the price of " . $fertilizerPriceRange->fertilizer->name . " if available.\n";
        #Add the first option
        $response.= "1. Available but I do not know the price \n";

        #currency math
        $helper = new CurrencyHelper();
        $currency = $helper->getCurrency($session->phone_no);

        $pricesRanges = PriceRange::all();
        $i = 2;
        foreach ($pricesRanges as $range) {
            $response .= $i . ". " . $helper->convert($currency, $range->min) . "-"
                . $helper->convert($currency, $range->max)
                . " ".$currency." per 50kg bag\n";
            $i++;
        }

        return $response;

    }

    /**
     * @param int $fertilizerPriceRangeIndex
     * @param USSDSession $session
     * @param int $selectedOption
     * @return bool
     */
    public static function setRange($fertilizerPriceRangeIndex, $session, $selectedOption)
    {
        if (self::isValidPriceRange($selectedOption)) {
            $fertilizerPriceRange = self::getFertilizerPriceRange($session, $fertilizerPriceRangeIndex);
            if($selectedOption > 1){
                $range = PriceRange::all()[$selectedOption - 2];
                $fertilizerPriceRange->price_range_id = $range->id;
            }else{
                $fertilizerPriceRange->price_range_id = null;
            }
            $fertilizerPriceRange->save();
            return true;
        }
        return false;
    }

    public static function isValidPriceRange($selectedOption)
    {
        #PriceRange::count()+1 :=> To cater for the first option
        return is_numeric($selectedOption) && $selectedOption > 0 && $selectedOption <= (PriceRange::count()+1);
    }

    public static function getAvailableFertilizerCount(USSDSession $session)
    {
        return FertilizerPriceRange::whereSessionId($session->id)->count();
    }

    private static function getFertilizerPriceRange(USSDSession $session, $index)
    {
        $fertilizers = FertilizerPriceRange::whereSessionId($session->id)->get();
        if ($index > 0 && $index <= sizeof($fertilizers)) {
            return $fertilizers[$index - 1];
        }
        return null;
    }


}