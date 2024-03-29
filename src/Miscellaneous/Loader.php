<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class Loader
{
    public static function includeFile(
        string $normalizedBaseDirectory, string $filename): void
    {
        $realFilename = FileSystem::makeRealPathname(
            $normalizedBaseDirectory . $filename);
        
        if (StringType::isBeginningWith(
            $realFilename, $normalizedBaseDirectory)) {
            
            include $realFilename;
            
        } else {
            
            $registry = Registry::getInstance();
            
            Assertions::assertTrue($registry->isSetSecurityLogger(),
                '');
            
            $securityLogger = $registry->getSecurityLogger();
                
            $securityLogger->warning('');
        }
    }
    
    public static function requireFile(
        string $normalizedBaseDirectory, string $filename): void
    {
        $realFilename = FileSystem::makeRealPathname(
            $normalizedBaseDirectory . $filename);
        
        if (StringType::isBeginningWith(
            $realFilename, $normalizedBaseDirectory)) {
            
            require $realFilename;
        
        } else {
            
            $registry = Registry::getInstance();
            
            Assertions::assertTrue($registry->isSetSecurityLogger(),
                '');
            
            $securityLogger = $registry->getSecurityLogger();
                
            $securityLogger->warning('');
        }
    }
}
