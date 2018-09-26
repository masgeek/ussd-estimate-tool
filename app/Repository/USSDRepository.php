<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/10/18
 * Time: 10:56 PM
 */

namespace App\Repository;


use App\Constants\AppConstants;
use App\Helpers\CurrencyHelper;
use App\Jobs\SendEstimatesDataJob;
use App\Services\ConfigService;
use App\Services\FertilizerService;
use App\Services\FieldAreasService;
use App\Services\HarvestQuantityService;
use App\Services\InvestmentsService;
use App\Services\PlantingDatesService;
use App\Services\PriceRangeService;
use App\Services\UnitPricesService;
use App\Services\UnitsOfSaleService;
use App\USSDSession;

class USSDRepository
{
    protected $session;
    protected $backNavigationMode;
    protected $currentRoute;
    protected $input;
    protected $fertilizerLimit;
    protected $fertilizerPriceRangeLimit;
    protected $isRepeatMode;
    protected $isDebugMode = false;
    protected $initialRoutes = 3;

    /**
     * USSSDRepository constructor.
     * @internal USSDSession $session
     */
    public function __construct()
    {

        #Flag to indicate whether back navigation is on
        #if set, the invalid option selected message will not be shown
        $this->backNavigationMode = false;

        #Find or create the session
        $this->session = USSDSession::where('session_id', request()
            ->get('sessionId'))
            ->first();

        if (!$this->session) {
            $this->session = new USSDSession();
            $this->session->session_id = request()->get('sessionId');
            $this->session->phone_no = request()->get('phoneNumber');
            $this->session->path = "";

            #currency math
            $helper = new CurrencyHelper();
            $this->session->currency = $helper->getCurrency($this->session->phone_no);

            $this->session->save();

            #Init current path to one
            $this->doMoveToNext();
        }
    }

    private function doMoveToNext()
    {
        ConfigService::incrementConfig(AppConstants::KEY_CURRENT_ROUTE, $this->session->id);
        $this->addToPath($this->getLastInput());
        $this->debug("Moving to Next:");
    }

    private function addToPath($item)
    {
        if ($item) {
            //append new path to paths
            if ($this->session->path == "")
                $this->session->path .= $item;
            else
                $this->session->path .= "*" . $item;
            $this->session->save();
        }
    }

    private function getLastInput($inputText = null)
    {
        if ($inputText == null)
            $inputText = $this->input;

        if ($inputText == "")
            return "";

        $arr = explode('*', $inputText);
        return array_pop($arr);
    }

    private function debug($title = null)
    {
        if ($this->isDebugMode) {
            if ($title)
                echo $title . "\n";
            $newRoute = ConfigService::getConfig(AppConstants::KEY_CURRENT_ROUTE, $this->session->id)->value;
            echo "Path: " . $this->session->path . " Last input: " . $this->getLastInput();
            echo "Current route: " . $this->currentRoute . " New route: " . $newRoute . "\n";
            echo "Back navigation: " . ($this->backNavigationMode ? "true" : "false") . "\n";
        }
    }

    /**
     * @param array $input
     * @param bool $isRepeat
     * @return string
     */
    public function execute($input, $isRepeat = false)
    {
        #set input
        $this->input = $input['text'];

        #set current route
        $this->currentRoute = ConfigService::getConfig(AppConstants::KEY_CURRENT_ROUTE, $this->session->id)->value;

        #check back navigation flag
        if ($this->backNavigationMode && $this->currentRoute > 1)
            $this->currentRoute -= 1;

        #Get the last user input
        $lastInput = $this->getLastInput();

        #Fertilizer upper limit
        $this->fertilizerLimit = FertilizerService::getCount($this->session->currency) + $this->initialRoutes;
        #SelectedFertilizers upper limit
        $this->fertilizerPriceRangeLimit = $this->fertilizerLimit + PriceRangeService::getAvailableFertilizerCount($this->session);


        #back navigation || exit check
        //go back
        if ($this->currentRoute > 1 && $lastInput === '0')
            return $this->onNavigateBack();
        else if ($this->currentRoute > 0 && $lastInput === '00')
            return 'EXIT';

        return $this->buildResponse($isRepeat);

    }

    private function onNavigateBack($errorMode = false)
    {
        $this->doMoveToPrevious();
        $previousInput = $this->getLastInput($this->session->path);
        #set back navigation flag
        $this->backNavigationMode = true;

        #Execute request passing required flags error mode flag
        return $this->execute(['text' => $previousInput], true, $errorMode);
    }

    private function doMoveToPrevious()
    {
        #write current route
        $val = ConfigService::setConfig(AppConstants::KEY_CURRENT_ROUTE, $this->currentRoute, $this->session->id)->value;

        #do not decrement if is less or equal to two
        if ($val > 2)
            ConfigService::decrementConfig(AppConstants::KEY_CURRENT_ROUTE, $this->session->id);

        #remove last input from path
        $paths = explode('*', $this->session->path);
        array_pop($paths);
        $this->session->path = $paths == null ? "" : implode("*", $paths);
        $this->session->save();

        $this->debug("Moving to previous:");
    }

