<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace tpawl\lite\Context;

use tpawl\lite\Filter\FilterInterface;
use tpawl\lite\Assert\Assert;

class Context
{
    /**
     * @var \tpawl\lite\Context\Context
     */
    private static $instance = null;
    
    /**
     * @var \tpawl\lite\Context\TemplateContext
     */
    private $templateContext = null;

    /**
     * @var \tpawl\lite\Context\VariablesContext
     */
    private $variablesContextHead = null;
    
    /**
     * @var \tpawl\lite\Context\VariablesContext[]
     */
    private $variablesContextTail = [];

    /**
     * @var \tpawl\lite\Context\ViewHelperContext
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
     * @param \tpawl\lite\Context\TemplateContext $templateContext
     * @return void
     */
    public function setTemplateContext(TemplateContext $templateContext): void
    {
        $this->templateContext = $templateContext;
    }

    /**
     * @return \tpawl\lite\Context\TemplateContext
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
     * @param \tpawl\lite\Filter\FilterInterface $filter
     * @return mixed
     */
    public function lookUpVariable(string $name, FilterInterface $filter)
    {
        $variablesContext = $this->topVariablesContext();

        return $variablesContext->lookUp($name, $filter);
    }

    /**
     * @param \tpawl\lite\Context\VariablesContext $variablesContext
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
     * @return \tpawl\lite\Context\VariablesContext
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
     * @param \tpawl\lite\Filter\FilterInterface $filter
     * @return void
     */
    public function executeViewHelper(string $name, array $arguments,
        FilterInterface $filter): void
    {
        $viewHelperContext = $this->getViewHelperContext();

        $viewHelperContext->execute($name, $arguments, $filter);
    }

    /**
     * @param \tpawl\lite\Context\ViewHelperContext $viewHelperContext
     * @return void
     */
    public function setViewHelperContext(ViewHelperContext $viewHelperContext):
        void
    {
        $this->viewHelperContext = $viewHelperContext;
    }

    /**
     * @return \tpawl\lite\Context\ViewHelperContext
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
