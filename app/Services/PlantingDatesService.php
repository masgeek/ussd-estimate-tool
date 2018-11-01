<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\Constants\Languages;
use App\PlantingDate;
use App\USSDSession;

class PlantingDatesService
{
    public static function getPlantingDates(USSDSession $session)
    {
        $language = $session->language==null||sizeof($session->language)==0?Languages::YORUBA:$session->language;

        $response = self::getTranslations()['header'][$language]."\n";
        $i = 1;
        foreach (self::getTranslations()['data'] as $date) {
            $response .= $i . ". " . $date[$language] . " \n";
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

    public static function getTranslations()
    {
        return [
            "header" => [
                Languages::ENGLISH => 'When will/did you plant your cassava crop?',
                Languages::YORUBA => 'Igba wo ni e gbin/e fee gbin ege si oko yii?',
                Languages::IBO => 'Izu uka abuo-anu galaga?',
            ],
            "data" => [
                [Languages::ENGLISH => '2-4 weeks ago', Languages::YORUBA => 'Ose meji - merin seyin', Languages::IBO => 'Out izu uka-abuo galaga',],
                [Languages::ENGLISH => '1-2 weeks ago', Languages::YORUBA => 'Ose kan - meji seyin', Languages::IBO => 'Izu ukaa',],
                [Languages::ENGLISH => 'This week', Languages::YORUBA => 'Ose yi', Languages::IBO => 'Otu izu uka-abuo',],
                [Languages::ENGLISH => 'In 1-2 weeks', Languages::YORUBA => 'Ose kan - meji to’nbo', Languages::IBO => 'Izu uka abuo-anu',],
                [Languages::ENGLISH => 'In 2-4 weeks', Languages::YORUBA => 'Ose meji - merin to’nbo', Languages::IBO => 'Nahachi',]
            ]
        ];
    }

}