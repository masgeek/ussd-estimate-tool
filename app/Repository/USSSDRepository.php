<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 12/9/17
 * Time: 3:59 PM
 */

namespace App\Repository;


use App\Fertilizer;
use App\HarvestingDate;
use App\Jobs\SendProjectSmsJob;
use App\PlantingDate;
use App\Project;
use App\SubLocation;
use App\USSDSession;

class USSSDRepository
{
    protected $session;
    protected $routes;
    protected $backNavigationMode;

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
        $this->routes = $this->computeRoute($this->session->path);

        $lastInput = $this->getLastInput($input['text']);

        //go back
        if (count($this->routes) > 0 && $lastInput === '0')

            return $this->navigateBack();
        else if (count($this->routes) > 0 && $lastInput === '00')
            return 'END';

        //dd(count($this->routes)>0&&$lastInput == 0, $lastInput, $isRepeat);

        $response = "";

        switch (sizeof($this->routes)) {
            case 0:
                $response = $this->showPlantingDates();
                break;
            case 1;
                #validate the planting date
                $response = $this->showHarvestingDates($lastInput, $isRepeat);
                break;
            case 2:
                $response = $this->showFertilizers($lastInput, $isRepeat);
                break;
            case 3:
                $response = $this->goToFetchProjects($lastInput, $isRepeat);
                break;
            case 4:
                $response = $this->goToFetchProjectSummary($lastInput, $isRepeat);
                break;
            case 5:
                $response = $this->sendSms("-1", true);
                break;
            default:
                $response .= "Unknown action selected \n";
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

            if (!$isRepeat)
                //update current path
                $this->moveNavigationCursorToNext($plantingDate->id);

            $response = "When is thee harvest date? \n";

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
        if (sizeof($harvestDates) <= ($harvestDateId - 1)) {

            $fertilizer = Fertilizer::query()->first();
            $response = "Do you use " . $fertilizer->name . " fertilizer?";

            if (!$isRepeat)
                //save the location
                $this->moveNavigationCursorToNext($fertilizer->id);

            return $response;
        }

        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->showHarvestingDates($this->routes[1], true);

    }

    private function goToFetchProjects($subLocationId, $isRepeat = false)
    {
        if (!$isRepeat) {
            $offset = $subLocationId - 1;

            $subLocation = \DB::table('sub_locations')
                ->where('location_id', $this->routes[2])
                ->orderBy('name')
                ->offset($offset)
                ->limit(1)->first();
        } else {
            $offset = 1;
            $subLocation = SubLocation::find($subLocationId);
        }

        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        if ($offset >= 0 && $subLocation) {

            $projects = Project::whereSubLocationId($subLocation->id)
                ->join('financial_years', 'projects.financial_year_id', '=', 'financial_years.id')
                ->orderBy('financial_years.name', 'desc')
                ->get(['projects.name', 'financial_years.name as financial_year']);

            if (count($projects) > 0) {

                $response = "Showing projects for " . $subLocation->name . " sub location. \n";

                $i = 1;
                foreach ($projects as $project) {
                    $response .= $i . ". " . $project->financial_year . " " . $project->name . " \n";
                    $i++;
                }

                if (!$isRepeat)
                    $this->moveNavigationCursorToNext($subLocation->id);

                return $response;
            }

            $response = "There are no projects for this sub location \n";

        }


        return $response . $this->showFertilizers($this->routes[2], true);

    }

    private function goToFetchProjectSummary($projectId, $isRepeat = false)
    {


        if (!$isRepeat) {
            $offset = $projectId - 1;

            $project = \DB::table('projects')
                ->join('financial_years', 'projects.financial_year_id', '=', 'financial_years.id')
                ->where('sub_location_id', $this->routes[3])
                ->orderBy('financial_years.name', 'desc')
                ->offset($offset)
                ->limit(1)
                ->get(
                    [
                        'projects.id', 'projects.name', 'projects.financial_year_id', 'financial_years.name as financial_year', 'projects.sector',
                        'projects.activity', 'projects.allocation', 'projects.summary'
                    ]
                )
                ->first();
        } else {
            $offset = 0;

            $project = Project::find($projectId);
        }


        if ($offset >= 0 && $project) {

            //dd($project);

            /*if (!$isRepeat)
                //save project id
                $this->moveNavigationCursorToNext($project->id);

            $response = $project->financial_year
                . " " . $project->sector . " sector: \n"
                . $project->name . ", " . $project->activity
                . " KES " . $project->allocation . "\n";*/

            $response = $project->financial_year
                . " " . $project->sector . " sector: "
                . $project->name;

            return $response . " " . $this->sendSms($project->id);

        }


        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->goToFetchProjects($this->routes[3], true);
    }

    public function sendSms($projectId, $isRepeat = false)
    {

        /*if ($input == 1) {

            $project = Project::find($this->routes[4]);*/

        $response = "\n An sms with the project details "
            . ($isRepeat ? "has already " : "")
            . "been sent to your phone number " . $this->session->phone_no;

        if ($isRepeat) {
            return "Invalid option. Try again" . $response;
        }


        $project = Project::find($projectId);
        //save project id
        $this->moveNavigationCursorToNext($project->id);

        //dispatch the job to send sms
        dispatch(new SendProjectSmsJob($project->summary, $this->session->phone_no));

        return $response;

        /*}*/


        $response = $this->backNavigationMode ? "" : "Invalid option. Try again \n";

        return $response . $this->goToFetchProjectSummary($this->routes[4], true);

    }


}