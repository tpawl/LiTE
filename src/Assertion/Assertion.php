<?php
// Copyright (c) 2016 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Assertion;

use TPawl\LiTE\Exceptions\AssertionException;

class Assertion
{
	/**
     * @throws \TPawl\LiTE\Exceptions\AssertionException anyway
     */
    public static function assertNeverReachesHere(string $message = ''): void
    {
        self::assertIsFalse(true, $message);
    }
    
    /**
     * @param mixed $value
     * @throws \TPawl\LiTE\Exceptions\AssertionException if value is null
     */
    public static function assertNotIsNull($value, string $message = ''): void
    {
        self::assertIsFalse(is_null($value), $message);
    }

    /**
     * @throws \TPawl\LiTE\Exceptions\AssertionException if string is empty
     */
    public static function assertNotIsEmptyString(
	    string $string, string $message = ''): void
    {
        self::assertIsFalse(strlen($string) === 0, $message);
    }

    /**
     * @throws \TPawl\LiTE\Exceptions\AssertionException if condition is true
     */
    public static function assertIsFalse(
	    bool $condition, string $message = ''): void
    {
        if ($condition) {

            throw new AssertionException($message);
        }
    }
}
