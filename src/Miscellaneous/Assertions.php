<?php
// Copyright (c) 2016 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

use TPawl\LiTE\Exceptions\AssertionException;

class Assertions
{
    /**
     * @param mixed $value
     * @throws \TPawl\LiTE\Exceptions\AssertionException if value is null
     */
    public static function assertNotNull(
        $value, string $message = StringType::EMPTY_STRING): void
    {
        if (VariableFunctions::isNull($value)) {

            self::assertNeverReachesHere($message);
        }
    }

    /**
     * @throws \TPawl\LiTE\Exceptions\AssertionException if string is empty
     */
    public static function assertNotEmptyString(
        string $string, string $message = StringType::EMPTY_STRING): void
    {
        if (StringType::isEmptyString($string)) {

            self::assertNeverReachesHere($message);
        }
    }

    /**
     * @throws \TPawl\LiTE\Exceptions\AssertionException anyway
     */
    public static function assertNeverReachesHere(
        string $message = StringType::EMPTY_STRING): void
    {
        throw new AssertionException('LiTE: ' . $message);
    }
}
