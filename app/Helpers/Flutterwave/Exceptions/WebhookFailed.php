<?php


namespace App\Helpers\Flutterwave\Exceptions;

use App\Models\FlutterwaveWebhookCall;
use Exception;

class WebhookFailed extends Exception
{
    public static function missingType()
    {
        return new static('The webhook call did not contain a type. Valid Flutterwave webhook calls should always contain a type.');
    }

    public function render($request)
    {
        return response(['error' => $this->getMessage()], 400);
    }

    public static function jobClassDoesNotExist(string $jobClass, FlutterwaveWebhookCall $webhookCall)
    {
        return new static("Could not process webhook id `{$webhookCall->id}` of type `{$webhookCall->type} because the configured jobclass `$jobClass` does not exist.");
    }
}
