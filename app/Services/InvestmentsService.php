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
use App\Investment;
use App\USSDSession;

class InvestmentsService
{
    public static function getInvestments(USSDSession $session)
    {
        $response = self::getTranslations()['header'][$session->language] . "\n";
        $response = str_replace('[AREA]', $session->fieldArea->display, $response);

        #currency math
        $helper = new CurrencyHelper();
        $currency = $helper->getCurrency($session->phone_no);

        $investments = Investment::all();;
        $i = 1;
        foreach ($investments as $investment) {
            $response .= $i . ". " . $helper->convert($currency, ($investment->amount * $session->fieldArea->value))
                . " " . $currency . "\n";
            $i++;
        }

        return $response;

    }

    private static function getTranslations()
    {
        return [
            'header' => [
                Languages::ENGLISH => 'How much are you willing to invest in fertilizer for this cassava field of [AREA]?',
                Languages::YORUBA => 'Naira melo ni o n gbero lati na si ori ajile ni ori oko yii?',
                Languages::IBO => 'Ego ole ka I di njikere itinye na ntuezi bekee maka ubi akpu a?'
            ]
        ];
    }

    public static function setInvestment(USSDSession $session, $selectedOption)
    {
        $investments = Investment::all();;
        if (is_numeric($selectedOption) && $selectedOption > 0 && $selectedOption <= sizeof($investments)) {
            $investment = $investments[$selectedOption - 1];
            $session->investment_id = $investment->id;
            $session->save();
            return true;
        }
        return false;
    }
}