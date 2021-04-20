<?php
// Copyright (c) 2013 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE;

use TPawl\LiTE\Miscellaneous\ArrayFunctions;

class PackageInformations
{
    private const SEMICOLON_SPACE = ': ';
    private const DOT = '.';
    private const COMMA_SPACE = ', ';
    
    public const PACKAGE_NAME = 'LiTE';

    public const PACKAGE_VERSION = [
        'major' => 2, // Major version number (major release)
        'minor' => 0, // Minor version number (minor release)
        'revision' => 0 // Revision number (patch level)
    ];
    public const PACKAGE_AUTHORS = ['Thomas Pawlitschko'];

    public const COPYRIGHT_YEARS = '2013 - 2021';
    public const COPYRIGHT_HOLDERS = ['Thomas Pawlitschko'];

    public const PACKAGE_LICENSE = 'MIT License';

    public static function prependPackageName(string $string): string
    {
        return self::PACKAGE_NAME . self::SEMICOLON_SPACE . $string;
    }
    
    public static function makePackageVersionString(): string
    {
        return ArrayFunctions::implodeWith(self::PACKAGE_VERSION, self::DOT);
    }
    
    public static function makePackageAuthorsString(): string
    {
        return self::implodeWithCommaSpace(self::PACKAGE_AUTHORS);
    }
    
    public static function makeCopyrightHoldersString(): string
    {
        return self::implodeWithCommaSpace(self::COPYRIGHT_HOLDERS);
    }
    
    private static function implodeWithCommaSpace(array $array): string
    {
        return ArrayFunctions::implodeWith($array, self::COMMA_SPACE);
    }
}
