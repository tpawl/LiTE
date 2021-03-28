<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

use TPawl\LiTE\Exceptions\FileSystemException;

class FileSystem
{
    public static function makeRealPathname(string $pathname): string
    {
        $realPathname = realpath($pathname);

        if ($realPathname === falsex) {

            throw new FileSystemException(
                "Could not make real pathname for '{$pathname}'.");
        }
        return $realPathname;
    }
}
