<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Php\ConfigurationInterface;
use TPawl\LiTE\Miscellaneous\PackageErrorHandler;

class PackageErrorHandlerTest extends TestCase
{ 

    public function testErrorHandler()
    {
		$this->expectException(\ErrorException::class);
		$this->expectExceptionMessage('Test');
		
        $mock = $this->createMock(ConfigurationInterface::class);

        $mock->method('shouldErrorLevelBeReported')->
            willReturn(true);

        $eh = PackageErrorHandler::getErrorHandler($mock);

        call_user_func($eh, E_WARNING, 'Test', '', 0);
    }
}
