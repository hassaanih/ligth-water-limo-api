<?php

namespace App\Helpers;

class CommonHelper
{

    /**
     * remove NULL values
     *
     * @return array
     */
    static function filterEmptyValues($var)
    {
        return array_filter($var,  function($var) {
            return ($var !== NULL && $var !== FALSE && $var !== "");
        });
    }
}
