<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\UnitPrice;
use App\USSDSession;

class UnitPricesService
{
    public static function getUnits()
    {
        $response = "State the unit price\n";

        $unitPrices = UnitPrice::all();
        $i = 1;
        foreach ($unitPrices as $unit) {
            $response .= $i.". ".$unit->min . "-" . $unit->max . " Per tonne."."\n";
            $i++;
        }

        return $response;

    }

    public static function setUnit(USSDSession $session, $selectedOption)
    {
        $unitsPrices = UnitPrice::all();
        if (is_numeric($selectedOption) && $selectedOption > 0 && $selectedOption <= sizeof($unitsPrices)) {
            $unit = $unitsPrices[$selectedOption - 1];
            $session->unit_price_id = $unit->id;
            $session->save();
            return true;
        }
        return false;
    }
}