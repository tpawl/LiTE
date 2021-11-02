<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Filter;

use TPawl\LiTE\Exceptions\FilterException;
use TPawl\LiTE\Miscellaneous\StringType;
use TPawl\LiTE\Miscellaneous\PackageMessages;

class Filter implements FilterInterface
{   
    public function filterName(string $name, string $message): void
    {
        if (!self::isValidName($name)) {
        
            throw new FilterException(PackageMessages::packagizeMessage($message));
        }
    }
    
    private static function isValidName(string $name): bool
    {
        $ascii = ord($name);

        return (StringType::isLowerCase($ascii) || $ascii === StringType::ASCII_UNDERSCORE) && // is first character of string valid?
            StringType::isAlphabeticNumeric(substr($name, 1)); // is rest of string valid?
    }
}
