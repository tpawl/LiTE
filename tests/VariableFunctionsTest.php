<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Miscellaneous\VariableFunctions;

class VariableFunctionsTest extends TestCase
{
    public function testIsNullReturnsTrue()
    {
        $this->assertTrue(VariableFunctions::isNull(null));
    }

    public function testIsNullReturnsFalse()
    {
        $this->assertFalse(VariableFunctions::isNull('not null'));
    }
}
