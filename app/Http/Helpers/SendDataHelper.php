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
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Monolog\Handler\StreamHandler;
use Concat\Http\Middleware\Logger;
use Psr\Log\LogLevel;

class SendDataHelper
{
    protected $guzzle;
    protected $url = 'https://estimate.tsobu.co.ke/v1/';
    protected $session;

    /**
     * Create a new job instance.
     *
     * @param USSDSession $session
     */
    public function __construct(USSDSession $session)
    {
        $this->session = $session;
        $this->session->fresh(['plantingDate','harvestDate','investment','fieldArea','unitPrice','unitOfSale']);
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
            "harvest_date" => $this->session->plantingDate->value,
            "harvest_quantity" => $this->session->harvestQuantity->value,
            "field_area" => $this->session->fieldArea->value,
            "fertilizers" => $this->getFertilizers(),
            "unit_price" => $this->session->unitPrice->value,
            "unit_of_sale" => $this->session->unitOfSale->value,
            "maximal_investment" => $this->session->investment->value
        ];

        #send data
        $this->sendData($data);
    }

    private function getCountry()
    {
        switch ($this->session->currency) {
            case "TZS":
                return 2;
            case "NGN":
                return 1;
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
        /*$middleware = new Logger(function ($level, $message, array $context) {
            // Log the message
            echo $level."\n".$message;
        });
        $middleware->setRequestLoggingEnabled(false);
        $middleware->setLogLevel(LogLevel::DEBUG);
        $middleware->setFormatter(new MessageFormatter(MessageFormatter::DEBUG));

        $stack = HandlerStack::create();
        $stack->push($middleware);*/

        $this->guzzle = new Client([
            'base_uri' => $this->url,
            'timeout' => 30,
            'verify' => false,
            //'handler' => $stack
        ]);

        $response = $this->guzzle->post('compute/estimate',
            [
                'json' => ($data),
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        //dd(json_decode((string)($response->getBody()), true));

    }


}