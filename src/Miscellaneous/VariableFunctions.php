<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class VariableFunctions
{
    /**
     * @param mixed $value
     */
    public static function isNull($value): bool
    {
        return is_null($value);
    }
}
