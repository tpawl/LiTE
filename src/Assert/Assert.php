<?php
// Copyright (c) 2016, 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Assert;

use LiTE\Exceptions\AssertException;

class Assert
{
    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __construct()
    {
        echo '*';
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
