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
    protected $precision = 3;

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

        $amount = (int)ceil($amount * $factor);
        return number_format($amount);
/*
        if($amount >= 10000)
            $this->precision = 3;
        elseif ($amount >= 1000)
            $this->precision = 2;
        else
            $this->precision = -1;

        return   number_format(abs(round((($amount) - 50), -1*$this->precision)));*/
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
        return "NGN";
    }

}