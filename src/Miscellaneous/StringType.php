<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class StringType
{
    public const EMPTY_STRING = '';

    public static function isEmptyString(string $string): bool
    {
        return empty($string);
    }
    
    public static function isBeginningWith(string $string, string $str): string
    {
        $length = strlen($string);
        $len = strlen($str);
        
        if ($length < $len) {
            
            return false;
        }
        return substr($string, 0, $len) === $str;
    }
}
