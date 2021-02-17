<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Miscellaneous\StringType;

class StringTypeTest extends TestCase
{   
    public function testIsEmptyStringReturnsTrue()
    {
        $this->assertTrue(StringType::isEmptyString(''));
    }
    
    public function testIsEmptyStringReturnsFalse()
    {   
        $this->assertFalse(StringType::isEmptyString('abc'));
    }
    
    public function testEmptyString()
    {
        $this->assertTrue(StringType::isEmptyString(StringType::EMPTY_STRING));
    }
}
