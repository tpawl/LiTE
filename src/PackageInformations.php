<?php
// Copyright (c) 2013 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE;

class PackageInformations
{
    private const SEMICOLON_SPACE = ': ';
    private const DOT = '.';
    private const COMMA_SPACE = ', ';
    
    public const PACKAGE_NAME = 'LiTE';

    // Major version number (major release)
    public const MAJOR_VERSION = 2;
    // Minor version number (minor release)
    public const MINOR_VERSION = 0;
    // Revision number (patch level)
    public const REVISION_NUMBER = 0;

    public const PACKAGE_AUTHORS = ['Thomas Pawlitschko'];

    public const COPYRIGHT_YEARS = '2013 - 2021';
    public const COPYRIGHT_HOLDERS = ['Thomas Pawlitschko'];

    public const PACKAGE_LICENSE = 'MIT License';

    public static function prependPackageName(string $string): string
    {
        return self::PACKAGE_NAME . self::SEMICOLON_SPACE . $string;
    }
    
    public static function makeVersionString(): string
    {
        return self::VERSION_MAJOR . self::DOT . self::VERSION_MINOR . self::DOT . self::REVISION_NUMBER;
    }
    
    public static function makePackageAuthorsString(): string
    {
        return implode(self::COMMA_SPACE, self::PACKAGE_AUTHORS);
    }
    
    public static function makeCopyrightHoldersString(): string
    {
        return implode(self::COMMA_SPACE, self::COPYRIGHT_HOLDERS);
    }
}
