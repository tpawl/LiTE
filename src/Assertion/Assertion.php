<?php
// Copyright (c) 2016 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Assertion;

use TPawl\LiTE\Exceptions\AssertionException;

class Assertion
{
    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    public static function assertNeverReachesHere(string $message = ''): void
    {
        self::assertIsFalse(true, $message);
    }
    
    /**
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws \TPawl\LiTE\Exceptions\AssertionException if value is null
     */
    public static function notIsNull($value, string $message = ''): void
    {
        self::assertIsFalse(is_null($value), $message);
    }

    /**
     * @param string $string
     * @param string $message
     * @return void
     * @throws \TPawl\LiTE\Exceptions\AssertionException if string is empty
     */
    public static function notIsEmptyString(string $string,
        string $message = ''): void
    {
        self::assertIsFalse(strlen($string) === 0, $message);
    }

    /**
     * @param bool $condition
     * @param string $message
     * @return void
     * @throws \TPawl\LiTE\Exceptions\AssertionException if condition is true
     */
    public static function assertIsFalse(bool $condition, string $message = ''): void
    {
        if ($condition) {

            throw new AssertionException($message);
        }
    }
}
