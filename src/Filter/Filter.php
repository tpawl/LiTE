<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Filter;

use TPawl\LiTE\Miscellaneous\Assertions;

class Filter implements FilterInterface
{
    private const ASCII_LOWER_A = 97;
    private const ASCII_LOWER_Z = 122;
    private const ASCII_UNDERSCORE = 95;
    
    private const REMAINING_VALID_NAME_CHARACTERS =
        'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';

    /**
     * @param string $name
     * @return bool
     * @throws \TPawl\LiTE\Exceptions\AssertionException if name is empty
     */
    public function isValidName(string $name): bool
    {
        $ascii = ord($name);

        return ($ascii >= self::ASCII_LOWER_A && $ascii <= self::ASCII_LOWER_Z ||
            $ascii === self::ASCII_UNDERSCORE) &&
            (strspn($name, self::REMAINING_VALID_NAME_CHARACTERS, 1) ===
            strlen($name) - 1);
    }
}
