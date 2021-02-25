<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Miscellaneous\FileSystem;
use TPawl\LiTE\Exceptions\FileSystemException;

class FileSystemTest extends TestCase
{
    public function testMakeRealPathname()
    {
        $realPathname = FileSystem::makeRealPathname(
            __DIR__ . '/Asset/ViewHelpers');

        $this->assertTrue(true);
    }

    public function testMakeRealPathnameThrowsAnException()
    {
        $this->expectException(FileSystemException::class);
        $this->expectExceptionMessage('Could not make real pathname for');

        $realPathname = FileSystem::makeRealPathname(
            __DIR__ . '/Asset/NonExistingPath');
    }
}
