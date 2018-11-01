<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\Constants\Languages;
use App\FieldArea;
use App\Investment;
use App\PlantingDate;
use App\USSDSession;

class FieldAreasService
{
    public static function getFieldAreas(USSDSession $session)
    {
        $response = self::getTranslations()['header'][$session->language]."\n";
        $i = 1;
        foreach (self::getTranslations()['data'] as $area) {
            $response .= $i . ". " . $area[$session->language] . "\n";
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

    private static function getTranslations(){
        return [
            'header'=>[
                Languages::ENGLISH => 'What is the area of your cassava field?',
                Languages::YORUBA => 'Bawo ni oko ege re se tobi to?',
                Languages::IBO => 'Kedu ka oke ala ubi akpu gi la?',
            ],
            'data' => [
                [
                    Languages::ENGLISH => 'About 0.25 acre (0.1 ha)',
                    Languages::YORUBA => 'Bi ilarin eeka (0.1 ha)',
                    Languages::IBO => 'O la ka otu uzo n’ime uzo anu acre (0.1 ha)',
                ],[
                    Languages::ENGLISH => 'About 0.5 acre (0.2 ha)',
                    Languages::YORUBA => 'Bi ilaji eeka (0.2 ha)',
                    Languages::IBO => 'O la ka ukara acre (0.2 ha)',
                ],[
                    Languages::ENGLISH => 'About 1 acre (0.4 ha)',
                    Languages::YORUBA => 'Bi eeka kan (0.4 ha)',
                    Languages::IBO => 'O la ka otu acre (0.4 ha)',
                ],[
                    Languages::ENGLISH => 'About 2.5 acre (1 ha)',
                    Languages::YORUBA => 'Bi eeka meji ati abo (1 ha)',
                    Languages::IBO => 'O la ka abuo na ukara acre (1 ha)',
                ]
            ]
        ];
    }

}