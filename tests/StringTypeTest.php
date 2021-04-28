<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Miscellaneous\StringType;
use TPawl\LiTE\Exceptions\EmptyStringException;

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

    public function testGetLastCharacter()
    {
        $lastCharacter = StringType::getLastCharacter('abc');

        $this->assertEquals($lastCharacter, 'c');
    }

    public function testGetLastCharacterThrowsAnException()
    {
        $this->expectException(EmptyStringException::class);
        $this->expectExceptionMessage(
            'Try to get character from empty string.');

        StringType::getLastCharacter('');
    }
}
