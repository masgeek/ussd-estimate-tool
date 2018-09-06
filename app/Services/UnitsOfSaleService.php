<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\UnitOfSale;
use App\USSDSession;

class UnitsOfSaleService
{
    public static function getUnits()
    {
        $response = "State the unit of sale\n";

        $unitsOfSale = UnitOfSale::all();
        $i = 1;
        foreach ($unitsOfSale as $unit) {
            $response .= $i . ". " . "Per " . $unit->display . "\n";
            $i++;
        }

        return $response;

    }

    public static function setUnit(USSDSession $session, $selectedOption)
    {
        $unitsOfSale = UnitOfSale::all();;
        if (is_numeric($selectedOption) && $selectedOption > 0 && $selectedOption <= sizeof($unitsOfSale)) {
            $unit = $unitsOfSale[$selectedOption - 1];
            $session->unit_of_sale_id = $unit->id;
            $session->save();
            return true;
        }
        return false;
    }
}