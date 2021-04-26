<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class Loader
{
    public static function includeFile(
        string $normalizedBaseDirectory, string $filename): void
    {
        $realFilename = FileSystem::makeRealPath(
            $normalizedBaseDirectory . $filename);
        
        if (StringType::isBeginningWith(
            $realFilename, $normalizedBaseDirectory)) {
            
            include $realFilename;
            
        } else {
            
            ;
        }
    }
    
    public static function requireFile(
        string $normalizedBaseDirectory, string $filename): void
    {
        $realFilename = FileSystem::makeRealPath(
            $normalizedBaseDirectory . $filename);
        
        if (StringType::isBeginningWith(
            $realFilename, $normalizedBaseDirectory)) {
            
            require $realFilename;
        
        } else {
            
            ;
        }
    }
}
