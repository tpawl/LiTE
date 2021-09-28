<?php
// Copyright (c) 2013 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

use TPawl\LiTE\PackageInformations;

class PackageMessages
{
    public const DEFAULT_ASSERTION_MESSAGE = 'Assertion failed.';
    
    private const COLON_SPACE = ': ';
    
    public static function packagizeMessage(string $message): string
    {
        return PackageInformations::PACKAGE_NAME . self::COLON_SPACE . $message;
    }
}
