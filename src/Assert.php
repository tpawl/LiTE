<?php
// Copyright (c) 2016, 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace Felix\Packages\LiTE\Assert;

use Felix\Packages\LiTE\Exceptions\AssertException;

class Assert
{
    /**
     * @param int $value
     * @return void
     */
    public static function notEqualsZero(int $value): void
    {
        self::isTrue($value !== 0);
    }

    /**
     * @param bool $condition
     * @return void
     */
    public static function isTrue(bool $condition): void
    {
        if (!$condition) {

            throw new AssertException('Assertion failed');
        }
    }
}
