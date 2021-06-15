<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

use TPawl\LiTE\Php\Configuration;

class PackageErrorHandler
{   
    protected static function pushErrorHandler(): void
    {
        $configuration = new Configuration();
        
        ErrorHandlersStack::pushErrorHandler(self::getErrorHandler($configuration));
    }
    
    protected static function popErrorHandler(): void
    {
        ErrorHandlersStack::popErrorHandler();
    }
    
     /**
     * @return callable
     */
    public static function getErrorHandler(ConfigurationInterface $configuration): callable
    {
        return function($errno, $errstr, $errfile, $errline) use ($configuration) {

            if ($configuration->shouldErrorLevelBeReported($errno)) {

                throw new \ErrorException(
                    $errstr, 0, $errno, $errfile, $errline);
            }
        };
    }
}
