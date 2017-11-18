<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace tpawl\lite\Php;

interface ConfigurationInterface
{   
    public function shouldErrorLevelBeReported(int $errorLevel): bool;
}
