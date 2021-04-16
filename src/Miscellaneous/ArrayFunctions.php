<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class ArrayFunctions
{
    public static function implodeWith(array $array, string $separator = StringType::EMPTY_STRING): string
    {
        return implode($separator, $array);
    }
}
