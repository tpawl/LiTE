<?php
// Copyright (c) 2016 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Assertion;

use TPawl\LiTE\Exceptions\AssertionException;

class Assertion
{   
    /**
     * @param mixed $value
     * @throws \TPawl\LiTE\Exceptions\AssertionException if value is null
     */
    public static function assertNotIsNull($value, string $message = ''): void
    {
        if (is_null($value)) {
            
            self::assertNeverReachesHere($message);
        }
    }

    /**
     * @throws \TPawl\LiTE\Exceptions\AssertionException if string is empty
     */
    public static function assertNotIsEmptyString(
	    string $string, string $message = ''): void
    {
        if (empty($string)) {
            
            self::assertNeverReachesHere($message);
        }
    }
    
    /**
     * @throws \TPawl\LiTE\Exceptions\AssertionException anyway
     */
    public static function assertNeverReachesHere(string $message = ''): void
    {
        throw new AssertionException($message);
    }
}
