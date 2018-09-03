<?php

namespace App\Http\Controllers;

use App\Repository\USSSDRepository;
use Illuminate\Http\Request;

class USSDController extends Controller
{
    protected $repo;

    /**
     * USSDController constructor.
     */
    public function __construct()
    {
        $this->repo = new USSSDRepository;
    }


    public function handleUSSD(Request $request){

        $response = $this->repo->execute($request->all());

        #if its an exit request dont append CON
        if($response!="END")
            $response = "CON ".$response;
        else
            $response.=" Thank you for using our USSD service.";


        return response($response,200,['Content-type: text/plain']);
    }
}
