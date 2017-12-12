<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

use TPawl\LiTE\ViewHelperInterface;

class TestViewHelper implements ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        print 'ghi';
    }
}
