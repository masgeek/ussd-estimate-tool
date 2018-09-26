<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\HarvestingDate;
use App\Quantity;
use App\USSDSession;

class HarvestQuantityService
{
    public static function getQuantities(USSDSession $session)
    {
        $response = " What quantity of roots do you commonly produce in your field of ".$session->fieldArea->display."?\n";
        $harvestQuantities = Quantity::all();
        $i = 1;
        foreach ($harvestQuantities as $quantity) {
            $response .= $i . ". " . $quantity->display . "\n";
            $i++;
        }
        return $response;
    }

    public static function setQuantity(USSDSession $session, $selectedOption)
    {
        $harvestQuantity = Quantity::all();
        if (is_numeric($selectedOption) && $selectedOption > 0 && $selectedOption <= sizeof($harvestQuantity)) {
            $quantity = $harvestQuantity[$selectedOption - 1];
            $session->harvest_quantity_id = $quantity->id;
            $session->save();
            return true;
        }
        return false;
    }

}