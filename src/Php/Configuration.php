<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Php;

class Configuration implements ConfigurationInterface
{
    public function shouldErrorLevelBeReported(int $errorLevel): bool
    {
        return (bool) (error_reporting() & $errorLevel);
    }
}
