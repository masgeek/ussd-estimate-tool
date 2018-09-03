<?php
/**
 * User: kenboi
 * Automate sending sms
 */

namespace App\Http\Helpers;



use GuzzleHttp\Client;

class SmsHelper
{


    protected $guzzle;

    protected $url = 'https://sms.bunifu.io/api/';
    protected $id, $secret;

    protected $headers;

    /**
     * SmsHelper constructor.
     * @param $id
     * @param $secret
     */
    public function __construct($id, $secret)
    {
        $this->id = $id;
        $this->secret = $secret;

        $this->guzzle = new Client([
            'base_uri' => $this->url,
            'timeout' => 5.0,
        ]);


        $response = $this->guzzle->post('/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $id,
                'client_secret' => $secret,
                'scope' => '*',
            ],
        ]);

        $res = json_decode((string)($response->getBody()), true);
        $this->headers = [
            'Authorization' => 'Bearer '. $res['access_token'] ,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];
    }

    public function sendSms($message, array $to)
    {
        $response = $this->guzzle->post('sms/send',
            [
                'headers' => $this->headers,
                'json' => ['sender_id' => "sikizi-ims", 'message' => $message, 'to' => $to]
            ]
        );

        return json_decode((string)($response->getBody()), true);

    }

    public function send($guardians, $msg){
        $response = array();
        foreach ($guardians as $guardian){
            $response[] = $this->sendSms(str_replace("*parent*",$guardian->user->name,$msg),[$guardian->user->phone]);
        }
        return $response;
    }
}