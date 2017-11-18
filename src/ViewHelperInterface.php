<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace tpawl\lite;

interface ViewHelperInterface
{
    /**
     * @param array $arguments
     * @return void
     * @throws \RuntimeException
     */
    public static function execute(array $arguments): void;
}
