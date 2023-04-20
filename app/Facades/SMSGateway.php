<?php

namespace App\Facades;

use App\Services\Contracts\SMSServiceContract;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;

class SMSGateway extends Facade
{
    /***
      Get the registered name of the component.

      @return string
     */
    protected static function getFacadeAccessor()
    {
        Log::info('Sms Gateway');
        return SMSServiceContract::class;
    }
}
