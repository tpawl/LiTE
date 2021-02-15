<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Assertion\Assertion;
use TPawl\LiTE\Exceptions\AssertionException;

class AssertionTest extends TestCase
{
    public function testAssertIsFalse()
    {
        Assertion::assertIsFalse(false);
        
        $this->assertTrue(true);
    }
    
    public function testAssertIsFalseThrowsAnException()
    {
		$this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertion::assertIsFalse(true, 'abc');
    }
    
    public function testAssertNeverReachesHereThrowsAnException()
    {
        $this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertion::assertNeverReachesHere('abc');
    }
}
