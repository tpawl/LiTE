<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Assertion\Assertion;
use TPawl\LiTE\Exceptions\AssertionException;

class AssertionTest extends TestCase
{   
    public function testAssertNeverReachesHereThrowsAnException()
    {
        $this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertion::assertNeverReachesHere('abc');
    }
    
    public function testAssertNotIsNull()
    {
        Assertion::assertNotIsNull('notNull');
        
        $this->assertTrue(true);
    }
    
    public function testAssertNotIsNullThrowsAnException()
    {
        $this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertion::assertNotIsNull(null, 'abc');
    }
    
    public function testAssertNotIsEmptyString()
    {
        Assertion::assertNotIsEmptyString('notEmpty');
        
        $this->assertTrue(true);
    }
    
    public function testAssertNotIsEmptyStringThrowsAnException()
    {
        $this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertion::assertNotIsEmptyString('', 'abc');
    }
}
