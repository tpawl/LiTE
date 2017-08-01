<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Tests;

require_once __DIR__ . '/../src/Filter/FilterInterface.php';
require_once __DIR__ . '/../src/Filter/Filter.php';
require_once __DIR__ . '/../src/Assert/Assert.php';
require_once __DIR__ . '/../src/Exceptions/AssertException.php';

use PHPUnit\Framework\TestCase;
use LiTE\Filter\Filter;

class FilterTest extends TestCase
{
    /**
     * @expectedException LiTE\Exceptions\AssertException
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
}
