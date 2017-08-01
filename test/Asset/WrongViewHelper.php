<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

use LiTE\ViewHelperInterface;

class xxxViewHelper implements ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        print 'abc';
    }
}
