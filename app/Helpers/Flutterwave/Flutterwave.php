<?php

namespace App\Helpers\Flutterwave;

use Illuminate\Support\Facades\Http;

class Flutterwave{

    protected $publicKey;
    protected $secretKey;
    protected $baseUrl;
    protected $encryptionKey;


    function __construct()
    {
        $this->setPublicKey();
        $this->setSecretKey();
        $this->setBaseUrl();
        $this->setEncryptionKey();
    }

    public function generateReference(String $transactionPrefix = NULL)
    {
        if ($transactionPrefix) {
            return $transactionPrefix . '_' . uniqid(time());
        }

        return 'flw_' . uniqid(time());
    }

    public function initializePayment(array $data)
    {
        $payment = Http::withToken($this->secretKey)->post(
            $this->baseUrl . '/payments',
            $data
        )->json();

        return $payment;
    }

    public function getTransactionIDFromCallback()
    {
        $transactionID = request()->transaction_id;

        if (!$transactionID) {
            $transactionID = json_decode(request()->resp)->data->id;
        }

        return $transactionID;
    }

    public function validateCharge(array $data)
    {

        $payment = Http::withToken($this->secretKey)->post(
            $this->baseUrl . '/validate-charge',
            $data
        )->json();

        return $payment;
    }

    public function verifyTransaction($id)
    {
        $data =  Http::withToken($this->secretKey)->get($this->baseUrl . "/transactions/" . $id . '/verify')->json();
        return $data;
    }

    public function verifyWebhook()
    {
        // Process Webhook. https://developer.flutterwave.com/reference#webhook
        if (request()->header('verif-hash')) {
            // get input and verify signature
            $flutterwaveSignature = request()->header('verif-hash');

            // confirm the signature is right
            if ($flutterwaveSignature == $this->secretHash) {
                return true;
            }
        }
        return false;
    }

    private function setPublicKey()
    {
        $this->publicKey = config('flutterwave.public_key') ? config('flutterwave.public_key') : settings()->flutterwave->public_key;
    }

    private function setSecretKey()
    {
        $this->secretKey = config('flutterwave.secret_key') ? config('flutterwave.secret_key') : settings()->flutterwave->secret_key;
    }

    private function setBaseUrl()
    {
        $this->baseUrl = config('flutterwave.base_url');
    }

    private function setEncryptionKey()
    {
        $this->encryptionKey = config('flutterwave.encryption_key')? config('flutterwave.encryption_key') : settings()->flutterwave->encryption_key;
    }
}
