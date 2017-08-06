<?php
// Copyright (c) 2016, 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace Felix\Packages\LiTE\Assert;

use Felix\Packages\LiTE\Exceptions\AssertException;

class Assert
{
    /**
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * @param string $message
     * @return void
     */
    public static function shouldNeverReachHere(string $message = ''): void
    {
        self::isFalse(true, $message);
    }

    /**
     * @param int $value
     * @param string $message
     * @return void
     */
    public static function notEqualsZero(int $value, string $message = ''): void
    {
        self::isFalse($value === 0, $message);
    }

    /**
     * @param bool $condition
     * @param string $message
     * @return void
     */
    public static function isFalse(bool $condition, string $message = ''): void
    {
        if ($condition) {

            throw new AssertException($message);
        }
    }
}

