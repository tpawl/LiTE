<?php
// Copyright (c) 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace Felix\Packages\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use LiTE\Context\ViewHelperContext;
use LiTE\Filter\FilterInterface;

class ViewHelperContextTest extends TestCase
{
    /**
     * @expectedException LiTE\Exceptions\ViewHelperContextException
     */
    public function testInvalidNameThrowsAnException()
    {    
        $viewHelperContext = new ViewHelperContext('', '', null);

        $filter = $this->createMock(FilterInterface::class);

        $filter->method('isValidName')->
            willReturn(false);

        $viewHelperContext->execute('', [], $filter);
    }
}
