<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 12/9/17
 * Time: 3:59 PM
 */

namespace App\Repository;


use App\Fertilizer;
use App\FertilizerPriceRange;
use App\HarvestingDate;
use App\PlantingDate;
use App\Services\ConfigService;
use App\Services\InvestmentsService;
use App\Services\PriceRangeService;
use App\Services\UnitPricesService;
use App\Services\UnitsOfSaleService;
use App\USSDSession;

class USSSDRepository
{
    const CURRENT_FERTILIZER_KEY = "CURRENT_FERTILIZER_KEY";
    const CURRENT_PRICE_RANGE_KEY = "CURRENT_PRICE_RANGE_KEY";
    protected $session;
    protected $routes;
    protected $backNavigationMode;
    protected $input;

    /**
     * USSSDRepository constructor.
     * @internal USSDSession $session
     */
    public function __construct()
    {
        $this->session = USSDSession::where('session_id', request()->get('sessionId'))->first();
        if (!$this->session) {
            $this->session = new USSDSession();
            $this->session->session_id = request()->get('sessionId');
            $this->session->phone_no = request()->get('phoneNumber');
            $this->session->path = "";
            $this->session->save();
        }

        #Flag to indicate whether back navigation is on
        #if set, the invalid option selected message will not be shown
        $this->backNavigationMode = false;
    }

    /**
     * @param array $input
     * @param bool $isRepeat
     * @return string
     */
    public function execute($input, $isRepeat = false)
    {
        #set input text
        $this->input = $input['text'];

        $this->routes = $this->computeRoute($this->session->path);

        $lastInput = $this->getLastInput($input['text']);

        //go back
        if (count($this->routes) > 0 && $lastInput === '0')

            return $this->navigateBack();
        else if (count($this->routes) > 0 && $lastInput === '00')
            return 'END';

        //dd(count($this->routes)>0&&$lastInput == 0, $lastInput, $isRepeat);

        $response = "";

        $fertilizersCount = Fertilizer::count();

        $pricesCount = FertilizerPriceRange::whereSessionId($this->session->id)->count();

        $fertilizerLimit = $fertilizersCount + 1;
        $fertilizerPriceRangeLimit = 1 + $pricesCount + $fertilizersCount;

        //dd(["f" => $fertilizersCount, "n" => $pricesCount, "index" => sizeof($this->routes), "second last"=>$this->getSecondLastInput()]);

        switch (sizeof($this->routes)) {
            #0
            case 0:
                $response = $this->showPlantingDates();
                break;
            #1
            case 1;
                #validate the planting date
                $response = $this->showHarvestingDates($lastInput, $isRepeat);
                break;
            #f[1]
            case 2:
                $response = $this->showFertilizers($lastInput, $isRepeat);
                break;
            #f+2 == n1
            case (1 + $fertilizerLimit):
                $response = $this->showFertilizerPricesRanges($lastInput, $isRepeat);
                break;
            #f+n+2
            case ($fertilizerPriceRangeLimit + 1):
                #Units of sale
                $response = $this->showUnitsOfSale($lastInput, $isRepeat);
                break;
            #f+n+3
            case ($fertilizerPriceRangeLimit + 2):
                #unit prices
                $response = $this->showUnitPrices($lastInput, $isRepeat);
                break;
            #f+n+4
            case ($fertilizerPriceRangeLimit + 3):
                #maximal investment
                $response = $this->showInvestments($lastInput, $isRepeat);
                break;
            #f+n+5
            case ($fertilizerPriceRangeLimit + 4):
                #The end
                $response = $this->showLastScreen($lastInput);
                break;
            default:
                #3 to f+1
                if (sizeof($this->routes) > 2 && sizeof($this->routes) <= $fertilizerLimit) {
                    $response = $this->showOtherFertilizer($lastInput, $isRepeat);
                } #f+3 == n[2] to f+n+1
                else if (sizeof($this->routes) >= $fertilizerLimit + 2 && sizeof($this->routes) <= $fertilizerPriceRangeLimit) {
                    $response = $this->showOtherFertilizerPricesRanges($lastInput, $isRepeat);
                } else {
                    $response = "Unknown action selected \n";
                }

                break;
        }
        $response .= "\n0 . Go back";
        $response .= "\n00 . Exit";

        return $response;

    }

    /**
     * @param $text
     * @return array
     */
    private function computeRoute($text)
    {
        if ($text == "") {
            return [];
        }

        return explode('*', $text);
    }

    public function getLastInput($inputText)
    {
        $arr = explode('*', $inputText);
        return array_pop($arr);
    }

    private function navigateBack()
    {

        //dd($this->routes, $this->session->path, implode("*", $arr), $arr);

        $text = "";

        if (count($this->routes) > 0) {
            //remove last path
            array_pop($this->routes);
            //save new path
            $this->session->path = implode("*", $this->routes);
            $this->session->save();
        }

        #set the back nav flag
        $this->backNavigationMode = true;


        return $this->execute(["text" => "-20"], true);


    }

