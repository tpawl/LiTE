<?php
// Copyright (c) 2016 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Assert;

use TPawl\LiTE\Exceptions\AssertException;

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
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws \TPawl\LiTE\Exceptions\AssertException
     */
    public static function notIsNull($value, string $message = ''): void
    {
        self::isFalse(is_null($value), $message);
    }
    
    /**
     * @param string $string
     * @param string $message
     * @return void
     * @throws \TPawl\LiTE\Exceptions\AssertException
     */
    public static function notIsEmptyString(string $string, string $message = ''): void
    {
        self::isFalse(strlen($string) === 0, $message);
    }

    /**
     * @param bool $condition
     * @param string $message
     * @return void
     * @throws \TPawl\LiTE\Exceptions\AssertException
     */
    public static function isFalse(bool $condition, string $message = ''): void
    {
        if ($condition) {

            throw new AssertException($message);
        }
    }
}
