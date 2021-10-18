<?php
// Copyright (c) 2013 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class Assertions
{   
    /**
     * @throws \AssertionError if $boolean is false
     */
    public static function assertTrue(
        bool $boolean, string $message = StringType::EMPTY_STRING): void
    {
        assert($boolean, self::computeMessage($message));
    }

    /**
     * @param mixed $value
     * @throws \AssertionError if $value is null
     */
    public static function assertNotNull(
        $value, string $message = StringType::EMPTY_STRING): void
    {
        assert(!VariableFunctions::isNull($value),
            self::computeMessage($message));
    }

    /**
     * @throws \AssertionError if $string is empty string
     */
    public static function assertNotEmptyString(
        string $string, string $message = StringType::EMPTY_STRING): void
    {
        assert(!StringType::isEmptyString($string),
            self::computeMessage($message));
    }

    /**
     * @throws \AssertionError anyway
     */
    public static function assertNeverReachesHere(
        string $message = StringType::EMPTY_STRING): void
    {   
        assert(false, self::computeMessage($message));
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
