<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/2/18
 * Time: 6:32 PM
 */

namespace App\Constants;


abstract class DefaultData
{
    const PLANTING_DATES = [
        ["display" => "2-4 weeks ago", "value" => "-3"],
        ["display" => "1-2 weeks ago", "value" => "-1"],
        ["display" => "This week", "value" => "0"],
        ["display" => "In 1-2 weeks", "value" => "1"],
        ["display" => "In 2-4 weeks", "value" => "2"]
    ];

    const FIELD_AREAS = [
        ["display" => "0.25 acre (0.1ha)", "value" => "0.25"],
        ["display" => "0.5 acre (0.2ha)", "value" => "0.5"],
        ["display" => "1 acre (0.4ha)", "value" => "1"],
        ["display" => "2.5 acre (1ha)", "value" => "2.5"],
    ];


    const  HARVESTING_QUANTITY= [
        ["display" => "< 4", "value" => "37"],
        ["display" => "4-8", "value" => "46"],
        ["display" => "8-12", "value" => "52"],
        ["display" => "12-16", "value" => "59"],
        ["display" => "> 16", "value" => "67"]
    ];


    const FERTILIZERS = [
        ["name" => "Urea", "availability" => "*"],
        ["name" => "NPK15:15:15", "availability" => "NG"],
        ["name" => "MOP", "availability" => "*"]
        /*["name" => "NPK17:17:17","availability"=>"*"],
        ["name" => "NPK20:10:10","availability"=>"NG"],
        ["name" => "TSP","availability"=>"*"],
        ["name" => "DAP","availability"=>"*"],
        ["name" => "SSP","availability"=>"NG"],
        ["name" => "CAN","availability"=>"*"],
        ["name" => "Nafaka plus","availability"=>"*"],*/
    ];

    const PRICE_RANGES = [
        ["min" => "6000", "max" => "10000", "value" => "0.5"],
        ["min" => "10000", "max" => "14000", "value" => "0.7"],
        ["min" => "14000", "max" => "18000", "value" => "0.9"],
        ["min" => "18000", "max" => "22000", "value" => "1.1"],
        ["min" => "22000", "max" => "26000", "value" => "1.1"],
        ["min" => "26000", "max" => "30000", "value" => "1.1"]
    ];

    const UNITS_OF_SALE = [
        ["display" => "tonne", "value" => "1000"],
        ["display" => "kg", "value" => "1"],
        ["display" => "50 kg bag", "value" => "50"],
        ["display" => "100 kg bag", "value" => "100"],

    ];

    const UNIT_PRICES = [
        ["min" => "5000", "max" => "10000", "value" => "25"],
        ["min" => "10000", "max" => "15000", "value" => "40"],
        ["min" => "15000", "max" => "20000", "value" => "75"],
        ["min" => "20000", "max" => "25000", "value" => "125"],
        ["min" => "25000", "max" => "30000", "value" => "175"],
        ["min" => "30000", "max" => "35000", "value" => "175"]
    ];


    const MAXIMAL_INVESTMENTS = [
        ["amount" => "7500", "value" => "62"],
        ["amount" => "15000", "value" => "124"],
        ["amount" => "30000", "value" => "247"],
        ["amount" => "45000", "value" => "371"],
        ["amount" => "60000", "value" => "494"]
    ];

}