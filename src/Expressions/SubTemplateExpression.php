<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Expressions;

use TPawl\LiTE\ErrorHandlers\ErrorHandlers;
use TPawl\LiTE\Interpreter\TemplateInterpreter;
use TPawl\LiTE\Context\TemplateContext;
use TPawl\LiTE\Context\VariablesContext;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Php\ConfigurationInterface;
use TPawl\LiTE\Php\Configuration;

class SubTemplateExpression implements TemplateExpressionInterface
{
    private $template;
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

        $this->initializeSubTemplateExpression($templateContext, $variablesContext);

        new TemplateInterpreter();

        $this->cleanup();

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
    private function initializeSubTemplateExpression(TemplateContext $templateContext, VariablesContext $variablesContext): void
    {
        $context = Context::getInstance();

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
