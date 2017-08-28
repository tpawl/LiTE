<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Expressions;

use LiTE\ErrorHandlers\ErrorHandlers;
use LiTE\Interpreter\TemplateInterpreter;
use LiTE\Context\TemplateContext;
use LiTE\Context\VariablesContext;
use LiTE\Context\Context;
use LiTE\Php\Configuration;

class SubTemplateExpression implements TemplateExpressionInterface
{
    private $template;
    private $variables;

    public function __construct(string $template, array $variables)
    {
        $this->template = $template;
        $this->variables = $variables;
    }

    /**
     * @param string $template
     * @param array $variables
     * @return void
     * @throws ViewHelperException
     */
    public function display(): void
    {
        ErrorHandlers::push(self::class . '::errorHandler');

        $this->initialize($this->template, $this->variables);

        new TemplateInterpreter();

        $this->cleanup();

        ErrorHandlers::pop();
    }

    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {
        if (Configuration::shouldErrorLevelReport($errno)) {

            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        }
    }
    
    /**
     * @param string $template
     * @param array $variables
     * @return void
     */
    protected function initialize(string $template, array $variables): void
    {
        $context = Context::getInstance();

        $templateContext = new TemplateContext($template);
        $variablesContext = new VariablesContext($variables);

        $context->setTemplateContext($templateContext);
        $context->pushVariablesContext($variablesContext);
    }

    /**
     * @return void
     */
    protected function cleanup(): void
    {
        $context = Context::getInstance();

        $context->popVariablesContext();
    }
}
