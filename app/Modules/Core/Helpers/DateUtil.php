<?php

namespace App\Modules\Core\Helpers;

use Carbon\Carbon;

/**
 * @author Yuana <andhikayuana@gmail.com>
 * @since Sat, 17 Feb 2018
 *
 * Note :
 *  1. sudo locale-gen id_ID.UTF-8
 *  2. sudo dpkg-reconfigure locales
 */

class DateUtil
{
    private static $instance;

    private function __construct()
    {
        Carbon::setLocale('id');
    }

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function createFromFormat($date, $inputFormat, $outputFormat)
    {
        return Carbon::createFromFormat($inputFormat, $date)->format($outputFormat);
    }

    public function parseSimpleDate(String $date, $format = 'Y-m-d')
    {
        $date = str_replace('/', '-', $date);
        return date($format, strtotime($date));
    }
}
