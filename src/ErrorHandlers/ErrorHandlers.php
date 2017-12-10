<?php
// Copyright (c) 2015 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\ErrorHandlers;

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
    public static function push(?callable $errorHandler): void
    {
        set_error_handler($errorHandler);
    }

    /**
     * @return callable|null
     */
    public static function top(): ?callable
    {
        $previousErrorHandler = set_error_handler(null);

        self::pop();

        return $previousErrorHandler;
    }

    /**
     * @return void
     */
    public static function pop(): void
    {
        restore_error_handler();
    }
}
