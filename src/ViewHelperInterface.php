<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE;

interface ViewHelperInterface
{
    /**
     * @param array $arguments
     * @return void
     * @throws \RuntimeException
     */
    public static function execute(array $arguments): void;
}
