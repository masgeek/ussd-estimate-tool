<?php

namespace App\Http\Controllers;

use App\Repository\USSDRepository;
use Illuminate\Http\Request;

class USSDController extends Controller
{
    protected $repo;

    /**
     * USSDController constructor.
     */
    public function __construct()
    {
        $this->repo = new USSDRepository();
    }


    public function handleUSSD(Request $request)
    {

        $response = $this->repo->execute($request->all());
        #if its an exit request dont append CON
        if (substr($response,0,3) == "END")
            $response = "END Results submitted successfully. You will receive an SMS with recommendations.";
        else if ($response == "EXIT")
            $response = "END Thank you for using our service.";
        else
            $response = "CON " . $response;


        return response($response, 200, ['Content-type: text/plain']);
    }
}
