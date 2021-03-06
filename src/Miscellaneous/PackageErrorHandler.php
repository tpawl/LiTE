<?php
// Copyright (c) 2021 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

use TPawl\LiTE\Php\Configuration;
use TPawl\LiTE\Php\ConfigurationInterface;

class PackageErrorHandler
{   
    public static function pushOnErrorHandlersStack(): void
    {
        $configuration = new Configuration();
        
        ErrorHandlersStack::pushErrorHandler(self::getErrorHandler($configuration));
    }
    
    public static function popFromErrorHandlersStack(): void
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
