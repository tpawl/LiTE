<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\String;

class StringType
{
    public const EMPTY_STRING = '';
    
    public static function isEmptyString(string $string): bool
    {
        return empty($string);
    }
}
    
