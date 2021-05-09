<?php

namespace src\lib;

class Utils
{
    public static function stroToPascalCase(string $input)
    {
        $pattern = '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!';
        preg_match_all($pattern, $input, $matches);

        $ret = $matches[0];

        foreach ($ret as &$match) {
            $match = $match == strtoupper($match)
                ? strtolower($match)
                : lcfirst($match);
        }

        return implode('_', $ret);
    }

    public static function hasEmpty($fields)
    {
        foreach ($fields as $field) {
            if (in_array($field, ['', null])) {
                return true;
            }
        }

        return false;
    }

    public static function compress($buffer)
    {
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        $buffer = str_replace(["\r\n", "\r", "\n", "\t", '  ', '    ', '    '], '', $buffer);

        return $buffer;
    }
}
