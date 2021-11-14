<?php
// Copyright (c) 2013 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class AsciiCharacterFunctions
{
    public static function isLowercase(int $ascii): bool
    {
        return $ascii >= AsciiCharacters::SMALL_A &&
            $ascii <= AsciiCharacters::SMALL_Z; // a-z (lowercase)
    }
}
