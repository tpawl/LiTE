<?php
// Copyright (c) 2016, 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Assert;

use LiTE\Exceptions\AssertException;

class Assert
{
    /**
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * @return void
     */
    public static function shouldNeverReachHere(): void
    {
        self::isFalse(true);
    }
    
    /**
     * @param int $value
     * @return void
     */
    public static function notEqualsZero(int $value): void
    {
        self::isFalse($value === 0);
    }

    /**
     * @param bool $condition
     * @return void
     */
    public static function isFalse(bool $condition): void
    {
        if ($condition) {

            throw new AssertException('Assertion failed');
        }
    }
}
