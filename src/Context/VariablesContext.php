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
     */
    public function lookUp(string $name, FilterInterface $filter)
    {
        if (!$filter->isValidName($name)) {

            throw new VariablesContextException(
                "Invalid variable name: {$name}");
        }
        $isVariableExisting = array_key_exists($name, $this->variables);

        if (!$isVariableExisting) {

            throw new VariablesContextException(
                "Template variable '{$name}' does not exist");
        }
        return $this->variables[$name];
    }
}
