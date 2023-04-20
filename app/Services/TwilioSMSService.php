<?php

namespace App\Services;

use App\Components\Sms\Contracts\SMSServiceContract;
use App\Helpers\TwilioHelper;
use Illuminate\Support\Facades\Log;

class TwilioSMSService implements SMSServiceContract
{
    public function send($phone, $message)
    {
        TwilioHelper::sendSms($phone, $message);
    }
}
