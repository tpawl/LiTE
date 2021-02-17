<?php
// Copyright (c) 2017 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Assertion\Assertion;
use TPawl\LiTE\Exceptions\AssertionException;

class AssertionsTest extends TestCase
{   
    public function testAssertNeverReachesHereThrowsAnException()
    {
        $this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertion::assertNeverReachesHere('abc');
    }
    
    public function testAssertNotNull()
    {
        Assertion::assertNotNull('not null');
        
        $this->assertTrue(true);
    }
    
    public function testAssertNotNullThrowsAnException()
    {
        $this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertion::assertNotNull(null, 'abc');
    }
    
    public function testAssertNotEmptyString()
    {
        Assertion::assertNotEmptyString('not empty');
        
        $this->assertTrue(true);
    }
    
    public function testAssertNotEmptyStringThrowsAnException()
    {
        $this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertion::assertNotEmptyString('', 'abc');
    }
}
