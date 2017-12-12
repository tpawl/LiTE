<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Php;

interface ConfigurationInterface
{   
    public function shouldErrorLevelBeReported(int $errorLevel): bool;
}
