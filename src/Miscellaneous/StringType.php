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
    
    public static function isBeginningWith(string $string, string $str): bool
    {
        $length = strlen($string);
        $len = strlen($str);
        
        if ($length < $len) {
            
            return false;
        }
        return substr($string, 0, $len) === $str;
    }
    
    public static function getLastCharacter(string $string): string
    {
        $stringLength = strlen($string);
        
        if ($stringLength === 0) {
            
            throw new OutOfBoundsException('Try to get character form empty string.');
        }
        return $string[$stringLength - 1];
    }
}
