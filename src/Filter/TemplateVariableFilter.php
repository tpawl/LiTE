<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Filter;

use TPawl\LiTE\Exceptions\FilterException;
use TPawl\LiTE\Miscellaneous\AsciiCharacterFunctions;
use TPawl\LiTE\Miscellaneous\StringType;
use TPawl\LiTE\Miscellaneous\PackageMessages;

class TemplateVariableFilter implements FilterInterface
{   
    public function filterName(string $name): void
    {
        if (!self::isValidName($name)) {
        
            throw new FilterException(
                PackageMessages::packagizeMessage(
                    "Invalid template variable name '{$name}'"));
        }
    }
    
    public static function isValidName(string $name): bool
    {
        return AsciiCharacterFunctions::isLowercase(ord($name)) && // is first character of string valid?
            StringType::isAlphabeticNumeric(substr($name, 1)); // is rest of string valid?
    }
}
