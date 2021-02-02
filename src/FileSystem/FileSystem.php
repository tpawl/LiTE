<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\FileSystem;

use TPawl\LiTE\Exceptions\FileSystemException;

class FileSystem
{
    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /*
     * @param string $pathname
     * @return string
     */
    public static function makeRealPathname(string $pathname): string
    {
        $realPathname = realpath($pathname);

        if ($realPathname === false) {

            throw new FileSystemException(
                "Could not make real pathname for: '{$pathname}'");
        }
        return $realPathname;
    }
}
