<?php
// Copyright (c) 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Filter\Filter;

class FilterTest extends TestCase
{
    /**
     * @expectedException TPawl\LiTE\Exceptions\AssertException
     */
    public function testEmptyNameThrowsAnException()
    {
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
