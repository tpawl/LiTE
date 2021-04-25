<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class Loader
{
    public static function includeFile(string $baseDirectory, string $filename): void
    {
        if (!FileSystem::isEndingWithDirectorySeparator($baseDirectory)) {
			
			$baseDirectory .= DIRECTORY_SEPARATOR;
	    }
        $realFilename = FileSystem::makeRealPath($baseDirectory . $filename);
        
        if (StringFunctions::isBeginningWith($realFilename, $baseDirectory)) {
            
            include $realFilename;
            
        } else {
            
            ;
        }
    }
    
    public static function requireFile(string $baseDirectory, string $filename): void
    {
        if (!FileSystem::isEndingWithDirectorySeparator($baseDirectory)) {
			
			$baseDirectory .= DIRECTORY_SEPARATOR;
	    }
        $realFilename = FileSystem::makeRealPath($baseDirectory . $filename);
        
        if (StringFunctions::isBeginningWith($realFilename, $baseDirectory)) {
            
            require $realFilename;
        
        } else {
            
            ;
        }
    }
}
