<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

use PHPUnit\Framework\TestCase;
use tpawl\lite\Assert\Assert;

class AssertTest extends TestCase
{
    /**
     * @expectedException LiTE\Exceptions\AssertException
     */
    public function testTrueConditionThrowsAnException()
    {
        Assert::isFalse(true);
    }
}
