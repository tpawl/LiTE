<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Php;

class Configuration
{
    public function shouldErrorLevelReport(int errorLevel): bool
    {
        error_reporting() & $errorLevel;
    }
}
