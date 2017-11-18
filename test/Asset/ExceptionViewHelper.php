<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

use tpawl\lite\ViewHelperInterface;

class ExceptionViewHelper implements ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        throw new RuntimeException();
    }
}
