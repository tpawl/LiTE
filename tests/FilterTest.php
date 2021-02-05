<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Filter\Filter;
use TPawl\LiTE\Exceptions\AssertionException;

class FilterTest extends TestCase
{
    public function testEmptyNameThrowsAnException()
    {
		$this->expectException(AssertionException::class);
		$this->expectExceptionMessage('Name must not be empty');
		
        $filter = new Filter();

        $filter->isValidName('');
    }

    public function testFirstInvalidCharacterOfNameReturnsFalse()
    {
        $filter = new Filter();

        $isValidName = $filter->isValidName('3');

        $this->assertFalse($isValidName);
    }

    public function testNotFirstInvalidCharacterOfNameReturnsFalse()
    {
        $filter = new Filter();

        $isValidName = $filter->isValidName('abc#');

        $this->assertFalse($isValidName);
    }

    public function testValidCharactersOfNameReturnTrue()
    {
        $filter = new Filter();

        $isValidName = $filter->isValidName('abc');

        $this->assertTrue($isValidName);
    }
}
