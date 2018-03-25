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
use TPawl\LiTE\Exceptions\VariablesContextException;

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
        $templateContext = new TemplateContext($this->template);
        $variablesContext = new VariablesContext($this->variables);
        
        ErrorHandlers::push(self::getErrorHandler($configuration));

        self::initializeSubTemplateExpression($templateContext, $variablesContext);

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
    private static function initializeSubTemplateExpression(TemplateContext $templateContext, VariablesContext $variablesContext): void
    {
        $context = Context::getInstance();

        $context->setTemplateContext($templateContext);
        $context->pushVariablesContext($variablesContext);
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
    
    /**
     * @return void
     */
    protected static function cleanup(): void
    {
        $context = Context::getInstance();

        $context->popVariablesContext();
    }
}
