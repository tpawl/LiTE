<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class Loader
{
    public static function includeFile(
        string $baseDirectory, string $filename): void
    {
        $normalizedBaseDirectory = self::normalizeDirectory($baseDirectory);

        $realFilename = FileSystem::makeRealPath(
            $normalizedBaseDirectory . $filename);
        
        if (StringFunctions::isBeginningWith(
            $realFilename, $normalizedBaseDirectory)) {
            
            include $realFilename;
            
        } else {
            
            ;
        }
    }
    
    public static function requireFile(
        string $baseDirectory, string $filename): void
    {
        $normalizedBaseDirectory = self::normalizeDirectory($baseDirectory);

        $realFilename = FileSystem::makeRealPath(
            $normalizedBaseDirectory . $filename);
        
        if (StringFunctions::isBeginningWith(
            $realFilename, $normalizedBaseDirectory)) {
            
            require $realFilename;
        
        } else {
            
            ;
        }
    }

    private static function normalizeDirectory(string $directoryName): string
    {
        return FileSystem::isEndingWithDirectorySeparator($directoryName) ?
            $directoryName : FileSystem::pushDirectorySeparator($directoryName);
    }
}
