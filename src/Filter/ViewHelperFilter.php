<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Filter;

use TPawl\LiTE\Exceptions\FilterException;
use TPawl\LiTE\Miscellaneous\PackageMessages;

class ViewHelperFilter implements FilterInterface
{  
    private const UNDERSCORE = '_';

    public function filterName(string $name): void
    {
        if (!self::isValidName($name)) {
        
            throw new FilterException(
                PackageMessages::packagizeMessage(
                    "Ivalid view helper name '{$name}'"));
        }
    }
    
    private static function isValidName(string $name): bool
    {
        return TemplateVariableFilter::isValidName($name) || 
            $name === self::UNDERSCORE;
    }
}
