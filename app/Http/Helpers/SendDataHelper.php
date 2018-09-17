<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/14/18
 * Time: 1:27 AM
 */

namespace App\Http\Helpers;


use App\FertilizerPriceRange;
use App\Helpers\CurrencyHelper;
use App\USSDSession;
use GuzzleHttp\Client;

class SendDataHelper
{
    protected $guzzle;
    protected $url = 'http://estimate.tsobu.co.ke/v1/';
    protected $session;

    /**
     * Create a new job instance.
     *
     * @param USSDSession $session
     */
    public function __construct(USSDSession $session)
    {
        $this->session = $session;

        $this->guzzle = new Client([
            'base_uri' => $this->url,
            'timeout' => 5.0,
            'verify' => false
        ]);

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            "client" => "ussd",
            "lat" => 0,
            "long" => 0,
            "phone_no" => $this->session->phone_no,
            "country" => $this->getCountry(),
            "planting_date" => $this->session->plantingDate->value,
            "harvest_date" => $this->session->harvestDate->value,
            "field_area" => $this->session->fieldArea->value,
            "fertilizers" => $this->getFertilizers(),
            "unit_price" => $this->session->unitPrice->value,
            "unit_of_sale" => $this->session->unitOfSale->value,
            "maximal_investment" => $this->session->investment->value
        ];

//        dd(\GuzzleHttp\json_encode($data));

        #send data
        //$this->sendData($data);
        //$this->httpPost($this->url, $data);
    }

    private function getCountry()
    {
        $helper = new CurrencyHelper();
        switch ($helper->getCurrency($this->session->phone_no)) {
            case "TZS":
                return 1;
            case "NGN":
                return 2;
            default;
                return 1;
        }
    }

    private function getFertilizers()
    {
        $res = array();
        $fertilizerPriceRanges = FertilizerPriceRange::whereSessionId($this->session->id)->get();

        foreach ($fertilizerPriceRanges as $fertilizerPriceRange) {
            $res[] = [
                "name" => $fertilizerPriceRange->fertilizer->name,
                "cost" => $fertilizerPriceRange->priceRange->value
            ];

        }

        return $res;
    }

    public function sendData($data)
    {
        $response = $this->guzzle->post('compute/estimate',
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'json' => \GuzzleHttp\json_encode($data)
            ]
        );

        dd(json_decode((string)($response->getBody()), true));

;
        $response = $this->guzzle->request('POST', 'compute/estimate', [
            'form_params' => $data
        ]);

    }

    function httpPost($url, $data)
    {
        /*$curl = \curl_init($url);
        \curl_setopt($curl, CURLOPT_POST, true);
        \curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        \curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        \curl_close($curl);
        return $response;*/
        /*$options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ /*}

        var_dump($result);*/
        \http_post_fields($this->url, $data);
    }
}