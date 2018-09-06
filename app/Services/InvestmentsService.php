<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\Investment;
use App\USSDSession;

class InvestmentsService
{
    public static function getInvestments()
    {
        $response = "State the Maximal investment\n";

        $investments = Investment::all();;
        $i = 1;
        foreach ($investments as $investment) {
            $response .= $i . ". " . $investment->amount . " USD per acre" . "\n";
            $i++;
        }

        return $response;

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