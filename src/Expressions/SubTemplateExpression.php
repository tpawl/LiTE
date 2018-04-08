<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Expressions;

use TPawl\LiTE\ErrorHandlers\ErrorHandlers;
use TPawl\LiTE\Interpreter\TemplateInterpreter;
use TPawl\LiTE\Context\TemplateContext;
use TPawl\LiTE\Context\VariablesContext;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Php\ConfigurationInterface;
use TPawl\LiTE\Php\Configuration;
use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Exceptions\SubTemplateExpressionException;

class SubTemplateExpression implements TemplateExpressionInterface
{
    /**
     * @var string
     */
    private $template;
    
    /**
     * @var array
     */
    private $variables;

    /**
     * @var static|null
     */
    private $next = null;
    
    /**
     * @param string $template
     * @param array $variables
     * @return void
     */
    public function __construct(string $template, array $variables)
    {
        $this->template = $template;
        $this->variables = $variables;
    }

    /**
     * @return void
     * @throws \TPawl\LiTE\Exceptions\ViewHelperException
     */
    public function display(): void
    {
        $configuration = new Configuration();
        
        ErrorHandlers::push(self::getErrorHandler($configuration));

        $this->initializeSubTemplateExpression();

        new TemplateInterpreter();

        static::cleanup();

        ErrorHandlers::pop();
    }

    public static function getErrorHandler(ConfigurationInterface $configuration): callable
    {
        return function($errno, $errstr, $errfile, $errline) use ($configuration) {
        
            if ($configuration->shouldErrorLevelBeReported($errno)) {

                throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
            }
        };
    }
    
    /**
     * @param \TPawl\LiTE\Context\TemplateContext $templateContext
     * @param \TPawl\LiTE\Context\VariablesContext $variablesContext
     * @return void
     */
    private function initializeSubTemplateExpression(): void
    {
        $context = Context::getInstance();

        $context->pushSubTemplateExpression($this);
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \OutOfRangeException
     */
    public function lookUp(string $name, FilterInterface $filter)
    {
        self::filterName($name, $filter);
        
        $isVariableExisting = array_key_exists($name, $this->variables);
        
        if (!$isVariableExisting) {
            
            throw new \OutOfRangeException(
                "Template variable '{$name}' does not exist");
        }
        return $this->variables[$name];
    }
    
    /**
     * @param string $name
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return void
     * @throws \DomainException
     */
    private static function filterName(string $name,
        FilterInterface $filter): void
    {
        if (!$filter->isValidName($name)) {
            
            throw new \DomainException(
                "Invalid template variable name: {$name}");
        }
    }
    
    public function setNext(?SubTemplateExpression $subTemplateExpression): void
    {
        if ($this->isInUse() && !is_null($subTemplateExpression)) {
         
            throw new SubTemplateExpressionException('Sub-template expression is already in use');
        }
        $this->next = $subTemplateExpression;
    }
    
    /**
     * @return static
     */
    public function getNext(): ?SubTemplateExpression
    {
        return $this->next;
    }
    
    /**
     * @return bool
     */
    public function isInUse(): bool
    {
        return !is_null($this->next);
    }
    
    /**
     * @return void
     */
    protected static function cleanup(): void
    {
        $context = Context::getInstance();

        $topSubTemplateExpression = $context->topSubTemplateExpression();
        
        $context->popSubTemplateExpression();
        
        $topSubTemplateExpression->setNext(null);
    }
}
