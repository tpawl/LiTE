<?php
// Copyright (c) 2016, 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Asser;

use tpawl\lite\Exceptions\AssertException;

class Assert
{
    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __construct()
    {
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
