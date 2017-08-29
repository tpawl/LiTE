<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Php;

use LiTE\Php\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{   
    public function shouldErrorLevelBeReported(int $errorLevel): bool
    {
        return (bool) (error_reporting() & $errorLevel);
    }
}
