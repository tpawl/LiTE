<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

use tpawl\lite\ViewHelperInterface;

class xxxViewHelper implements ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        print 'abc';
    }
}