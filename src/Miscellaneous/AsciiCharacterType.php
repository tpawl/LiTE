<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class AsciiCharacterType
{
    private const SMALL_A = 97;
    private const SMALL_Z = 122;
    
    public const UNDERSCORE = 95;
    
    private const DELTA_UPPER_TO_LOWER_CASE = 32;
    
    public static function isLowerCase(int $ascii): bool
    {
        return $ascii >= self::SMALL_A && $ascii <= self::SMALL_Z;
    }
}
