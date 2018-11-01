<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/5/18
 * Time: 12:03 AM
 */

namespace App\Services;


use App\Constants\Languages;
use App\UnitOfSale;
use App\USSDSession;

class UnitsOfSaleService
{
    public static function getUnits(USSDSession $session)
    {
        $response = self::getTranslation()['header'][$session->language]."\n";

        $unitsOfSale = self::getTranslation()['data'];
        $i = 1;
        foreach ($unitsOfSale as $unit) {
            $response .= $i .'. '. $unit[$session->language] . "\n";
            $i++;
        }

        return $response;

    }

    public static function setUnit(USSDSession $session, $selectedOption)
    {
        $unitsOfSale = UnitOfSale::all();;
        if (is_numeric($selectedOption) && $selectedOption > 0 && $selectedOption <= sizeof($unitsOfSale)) {
            $unit = $unitsOfSale[$selectedOption - 1];
            $session->unit_of_sale_id = $unit->id;
            $session->save();
            return true;
        }
        return false;
    }

    private static function getTranslation()
    {
        return [
            'header' => [
                Languages::ENGLISH => 'In what units do you set price for your cassava root produce?',
                Languages::YORUBA => 'Bawo ni e se ma n won ege yin ti e ba fee ta?',
                Languages::IBO => 'Gini bu ntu onu ego I ji ele akpu gi?'
            ],
            'data' => [
                [
                    Languages::ENGLISH => 'Per tonne',
                    Languages::YORUBA => 'Ni tonne ni tonne',
                    Languages::IBO => 'Kwa tonne'
                ],
                [
                    Languages::ENGLISH => 'Per kg',
                    Languages::YORUBA => 'Ni kg ni kg',
                    Languages::IBO => 'Kwa kg'
                ],
                [
                    Languages::ENGLISH => 'Per 50 kg bag',
                    Languages::YORUBA => 'Ni bag 50 kg',
                    Languages::IBO => 'Kwa ntu akpa iri ise kg'
                ],
                [
                    Languages::ENGLISH => 'Per 100 kg bag',
                    Languages::YORUBA => 'Ni bag 100 kg',
                    Languages::IBO => 'Kwa ntu akpa otu nari kg'
                ]
            ]
        ];
    }
}