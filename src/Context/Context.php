<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Context;

use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Assert\Assert;

class Context
{
    /**
     * @var \TPawl\LiTE\Context\Context
     */
    private static $instance = null;

    /**
     * @var \TPawl\LiTE\Expressions\SubTemplateExpression
     */
    private $first = null;

    /**
     * @var \TPawl\LiTE\Context\ViewHelperContext
     */
    private $viewHelperContext = null;

    /**
     * @return bool
     */
    public static function isEmpty(): bool
    {
        $self = self::getInstance();
        
        return $self->isVariablesContextEmpty();
    }
    
    /**
     * @return static
     */
    public static function getInstance(): Context
    {
        if (is_null(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
     /**
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        $templateContext = $this->getTemplateContext();

        return $templateContext->get();
    }

    /**
     * @param \TPawl\LiTE\Context\TemplateContext $templateContext
     * @return void
     */
    public function pushSubTemplateExpression(SubTemplateExpression $subTemplateExpression): void
    {
        $subTemplateExpression->next = $this->first;
        
        $this->first = $subTemplateExpression;
    }

    /**
     * @return \TPawl\LiTE\Context\TemplateContext
     */
    private function getTemplateContext(): TemplateContext
    {
        return $this->templateContext;
    }

    /**
     * @return void
     */
    public function clearTemplateContext(): void
    {
        $this->templateContext = null;
    }

    /**
     * @param string $name
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return mixed
     */
    public function lookUpVariable(string $name, FilterInterface $filter)
    {
        $variablesContext = $this->topVariablesContext();

        return $variablesContext->lookUp($name, $filter);
    }

    /**
     * @param \TPawl\LiTE\Context\VariablesContext $variablesContext
     * @return void
     */
    public function pushVariablesContext(VariablesContext $variablesContext):
        void
    {
        if (!$this->isVariablesContextEmpty()) {

            $this->variablesContextTail[] = $this->variablesContextHead;
        }
        $this->variablesContextHead = $variablesContext;
    }

    /**
     * @return \TPawl\LiTE\Context\VariablesContext
     */
    public function topVariablesContext(): VariablesContext
    {
        return $this->variablesContextHead;
    }

    /**
     * @return void
     */
    public function popVariablesContext(): void
    {
        Assert::isFalse($this->isVariablesContextEmpty());

        $this->variablesContextHead = array_pop($this->variablesContextTail);
    }

    /**
     * @return bool
     */
    private function isVariablesContextEmpty(): bool
    {
        return is_null($this->variablesContextHead);
    }
    
    /**
     * @param string $name
     * @param array $arguments
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return void
     */
    public function executeViewHelper(string $name, array $arguments,
        FilterInterface $filter): void
    {
        $viewHelperContext = $this->getViewHelperContext();

        $viewHelperContext->execute($name, $arguments, $filter);
    }

    /**
     * @param \TPawl\LiTE\Context\ViewHelperContext $viewHelperContext
     * @return void
     */
    public function setViewHelperContext(ViewHelperContext $viewHelperContext):
        void
    {
        $this->viewHelperContext = $viewHelperContext;
    }

    /**
     * @return \TPawl\LiTE\Context\ViewHelperContext
     */
    private function getViewHelperContext(): ViewHelperContext
    {
        return $this->viewHelperContext;
    }

    /**
     * @return void
     */
    public function clearViewHelperContext(): void
    {
        $this->viewHelperContext->clear();
        
        $this->viewHelperContext = null;
    }

    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __clone()
    {
    }
    
    /**
     * @return void
     * @codeCoverageIgnore
     */
    private function __wakeup()
    {
    }
}
