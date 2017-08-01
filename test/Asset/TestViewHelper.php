<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

use LiTE\ViewHelperInterface;

class TestViewHelper implements ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        print 'Test';
    }
}
