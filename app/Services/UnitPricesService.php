<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\Constants\Languages;
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

        $response = self::getTranslation()['header'][$session->language]."\n";

        $unitPrices = UnitPrice::all();
        $i = 1;
        foreach ($unitPrices as $unit) {
            $response .= $i . ". " . $helper->convert($currency, ($unit->min / 1000) * $session->unitOfSale->value) . "-"
                . $helper->convert($currency, ($unit->max / 1000) * $session->unitOfSale->value)
                . " " . $currency . "\n";
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

    public static function getTranslation()
    {
        return [
            'header' => [
                Languages::ENGLISH => 'How much (in NGN) do you sell a ton/kg/(50kg/100kg) bag of cassava roots?',
                Languages::YORUBA => 'Naira melo ni ton/kg/ apo (50kg/100kg) ege kan?',
                Languages::IBO => 'Ego ole (na naira) bu tonne/ kg/akpa 50kg/akpa 100kg akpu?'
            ]
        ];
    }
}