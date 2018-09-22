<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\Helpers\CurrencyHelper;
use App\UnitPrice;
use App\USSDSession;

class UnitPricesService
{
    public static function getUnits(USSDSession $session)
    {
        #currency math
        $helper = new CurrencyHelper();
        $currency = $helper->getCurrency($session->phone_no);

        $response = " At what price do you sell a ".$session->unitOfSale->display." of cassava roots?\n";

        $unitPrices = UnitPrice::all();
        $i = 1;
        foreach ($unitPrices as $unit) {
            $response .= $i.". ". $helper->convert($currency, ($unit->min/1000)*$session->unitOfSale->value) . "-"
                . $helper->convert($currency, ($unit->max/1000)*$session->unitOfSale->value)
                . " ".$currency."\n";
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