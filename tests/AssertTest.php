<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Assertion\Assertion;

class AssertTest extends TestCase
{
    /**
     * @expectedException TPawl\LiTE\Exceptions\AssertException
     * @expectedExceptionMessage abc
     */
    public function testTrueConditionThrowsAnException()
    {
        Assertion::isFalse(true, 'abc');
    }
}
