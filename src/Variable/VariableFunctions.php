<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Variable;

class VariableFunctions
{
    /**
     * @param mixed $variable
     */
    public static function isNulls($variable): bool
    {
        return is_null($variable);
    }
}
