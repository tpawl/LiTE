<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Filter;

use TPawl\LiTE\Assert\Assert;

class Filter implements FilterInterface
{
    private const REMAINING_VALID_NAME_CHARACTERS =
        'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';
    
    /**
     * @param string $name
     * @return bool
     * @throws \TPawl\LiTE\Exceptions\AssertException
     */
    public function isValidName(string $name): bool
    {
        $nameLength = strlen($name);

        Assert::notEqualsZero($nameLength, 'Name must not be empty');

        return self::isFirstCharacterOfNameValid($name) ?
            strspn($name, self::REMAINING_VALID_NAME_CHARACTERS, 1) === 
                $nameLength - 1 :
            false;
    }
    
    /**
     * @param string $name
     * @return bool;
     */
    private static function isFirstCharacterOfNameValid(string $name): bool
    {
        $ascii = ord($name);

        return $ascii >= 97 && $ascii <= 122 || // a - z
            $ascii >= 65 && $ascii <= 90 || // A - Z
            $ascii === 95; // _
    }
}
