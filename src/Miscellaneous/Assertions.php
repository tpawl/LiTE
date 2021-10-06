<?php
// Copyright (c) 2016 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class Assertions
{   
    /**
     * @param bool $value
     * @throws \TPawl\LiTE\Exceptions\AssertionException if value is false
     */
    public static function assertTrue(
        bool $value, string $message = StringType::EMPTY_STRING): void
    {
        assert($value, self::computeMessage($message));
    }

    /**
     * @param mixed $value
     * @throws \TPawl\LiTE\Exceptions\AssertionException if value is null
     */
    public static function assertNotNull(
        $value, string $message = StringType::EMPTY_STRING): void
    {
        assert(!VariableFunctions::isNull($value), self::computeMessage($message));
    }

    /**
     * @throws \TPawl\LiTE\Exceptions\AssertionException if string is empty
     */
    public static function assertNotEmptyString(
        string $string, string $message = StringType::EMPTY_STRING): void
    {
        assert(!StringType::isEmptyString($string), self::computeMessage($message));
    }

    /**
     * @throws \TPawl\LiTE\Exceptions\AssertionException anyway
     */
    public static function assertNeverReachesHere(
        string $message = StringType::EMPTY_STRING): void
    {   
        assert(false, self::computeMessage($message);
    }

    private static function computeMessage(string $message): string
    {
        return PackageMessages::packagizeMessage(
            self::normalizeMessage($message));
    }
               
    private static function normalizeMessage(string $message): string
    {
        return (StringType::isEmptyString($message)) ?
            PackageMessages::DEFAULT_ASSERTION_MESSAGE : $message;
    }
}
