<?php

namespace App\Modules\Core\Helpers;

/**
 * @author Yuana <andhikayuana@gmail.com>
 * @since Sat, 17 Feb 2018
 */

class NumberingUtil
{
    private static $instance;

    public static $romawi = [
        '', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X',
        20 => 'XX', 30 => 'XXX', 40 => 'XL', 50 => 'L', 60 => 'LX', 70 => 'LXX',
        80 => 'LXXX', 90 => 'XC', 100 => 'C', 200 => 'CC', 300 => 'CCC', 400 => 'CD',
        500 => 'D', 600 => 'DC', 700 => 'DCC', 800 => 'DCCC', 900 => 'CM', 1000 => 'M',
        2000 => 'MM', 3000 => 'MMM'
    ];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function decimalToRomawi($number)
    {
        $result = '';

        if (array_key_exists($number, self::$romawi)) {

            $result = self::$romawi[$number];

        } elseif ($number >= 11 && $number <= 99) {

            $i = $number % 10;
            $result = self::$romawi[$number - $i] . $this->decimalToRomawi($number % 10);

        } elseif ($number >= 101 && $number <= 999) {

            $i = $number % 100;
            $result = self::$romawi[$number - $i] . $this->decimalToRomawi($number % 100);

        } else {

            $i = $number % 1000;
            $result = self::$romawi[$number - $i] . $this->decimalToRomawi($number % 1000);

        }

        return $result;
    }

    public function generateCode($prefix)
    {
        return $prefix . '-' . str_random(5);
    }
}
