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


    const  HARVESTING_DATES= [
        ["display" => "8-9 months", "value" => "37"],
        ["display" => "10-12 months", "value" => "46"],
        ["display" => "1 year (12 months)", "value" => "52"],
        ["display" => "13-14 months", "value" => "59"],
        ["display" => "15-16 months", "value" => "67"]
    ];

    const FIELD_AREAS = [
        ["display" => "0.25", "value" => "0.25"],
        ["display" => "0.5", "value" => "0.5"],
        ["display" => "1", "value" => "1"],
        ["display" => "2", "value" => "2"],
        ["display" => "5", "value" => "5"]
    ];


    const FERTILIZERS = [
        ["name" => "Urea"],
        ["name" => "DAP"],
        ["name" => "NPK17:17:17"],
        ["name" => "NPK15:15:15"],
        ["name" => "NPK20:10:10"],
        ["name" => "NPK25:10:10"],
        ["name" => "TSP"],
        ["name" => "SSP"],
        ["name" => "CAN"],
        ["name" => "Nafaka plus"],
        ["name" => "MOP"]
    ];

    const PRICE_RANGES = [
        ["min" => "20", "max" => "30", "value" => "0.5"],
        ["min" => "30", "max" => "40", "value" => "0.7"],
        ["min" => "40", "max" => "50", "value" => "0.9"],
        ["min" => "50", "max" => "60", "value" => "1.1"]
    ];

    const UNITS_OF_SALE = [
        ["display" => "tonne", "value" => "1000"],
        ["display" => "kg", "value" => "1"],
        ["display" => "50 kg bag", "value" => "50"],
        ["display" => "100 kg bag", "value" => "100"],
        ["display" => "5pick up load (2tonnes)", "value" => "2000"]

    ];

    const UNIT_PRICES = [
        ["min" => "20", "max" => "30", "value" => "25"],
        ["min" => "30", "max" => "50", "value" => "40"],
        ["min" => "50", "max" => "100", "value" => "75"],
        ["min" => "100", "max" => "150", "value" => "125"],
        ["min" => "150", "max" => "200", "value" => "175"]
    ];


    const MAXIMAL_INVESTMENTS = [
        ["amount" => "25", "value" => "62"],
        ["amount" => "50", "value" => "124"],
        ["amount" => "100", "value" => "247"],
        ["amount" => "150", "value" => "371"],
        ["amount" => "200", "value" => "494"]
    ];

}