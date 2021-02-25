<?php
// Copyright (c) 2015 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Miscellaneous;

class ErrorHandlers
{
    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * @param callable|null $errorHandler
     * @return void
     */
    public static function pushErrorHandler(?callable $errorHandler): void
    {
        self::setErrorHandler($errorHandler);
    }

    /**
     * @return callable|null
     */
    public static function getTopErrorHandler(): ?callable
    {
        $previousErrorHandler = self::setErrorHandler(null);

        self::popErrorHandler();

        return $previousErrorHandler;
    }

    /**
     * @return void
     */
    public static function popErrorHandler(): void
    {
        restore_error_handler();
    }
    
    private static function setErrorHandler(?callable $errorHandler): ?callable
    {
        return set_error_handler($errorHandler);
    }
}
