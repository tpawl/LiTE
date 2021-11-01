<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Filter;

use TPawl\LiTE\Exceptions\FilterException;
use TPawl\LiTE\Miscellaneous\StringType;

class Filter implements FilterInterface
{
    private const ASCII_LOWER_A = 97;
    private const ASCII_LOWER_Z = 122;
    private const ASCII_UNDERSCORE = 95;
    
    public function filterName(string $name): void
    {
        if (!self::isValidName($name)) {
        
            throw new FilterException(/*...*/);
        }
    }
    
    private static function isValidName(string $name): bool
    {
        $ascii = ord($name);

        return ($ascii >= self::ASCII_LOWER_A && $ascii <= self::ASCII_LOWER_Z || // a-z
            $ascii === self::ASCII_UNDERSCORE) && // _ (is first character of string valid?)
            StringType::isAlphabeticNumeric(substr($name, 1)); // (is rest of string valid?)
    }
}
