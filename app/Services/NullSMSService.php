<?php

namespace App\Services;

use App\Components\Sms\Contracts\SMSServiceContract;
use Illuminate\Support\Facades\Log;

class NullSMSService implements SMSServiceContract
{
    public function send($phone, $message)
    {
        Log::info('Null Sms Service');
        return 'Null';
    }
}
