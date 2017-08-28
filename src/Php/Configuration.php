<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Php;

use LiTE\DesignPatterns\Singleton;


class Configuration extends Singleton
{   
    public function shouldErrorLevelReport(int $errorLevel): bool
    {
        return (bool) (error_reporting() & $errorLevel);
    }
}
