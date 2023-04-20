<?php

namespace App\Providers;

use App\Services\NullSMSService;
use App\Services\TilismSMSService;
use App\Services\TwilioSMSService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Services\Contracts\SMSServiceContract::class,
            function ($app) {
                if (env("SMS_DRIVER") == 'twilio') {
                    return new TwilioSMSService();
                } else if (env("SMS_DRIVER") == 'tilism') {
                    return new TilismSMSService();
                } else {
                    return new NullSMSService();
                }
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
