<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

use tpawl\lite\ViewHelperInterface;

class ExceptionViewHelper implements ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        throw new RuntimeException();
    }
}