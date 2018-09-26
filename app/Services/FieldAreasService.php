<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\FieldArea;
use App\Investment;
use App\PlantingDate;
use App\USSDSession;

class FieldAreasService
{
    public static function getFieldAreas()
    {
        $areas = FieldArea::all();

        $response = "What is the area of your cassava field?\n";
        $i = 1;
        foreach ($areas as $area) {
            $response .= $i . ". About " . $area->display . "\n";
            $i++;
        }

        return $response;

    }

    public static function setFieldArea(USSDSession $session, $selectedOption)
    {
        $areas = FieldArea::all();
        if (is_numeric($selectedOption) && $selectedOption > 0 && $selectedOption <= sizeof($areas)) {
            $area = $areas[$selectedOption - 1];
            $session->field_area_id = $area->id;
            $session->save();
            return true;
        }
        return false;
    }

}