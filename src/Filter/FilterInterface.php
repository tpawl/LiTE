<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace Felix\Packages\LiTE\Filter;

interface FilterInterface
{
    /**
     * @param string $name
     * @return bool
     */
    public function isValidName(string $name): bool;
}
