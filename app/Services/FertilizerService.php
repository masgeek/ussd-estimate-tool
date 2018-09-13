<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\Fertilizer;
use App\FertilizerPriceRange;
use App\USSDSession;

class FertilizerService
{
    public static function getFertilizer($index)
    {
        #Get the fertilizer
        $fertilizer = Fertilizer::all()[$index - 1];
        #Build response
        $response = "Do you use " . $fertilizer->name . " fertilizer?\n";
        $response .= "1. Yes\n";
        $response .= "2. No";

        return $response;

    }

    public static function setFertilizer(USSDSession $session, $selectedFertilizerId, $selectedOption)
    {
        if (self::isValidOption($selectedOption)) {

            #Get selected fertilizer
            $selectedFertilizer = Fertilizer::all()[$selectedFertilizerId - 1];
            
            //get fertilizer price range
            $fertilizerPriceRange = FertilizerPriceRange::whereFertilizerId($selectedFertilizer->id)
                ->where("session_id", $session->id)
                ->first();

            //add to fertilizer price range uf selected
            if ($selectedOption == '1') {

                if (!$fertilizerPriceRange)
                    $fertilizerPriceRange = new FertilizerPriceRange();

                #set defaults
                $fertilizerPriceRange->session_id = $session->id;
                $fertilizerPriceRange->fertilizer_id = $selectedFertilizer->id;

                #save
                $fertilizerPriceRange->save();

            } else {
                #delete if it exists
                if ($fertilizerPriceRange)
                    $fertilizerPriceRange->delete();
            }

            return true;
        }
        return false;
    }

    public static function isValidOption($selectedOption)
    {
        return is_numeric($selectedOption) && $selectedOption >= 1 && $selectedOption <= 2;
    }

    public static function getCount()
    {
        return Fertilizer::count();
    }
}