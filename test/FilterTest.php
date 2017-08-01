<?php

declare(strict_types=1);

namespace Felix\Packages\LiTE\Tests;

require_once __DIR__ . '/../src/Filter/FilterInterface.php';
require_once __DIR__ . '/../src/Filter/Filter.php';
require_once __DIR__ . '/../src/Assert/Assert.php';
require_once __DIR__ . '/../src/Exceptions/AssertException.php';

use PHPUnit\Framework\TestCase;
use LiTE\Filter\Filter;

class FilterTest extends TestCase
{
    /**
     * @expectedException Felix\Packages\LiTE\Exceptions\AssertException
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
