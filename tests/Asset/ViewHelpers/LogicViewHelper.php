<?php
// Copyright (c) 2018 by Thomas Pawlitschko. (MIT License)

use TPawl\LiTE\ViewHelperInterface;

class LogicViewHelper implements ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        throw new LogicException('abc');
    }
}
