<?php

namespace App\Services\Contracts;

interface SMSServiceContract
{
    /**
     * Send the given message to the given recipient.
     *
     * @return mixed
     */
    public function send($phone, $message);
}
