<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/13/18
 * Time: 10:37 AM
 */

namespace App\Helpers;


class CurrencyHelper
{
    protected $TZS = 2250;
    protected $NGN = 360;

    public function convert($currency, $amount){
        switch ($currency){
            case "TZS":
                $factor = $this->TZS;
                break;
            case "NGN":
                $factor = $this->NGN;
                break;
            default:
                $factor = 1;
                break;
        }

        return $amount * $factor;
    }

    public function getCurrency($phone){
        if($phone&&sizeof($phone>5)){
            $count = $phone[0] =='+'?1:0;
            $countryCode = substr($phone, $count, 3);
            switch ($countryCode){
                case "255":
                    return "TZS";
                case "234":
                    return "NGN";
            }
        }
        return "USD";
    }

}