<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/4/18
 * Time: 9:47 AM
 */

namespace App\Services;


use App\FertilizerPriceRange;
use App\PriceRange;

class PriceRangeService
{
    public static function getRanges(FertilizerPriceRange $fertilizerPriceRange)
    {
        $response = "State the price of " . $fertilizerPriceRange->fertilizer->name . " if available ".$fertilizerPriceRange->fertilizer->id.".\n";

        $pricesRanges = PriceRange::all();
        $i = 1;
        foreach ($pricesRanges as $range) {
            $response .= $i . ". " . $range->min . "-" . $range->max . " USD per 50kg bag\n";
            $i++;
        }

        return $response;

    }

    public static function isValidPriceRange($priceRange)
    {
        return is_numeric($priceRange) && $priceRange < PriceRange::count();
    }

    /**
     * @param FertilizerPriceRange $fertilizerPriceRange
     * @param int $selectedOption
     */
    public static function setRange($fertilizerPriceRange, $selectedOption)
    {
        $range = PriceRange::all()[$selectedOption - 1];
        $fertilizerPriceRange->price_range_id = $range->id;
        $fertilizerPriceRange->save();
    }
}