    private function showPlantingDates()
    {

        $dates = PlantingDate::all();

        $response = "Welcome to field yield estimation tool.\nWhen is the planting date?\n";
        $i = 1;
        foreach ($dates as $date) {
            $response .= $i . ". " . $date->display . " \n";
            $i++;
        }
        if (count($this->routes) == 0)
            $this->moveNavigationCursorToNext('n');

        return $response;
    }

    /**
     * @param String $next
     * next == users input
     * Appends the users input to indicate the progress of the user's selections
     */
    private function moveNavigationCursorToNext($next)
    {
        //append new path to paths
        if ($this->session->path == "")
            $this->session->path .= $next;
        else
            $this->session->path .= "*" . $next;


        $this->session->save();

    }

    /**
     * @param $plantingDateId
     * @param bool $isRepeat
     * @return string
     * Takes in ward id and returns the locations for that ward
     * is repeat is used to flag if the method is being called for the second time
     */
    private function showHarvestingDates($plantingDateId, $isRepeat = false)
    {

        $plantingDate = PlantingDate::query()->find($plantingDateId);

        if ($plantingDate) {

            //update session planting date
            $this->session->planting_date_id = $plantingDate->id;
            $this->session->save();

            if (!$isRepeat)
                //update current path
                $this->moveNavigationCursorToNext($plantingDate->id);

            $response = "When is the harvest date?" . $this->session->id . " \n";

            $harvestDates = HarvestingDate::all();
            $i = 1;
            foreach ($harvestDates as $date) {
                $response .= $i . ". " . $date->display . " after planting\n";
                $i++;
            }

            return $response;
        }

        //reset path
        $this->navigateToFirst();

        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->showPlantingDates();
    }

    /**
     * Resets the navigation
     */
    private function navigateToFirst()
    {
        $this->session->path = "";
        $this->session->save();

    }

    private function showFertilizers($harvestDateId, $isRepeat = false)
    {
        $harvestDates = HarvestingDate::query()->get();
        if (is_numeric($harvestDateId) && $harvestDateId <= sizeof($harvestDates)) {

            $harvestDate = $harvestDates[$harvestDateId - 1];

            //update harvest date
            $this->session->harvesting_date_id = $harvestDate->id;
            $this->session->save();

            $fertilizer = Fertilizer::first();
            $response = "Do you use " . $fertilizer->name . " : " . $fertilizer->id . " fertilizer?\n";
            $response .= "1. Yes\n2. No";

            #set current fertilizer config
            ConfigService::setConfig(USSSDRepository::CURRENT_FERTILIZER_KEY, 1, $this->session->id);

            if (!$isRepeat)
                //save the location
                $this->moveNavigationCursorToNext($harvestDate->id);

            return $response;
        }

        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->showHarvestingDates($this->routes[1], true);

    }

    private function showFertilizerPricesRanges($selectedOption, $isRepeat = false)
    {
        //validate the selected option
        if (is_numeric($selectedOption) && $selectedOption >= 1 && $selectedOption <= 2) {
            //get fertilizer
            $fertilizerId = ConfigService::getConfig(USSSDRepository::CURRENT_FERTILIZER_KEY, $this->session->id)->value;
            if ($isRepeat) {
                $fertilizerId -= 1;
            }
            //dd($fertilizerId);
            $fertilizer = Fertilizer::all()[$fertilizerId - 1];

            //add to fertilizer price range uf selected
            if ($selectedOption == '1') {

                //get fertilizer price range
                $fertilizerPriceRange = FertilizerPriceRange::whereFertilizerId($fertilizer->id)
                    ->where("session_id", $this->session->id)->first();

                if (!$fertilizerPriceRange)
                    $fertilizerPriceRange = new FertilizerPriceRange();

                #set defaults
                $fertilizerPriceRange->session_id = $this->session->id;
                $fertilizerPriceRange->fertilizer_id = $fertilizer->id;

                #save
                $fertilizerPriceRange->save();
            }

            #show first price range
            $fertilizerPriceRange = FertilizerPriceRange::whereSessionId($this->session->id)
                ->first();

            if (!$isRepeat) {
                //save the location
                $this->moveNavigationCursorToNext($selectedOption);
                #increment fertilizer position
                ConfigService::incrementConfig(USSSDRepository::CURRENT_PRICE_RANGE_KEY, $this->session->id);
            }

            return PriceRangeService::getRanges($fertilizerPriceRange);

        } else {
            $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";
            return $response . $this->showOtherFertilizer($this->getSecondLastInput(), true);
        }

    }

