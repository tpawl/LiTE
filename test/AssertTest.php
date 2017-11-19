<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use tpawl\lite\Assert\Assert;

class AssertTest extends TestCase
{
    /**
     * @expectedException tpawl\lite\Exceptions\AssertException
     */
    public function testTrueConditionThrowsAnException()
    {
        Assert::isFalse(true);
    }
}