    private function buildResponse($isRepeat)
    {

        $this->debug("Debug before");
        switch ($this->currentRoute) {
            case 1:
                $response = PlantingDatesService::getPlantingDates();
                break;
            case 2:
                $response = $this->showFieldAreas();
                break;
            case 3:
                $response = $this->showHarvestQuantity();
                break;
            case 4:
                $response = $this->showFirstFertilizers();
                break;

            /*case (1 + $this->fertilizerLimit):
                $response = $this->showFertilizerPricesRanges();
                break;*/

            case   ($this->fertilizerLimit + 1):
                #Units of sale
                $response = $this->showUnitsOfSale();
                break;
            #f+n+3
            case ($this->fertilizerLimit + 2):
                #unit prices
                $response = $this->showUnitPrices();
                break;
            #f+n+4
            case ($this->fertilizerLimit + 3):
                #maximal investment
                $response = $this->showInvestments();
                break;
            #f+n+5
            case ($this->fertilizerLimit + 4):
                #The end
                $response = $this->showLastScreen();
                break;
            default:
                if ($this->currentRoute > $this->initialRoutes + 1 && $this->currentRoute <= $this->fertilizerLimit) {
                    $response = $this->showOtherFertilizer();
                } /*else if ($this->currentRoute >= $this->fertilizerLimit + 2 && $this->currentRoute <= $this->fertilizerPriceRangeLimit) {
                    $response = $this->showOtherFertilizerPricesRanges();
                }*/
                else {
                    $response = "Unknown option selected";
                }
                break;
        }

        $this->debug("Debug after: ");

        if (!$response)
            return $this->repeat();

        #Show error repeat mode
        if ($isRepeat && !$this->backNavigationMode)
            $response = "Invalid option. Try again \n" . $response;
        #Next
        if (!$this->backNavigationMode)
            $this->doMoveToNext();

        #Navigation controls
        $response .= "\n0 . Go back";
        $response .= "\n00 . Exit";

        return $response;

    }

    private function showFieldAreas()
    {

        if (PlantingDatesService::setPlantingDate($this->session, $this->getLastInput())) {
            #show fertilizers
            return FieldAreasService::getFieldAreas();
        }
        return null;
    }

    private function showHarvestQuantity()
    {
        if (FieldAreasService::setFieldArea($this->session, $this->getLastInput())) {
            #show harvest dates
            return HarvestQuantityService::getQuantities($this->session);
        }
        return null;
    }

    private function showFirstFertilizers()
    {
        if (HarvestQuantityService::setQuantity($this->session, $this->getLastInput())) {
            #show fertilizers
            return FertilizerService::getFertilizer($this->session, 1);
        }
        return null;
    }

    private function showUnitsOfSale()
    {
        $currentFertilizer = $this->currentRoute - $this->initialRoutes;
        if (FertilizerService::setFertilizer($this->session, $currentFertilizer - 1, $this->getLastInput())) {
            return UnitsOfSaleService::getUnits();
        }

        return null;

    }

    private function showUnitPrices()
    {
        if (UnitsOfSaleService::setUnit($this->session, $this->getLastInput())) {
            return UnitPricesService::getUnits($this->session);
        }

        return null;

    }

    private function showInvestments()
    {
        if (UnitPricesService::setUnit($this->session, $this->getLastInput())) {
            return InvestmentsService::getInvestments($this->session);
        }

        return null;

    }

    private function showLastScreen()
    {
        if (InvestmentsService::setInvestment($this->session, $this->getLastInput())) {
            SendEstimatesDataJob::dispatch($this->session);
            return "END";
        }

        return null;

    }

    private function showOtherFertilizer()
    {
        $currentFertilizer = $this->currentRoute - $this->initialRoutes;
        if (FertilizerService::setFertilizer($this->session, $currentFertilizer - 1, $this->getLastInput())) {
            return FertilizerService::getFertilizer($this->session, $currentFertilizer);
        }
        return null;
    }

    public function repeat()
    {
        #decrement current
        $this->currentRoute = ConfigService::decrementConfig(AppConstants::KEY_CURRENT_ROUTE, $this->session->id)->value;
        #set input

        // dd(["Last input: " => $this->getLastInput($this->session->path), "Current route: " => $this->currentRoute]);

        return $this->execute(["text" => $this->session->path], true);
    }

    private function showFertilizerPricesRanges()
    {
        $currentFertilizer = $this->currentRoute - $this->initialRoutes;
        if (FertilizerService::setFertilizer($this->session, $currentFertilizer - 1, $this->getLastInput())) {
            $currentPriceRangeIndex = $this->currentRoute - $this->fertilizerLimit;
            return PriceRangeService::getRanges($this->session, $currentPriceRangeIndex);
        }
        return null;
    }

    private function showOtherFertilizerPricesRanges()
    {
        $currentPriceRangeIndex = $this->currentRoute - $this->fertilizerLimit;
        if (PriceRangeService::setRange($currentPriceRangeIndex - 1, $this->session, $this->getLastInput())) {
            return PriceRangeService::getRanges($this->session, $currentPriceRangeIndex);
        }

        return null;
    }

}