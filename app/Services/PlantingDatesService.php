<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\Investment;
use App\PlantingDate;
use App\USSDSession;

class PlantingDatesService
{
    public static function getPlantingDates()
    {
        $dates = PlantingDate::all();

        $response = "Welcome to the cassava fertilizer recommendation tool!\nWhen have you planted (or will you plant) your cassava crop?\n";
        $i = 1;
        foreach ($dates as $date) {
            $response .= $i . ". " . $date->display . " \n";
            $i++;
        }

        return $response;

    }

    public static function setPlantingDate(USSDSession $session, $selectedOption)
    {
        $plantingDates = PlantingDate::all();;
        if (is_numeric($selectedOption) && $selectedOption > 0 && $selectedOption <= sizeof($plantingDates)) {
            $plantingDate = $plantingDates[$selectedOption - 1];
            $session->planting_date_id = $plantingDate->id;
            $session->save();
            return true;
        }
        return false;
    }

}