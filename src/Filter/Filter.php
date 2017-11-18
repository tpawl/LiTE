<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace tpawl\lite\Filter;

use tpawl\lite\Assert\Assert;

class Filter implements FilterInterface
{
    /**
     * @param string $name
     * @return bool
     */
    public function isValidName(string $name): bool
    {
        $nameLength = strlen($name);

        Assert::notEqualsZero($nameLength);

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
