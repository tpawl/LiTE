<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Context;

use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Exceptions\VariablesContextException;

class VariablesContext
{
    /**
     * @var array
     */
    private $variables;

    /**
     * @param array $variables
     * @return void
     */
    public function __construct(array $variables)
    {
        $this->variables = $variables;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \TPawl\LiTE\Exceptions\VariablesContextException
     */
    public function lookUp(string $name, FilterInterface $filter)
    {
        self::filterName($name, $filter);
        
        $isVariableExisting = array_key_exists($name, $this->variables);

        if (!$isVariableExisting) {

            throw new VariablesContextException(
                "Template variable '{$name}' does not exist");
        }
        return $this->variables[$name];
    }
    
    /**
     * @param string $name
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return void
     * @throws \TPawl\LiTE\Exceptions\VariablesContextException
     */
    private static function filterName(string $name,
        FilterInterface $filter): void
    {
        if (!$filter->isValidName($name)) {

            throw new VariablesContextException(
                "Invalid variable name: {$name}");
        }
    }
}
