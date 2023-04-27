<?php


namespace Superscript;


class Converter
{
    private static $mapping = [
        '1' => '&#185;',
        '2' => '&#xb2;',
        '3' => '&#xb3;',

        '0' => '&#x2070;',
        'i' => '&#x2071;',

        '4' => '&#x2074;',
        '5' => '&#x2075;',
        '6' => '&#x2076;',
        '7' => '&#x2077;',
        '8' => '&#x2078;',
        '9' => '&#x2079;',

        '+' => '&#x207A;',
        '-' => '&#x207B;',
        '=' => '&#x207C;',
        '(' => '&#x207D;',
        ')' => '&#x207E;',
        'n' => '&#x207F;',
    ];

    /**
     * @param $number
     * @throws Exception
     *
     * @return string
     */
    public static function getHtmlEntities($number)
    {
        if (preg_match('/[^0-9in\(\)\=\-\+]+/', $number)) {
            throw new Exception('Superscript utf-8 does not contain this characters');
        }

        $result = '';

        foreach (str_split($number) as $char) {
            $result .= static::map($char);
        }

        return $result;
    }

    protected static function map($char)
    {
        return static::$mapping[$char];
    }
}
