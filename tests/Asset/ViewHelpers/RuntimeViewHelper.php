<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

use TPawl\LiTE\ViewHelperInterface;

class RuntimeViewHelper implements ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        throw new RuntimeException();
    }
}
