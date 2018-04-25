<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Filter;

interface FilterInterface
{
    /**
     * @param string $name
     * @return bool
     * @throws \TPawl\LiTE\Exceptions\AssertionException if name is empty
     */
    public function isValidName(string $name): bool;
}
