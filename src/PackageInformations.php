<?php
// Copyright (c) 2013 - 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE;

use TPawl\LiTE\Miscellaneous\ArrayFunctions;
use TPawl\LiTE\Miscellaneous\PackageErrorHandler;
use TPawl\LiTE\Miscellaneous\PackageMessages;

class PackageInformations
{
    private const DOT = '.';
    private const COMMA_SPACE = ', ';
    
    public const PACKAGE_NAME = 'LiTE';

    public const PACKAGE_HOME = 'https://github.com/tpawl/LiTE';
    
    public const PACKAGE_VERSION = [
        'major' => 2, // Major version number (major release)
        'minor' => 0, // Minor version number (minor release)
        'revision' => 0 // Revision number (patch level)
    ];
    public const PACKAGE_AUTHORS = ['Thomas Pawlitschko'];

    public const PACKAGE_COPYRIGHT = [
        'years' => '2013 - 2021',
        'holders' => ['Thomas Pawlitschko']
    ];

    public const PACKAGE_LICENSE = 'MIT License';

    public static function prependPackageNameColonSpace(string $string): string
    {
        PackageErrorHandler::pushOnErrorHandlersStack();
        
        $return = PackageMessages::packagizeMessage($string);
    
        PackageErrorHandler::popFromErrorHandlersStack();
        
        return $return;
    }
    
    public static function makePackageVersionString(): string
    {
        PackageErrorHandler::pushOnErrorHandlersStack();
        
        $return = ArrayFunctions::implodeWith(self::PACKAGE_VERSION, self::DOT);
        
        PackageErrorHandler::popFromErrorHandlersStack();
        
        return $return;
    }
    
    public static function makePackageAuthorsString(): string
    {
        PackageErrorHandler::pushOnErrorHandlersStack();
        
        $return = self::implodeWithCommaSpace(self::PACKAGE_AUTHORS);
        
        PackageErrorHandler::popFromErrorHandlersStack();
        
        return $return;
    }
    
    public static function makePackageCopyrightHoldersString(): string
    {
        PackageErrorHandler::pushOnErrorHandlersStack();
        
        $return = self::implodeWithCommaSpace(self::PACKAGE_COPYRIGHT['holders']);
        
        PackageErrorHandler::popFromErrorHandlersStack();
        
        return $return;
    }
    
    private static function implodeWithCommaSpace(array $array): string
    {
        PackageErrorHandler::pushOnErrorHandlersStack();
        
        $return = ArrayFunctions::implodeWith($array, self::COMMA_SPACE);
        
        PackageErrorHandler::popFromErrorHandlersStack();
        
        return $return;
    }
}
