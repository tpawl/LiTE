<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\PackageInformations;

class PackageInformationsTest extends TestCase
{
    public function testPackageName()
    {
        $this->assertEquals(
            PackageInformations::prependPackageNameColonSpace('abc'),
                'LiTE: abc');
    }

    public function testPackageVersion()
    {
        $this->assertEquals(
            PackageInformations::makePackageVersionString(), '2.0.0');
    }

    public function testPackageAuthors()
    {
        $this->assertEquals(
            PackageInformations::makePackageAuthorsString(),
            'Thomas Pawlitschko');
    }

    public function testPackageCopyrightYears()
    {
        $this->assertEquals(
            PackageInformations::PACKAGE_COPYRIGHT['years'], '2013 - 2021');
    }

    public function testPackageCopyrightHolders()
    {
        $this->assertEquals(
            PackageInformations::makePackageCopyrightHoldersString(),
            'Thomas Pawlitschko');
    }

    public function testPackageLicense()
    {
        $this->assertEquals(
            PackageInformations::PACKAGE_LICENSE, 'MIT License');
    }
}