    private function showOtherFertilizer($selectedOption, $isRepeat = false)
    {

        //validate the selected option
        if (is_numeric($selectedOption) && $selectedOption >= 1 && $selectedOption <= 2) {
            //get fertilizer
            $fertilizerId = ConfigService::getConfig(USSSDRepository::CURRENT_FERTILIZER_KEY, $this->session->id)->value;
            if ($isRepeat) {
                $fertilizerId -= 1;
            }

            $selectedFertilizer = Fertilizer::all()[$fertilizerId - 1];

            //add to fertilizer price range uf selected
            if ($selectedOption == '1') {

                //get fertilizer price range
                $fertilizerPriceRange = FertilizerPriceRange::whereFertilizerId($selectedFertilizer->id)
                    ->where("session_id", $this->session->id)->first();

                if (!$fertilizerPriceRange)
                    $fertilizerPriceRange = new FertilizerPriceRange();

                #set defaults
                $fertilizerPriceRange->session_id = $this->session->id;
                $fertilizerPriceRange->fertilizer_id = $selectedFertilizer->id;

                #save
                $fertilizerPriceRange->save();
            }

            #Increment only when not in repeat mode
            if (!$isRepeat) {
                //save the location
                $this->moveNavigationCursorToNext($selectedOption);
                #increment fertilizer position
                ConfigService::incrementConfig(USSSDRepository::CURRENT_FERTILIZER_KEY, $this->session->id);
            }

            $nextFertilizer = Fertilizer::all()[$fertilizerId];
            $response = "Do you use " . $nextFertilizer->name . " : " . $nextFertilizer->id . " fertilizer?\n";
            $response .= "1. Yes\n2. No";


            return $response;

        }

        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->showOtherFertilizer($this->getSecondLastInput(), true);
    }

    public function getSecondLastInput()
    {
        $arr = explode('*', $this->input);
        if (sizeof($arr) > 2)
            return $arr[sizeof($arr) - 2];
        return '';
    }

    public function showUnitsOfSale($selectedOption, $isRepeat = false)
    {
        //validate the selected option
        if (PriceRangeService::isValidPriceRange($selectedOption)) {

            $fertilizerPriceRangeId = ConfigService::getConfig(USSSDRepository::CURRENT_PRICE_RANGE_KEY, $this->session->id)->value;

            if ($isRepeat) {
                $fertilizerPriceRangeId -= 1;
            }

            $fertilizerPriceRanges = FertilizerPriceRange::whereSessionId($this->session->id)->get();

            $selectedFertilizerPriceRange = $fertilizerPriceRanges[$fertilizerPriceRangeId - 1];
            //add to fertilizer price range uf selected
            PriceRangeService::setRange($selectedFertilizerPriceRange, $selectedOption);

            #Increment only when not in repeat mode
            if (!$isRepeat) {
                //save the location
                $this->moveNavigationCursorToNext($selectedOption);
            }

            return UnitsOfSaleService::getUnits();

        }

        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->showOtherFertilizerPricesRanges($this->getSecondLastInput(), true);
    }

    private function showOtherFertilizerPricesRanges($selectedOption, $isRepeat = false)
    {
        //validate the selected option
        if (PriceRangeService::isValidPriceRange($selectedOption)) {

            $fertilizerPriceRangeId = ConfigService::getConfig(USSSDRepository::CURRENT_PRICE_RANGE_KEY, $this->session->id)->value;

            if ($isRepeat) {
                $fertilizerPriceRangeId -= 1;
            }

            $fertilizerPriceRanges = FertilizerPriceRange::whereSessionId($this->session->id)->get();

            $selectedFertilizerPriceRange = $fertilizerPriceRanges[$fertilizerPriceRangeId - 1];
            //add to fertilizer price range uf selected
            PriceRangeService::setRange($selectedFertilizerPriceRange, $selectedOption);

            #Increment only when not in repeat mode
            if (!$isRepeat) {
                //save the location
                $this->moveNavigationCursorToNext($selectedOption);
                #increment fertilizer position
                ConfigService::incrementConfig(USSSDRepository::CURRENT_PRICE_RANGE_KEY, $this->session->id);
            }

            return PriceRangeService::getRanges($fertilizerPriceRanges[$fertilizerPriceRangeId]);

        }

        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->showOtherFertilizerPricesRanges($this->getSecondLastInput(), true);
    }

    public function showUnitPrices($selectedOption, $isRepeat = false)
    {
        //validate the selected option
        if (UnitsOfSaleService::setUnit($this->session, $selectedOption)) {

            #Increment only when not in repeat mode
            if (!$isRepeat) {
                //save the location
                $this->moveNavigationCursorToNext($selectedOption);
            }

            return UnitPricesService::getUnits();

        }

        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->showUnitsOfSale($this->getSecondLastInput(), true);
    }

    public function showInvestments($selectedOption, $isRepeat = false)
    {
        //validate the selected option
        if (UnitPricesService::setUnit($this->session, $selectedOption)) {

            #Increment only when not in repeat mode
            if (!$isRepeat) {
                //save the location
                $this->moveNavigationCursorToNext($selectedOption);
            }

            return InvestmentsService::getInvestments();

        }

        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->showUnitPrices($this->getSecondLastInput(), true);
    }

    public function showLastScreen($selectedOption)
    {
        //validate the selected option
        if (InvestmentsService::setInvestment($this->session, $selectedOption)) {

            return "END Thank you for using our service, an SMS with results will be sent to you shortly.";

        }

        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->showInvestments($this->getSecondLastInput(), true);
    }


}