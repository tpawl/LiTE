<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

use TPawl\LiTE\Exceptions\FileSystemException;

class FileSystem
{
    public static function appendDirectorySeparator(string $pathname): string
    {
        return $pathname . DIRECTORY_SEPARATOR;
    }

    public static function makeRealPathname(string $pathname): string
    {
        $realPathname = realpath($pathname);

        if ($realPathname === false) {

            throw new FileSystemException(
                PackageMessages::packagizeMessage(
                    "Could not make real pathname for '{$pathname}'."));
        }
        return $realPathname;
    }
    
    public static function IsEndingWithDirectorySeparator(
        string $pathname): bool
    {
        return (StringType::isEmptyString($pathname)) ? false :
            StringType::getLastCharacter($pathname) === DIRECTORY_SEPARATOR;
    }
}
