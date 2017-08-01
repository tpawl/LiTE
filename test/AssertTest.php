<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Assert\Assert;

class AssertTest extends TestCase
{
    /**
     * @expectedException LiTE\Exceptions\AssertException
     */
    public function testTrueConditionThrowsAnException()
    {
        Assert::isFalse(true);
    }

    public function testFalseConditionDoesNothing()
    {
        Assert::isFalse(false);
        
        $this->assertTrue(true);
    }
}
