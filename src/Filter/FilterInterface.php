<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Filter;

interface FilterInterface
{
    /**
     * @param string $name
     * @return bool
     */
    public function isValidName(string $name): bool;
}
