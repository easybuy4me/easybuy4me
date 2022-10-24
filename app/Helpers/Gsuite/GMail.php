<?php

namespace App\Helpers\Gsuite;

use Illuminate\Support\Facades\Http;

class GMail
{
    protected $secrete_key;
    protected $url;
    protected $client;

    function __construct()
    {
        $this->secrete_key = 'tk_5706c1g4yu4312u501134be78eb5dcdf30989c387c03';
        $this->url = 'https://script.google.com/macros/s/AKfycbzAJMPBDY-r4yFLpIJ_Bkiflg8ltmNW1D4DhdfShukpxWUnczclC4ldQmCE6JN-oFVcKg/exec';
        $this->client = new \GuzzleHttp\Client();
    }

    function sendEmail($email,$subject,$body)
    {

        try{

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $this->url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "sk": "'.$this->secrete_key.'",
                "email": "'.$email.'",
                "subject": "'.$subject.'",
                "body": "'.$body.'"
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
        }catch(\Exception $e){
            return $e;
        }
    }

}
