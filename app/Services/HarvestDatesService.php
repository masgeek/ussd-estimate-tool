<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\HarvestingDate;
use App\USSDSession;

class HarvestDatesService
{
    public static function getHarvestDates()
    {
        $response = "When is the harvest date?" . " \n";
        $harvestDates = HarvestingDate::all();
        $i = 1;
        foreach ($harvestDates as $date) {
            $response .= $i . ". " . $date->display . " after planting\n";
            $i++;
        }
        return $response;
    }

    public static function setHarvestDate(USSDSession $session, $selectedOption)
    {
        $harvestDates = HarvestingDate::all();;
        if (is_numeric($selectedOption) && $selectedOption > 0 && $selectedOption <= sizeof($harvestDates)) {
            $harvestDate = $harvestDates[$selectedOption - 1];
            $session->harvesting_date_id = $harvestDate->id;
            $session->save();
            return true;
        }
        return false;
    }

}