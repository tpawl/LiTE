<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Miscellaneous\FileSystem;
use TPawl\LiTE\Exceptions\FileSystemException;

class FileSystemTest extends TestCase
{
    public function testAppendDirectorySeparator()
    {
        $return = FileSystem::appendDirectorySeparator('abc');
        
        if (PHP_OS_FAMILY === 'Windows') {
            
            $this->assertEquals($return, 'abc\\');
        
        } else {
            
            $this->assertEquals($return, 'abc/');
        }
    }
    
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
    
    public function testIsEndingWithDirectorySeparatorReturnsFalse1()
    {
        $result = FileSystem::IsEndingWithDirectorySeparator('');
        
        $this->assertFalse($result);
    }
    
    public function testIsEndingWithDirectorySeparatorReturnsFalse2()
    {
        $result = FileSystem::IsEndingWithDirectorySeparator('abc');
        
        $this->assertFalse($result);
    }
    
    public function testIsEndingWithDirectorySeparatorReturnsTrue()
    {
        $result = FileSystem::IsEndingWithDirectorySeparator('abc' . DIRECTORY_SEPARATOR);
        
        $this->assertTrue($result);
    }
}
