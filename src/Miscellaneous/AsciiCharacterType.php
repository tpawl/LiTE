<?php
// Copyright (c) 2013 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class AsciiCharacterType
{
    private const SMALL_A = 97; // ord('a')
    private const SMALL_Z = 122; // ord('z')
    
    public const UNDERSCORE = 95; // ord('_')
    
    private const DELTA_UPPER_TO_LOWER_CASE = 32;
    
    public static function isLowerCase(int $ascii): bool
    {
        return $ascii >= self::SMALL_A && $ascii <= self::SMALL_Z;
    }
}
