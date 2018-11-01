<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 11/1/18
 * Time: 10:47 PM
 */

namespace App\Services;


use App\Constants\Languages;
use App\USSDSession;

class LanguageService
{
    public static function getLanguages(){
        $header = "Welcome to the cassava fertilizer recommendation tool!\nChoose a language\n";
        $languages = "1. English\n2. Yoruba\n3. Ibo";
        return $header.$languages;
    }

    public static function setLanguage(USSDSession $session,$selectedOption){

        if (is_numeric($selectedOption) && $selectedOption > 0 && $selectedOption <= 3) {
            switch ($selectedOption){
                case '1':
                    $language = Languages::ENGLISH;
                    break;
                case '2':
                    $language = Languages::YORUBA;
                    break;
                case '3':
                    $language = Languages::IBO;
                    break;
                default:
                    return false;
            }
            $session->language = $language;
            $session->save();
            return true;
        }
        return false;

    }
}