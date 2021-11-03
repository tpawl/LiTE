<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

use TPawl\LiTE\Exceptions\EmptyStringException;
use TPawl\LiTE\PackageInformations;

class StringType
{
    private const ALPHABETIC_NUMERIC_SET =
        'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    
    public const EMPTY_STRING = '';
    
    public static function isEmptyString(string $string): bool
    {
        return empty($string);
    }
    
    public static function isAlphabeticNumeric(string $string): bool
    {
        return strspn($string, self::ALPHABETIC_NUMERIC_SET) === strlen($string);
    }
    
    public static function convertFirstCharacterToUppercase(string $string): string
    {
        $ascii = ord($string);
        
        if (AsciiCharacterFunctions::isLowercase($ascii)) {
        
            $string[0] = chr($ascii - AsciiCharacterFunctions::DELTA_UPPERCASE_TO_LOWERCASE);
        }
        return $string;
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
            
            throw new EmptyStringException(
                PackageInformations::prependPackageNameColonSpace(
                    'Try to get character from empty string.'));
        }
        return $string[$stringLength - 1];
    }
}
