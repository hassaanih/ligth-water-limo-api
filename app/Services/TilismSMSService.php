<?php

namespace App\Services;

use App\Components\Sms\Contracts\SMSServiceContract;
use App\Helpers\TilismHelper;
use Illuminate\Support\Facades\Log;

class TilismSMSService implements SMSServiceContract
{
    public function send($phone, $message)
    {
        TilismHelper::sendSms(str_replace('+', '', $phone), $message);
    }
}
