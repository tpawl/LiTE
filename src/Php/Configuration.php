<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Php;

class Configuration
{
    /**
     * @param int $errorLevel
     * @return bool
     */
    public static function shouldErrorLevelBeReported(int $errorLevel): bool
    {
        return (bool) (error_reporting() & $errorLevel);
    }
}
