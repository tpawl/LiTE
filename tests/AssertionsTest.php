<?php
// Copyright (c) 2017 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Miscellaneous\Assertions;
use TPawl\LiTE\Exceptions\AssertionException;

class AssertionsTest extends TestCase
{   
    public function testAssertNeverReachesHereThrowsAnException()
    {
        $this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertions::assertNeverReachesHere('abc');
    }
    
    public function testAssertNotNull()
    {
        Assertions::assertNotNull('not null');
        
        $this->assertTrue(true);
    }
    
    public function testAssertNotNullThrowsAnException()
    {
        $this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertions::assertNotNull(null, 'abc');
    }
    
    public function testAssertNotEmptyString()
    {
        Assertions::assertNotEmptyString('not empty');
        
        $this->assertTrue(true);
    }
    
    public function testAssertNotEmptyStringThrowsAnException()
    {
        $this->expectException(AssertionException::class);
		$this->expectExceptionMessage('abc');
		
        Assertions::assertNotEmptyString('', 'abc');
    }
}
