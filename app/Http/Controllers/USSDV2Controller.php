<?php

namespace App\Http\Controllers;

use App\Repository\USSDV1Repository;
use Illuminate\Http\Request;

class USSDV2Controller extends Controller
{
    protected $repo;

    /**
     * USSDController constructor.
     */
    public function __construct()
    {
        $this->repo = new USSDV1Repository();
    }


    public function handleUSSD(Request $request)
    {

        $response = $this->repo->execute($request->all());
        #if its an exit request dont append CON
        if (substr($response, 0, 3) == "END")
            $response = "END Thank you for using our service, an SMS with results will be sent to you shortly.";
        else if ($response == "EXIT")
            $response = "END Thank you for using our service.";
        else
            $response = "CON " . $response;


        return response($response, 200, ['Content-type: text/plain']);
    }
}
