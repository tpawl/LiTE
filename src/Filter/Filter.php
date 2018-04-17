<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Filter;

use TPawl\LiTE\Assert\Assert;

class Filter implements FilterInterface
{
    /**
     * @param string $name
     * @return bool
     * @throws \TPawl\LiTE\Exceptions\AssertException
     */
    public function isValidName(string $name): bool
    {
        $nameLength = strlen($name);

        Assert::notEqualsZero($nameLength, 'Name must not be empty');

        $ascii = ord($name);

        if (!($ascii >= 97 && $ascii <= 122 || // a - z
            $ascii >= 65 && $ascii <= 90 || // A - Z
            $ascii === 95)) { // _

            return false;
        }
        return strspn($name,
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_',
            1) === $nameLength - 1;
    }
}
