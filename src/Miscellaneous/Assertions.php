<?php
// Copyright (c) 2016 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

use TPawl\LiTE\Exceptions\AssertionException;

class Assertions
{
    private const DEFAULT_MESSAGE = 'Assertion failed.';
    
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
        if (StringType::isEmptyString($message)) {
            
            $message = self::DEFAULT_MESSAGE;
        }
        throw new AssertionException(
            PackageMessages::packagizeMessage($message));
    }
}
