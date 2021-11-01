<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Filter;

interface FilterInterface
{
    /**
     * @throws \TPawl\LiTE\Exceptions\FilterException if name is not valid
     */
    public function filterName(string $name, string $message): void;
}
