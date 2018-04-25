<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Context;

use TPawl\LiTE\Expressions\TemplateExpression;
use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Assertion\Assertion;
use TPawl\LiTE\Exceptions\ContextException;
use TPawl\LiTE\Miscellaneous\ViewHelperCallData;
use TPawl\LiTE\Expressions\VariableExpression;

class Context
{
    /**
     * @var static
     */
    private static $instance = null;

    /**
     * @var \TPawl\LiTE\Expressions\TemplateExpression
     */
    private $templateExpression = null;

    /**
     * @var \TPawl\LiTE\Expressions\SubTemplateExpression
     */
    private $firstSubTemplateExpression = null;

    /**
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * @return bool
     */
    public static function isEmpty(): bool
    {
        $self = self::getInstance();

        return $self->isContextEmpty();
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
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->topSubTemplateExpression()->getTemplate();
    }

    /**
     * @param string $name
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return mixed
     */
    public function lookUpVariable(string $name, FilterInterface $filter)
    {
        return $this->topSubTemplateExpression()->lookUpVariable(
            $name, $filter);
    }

    /**
     * @param \TPawl\LiTE\Miscellaneous\ViewHelperCallData $viewHelperCallData
     * @param \TPawl\LiTE\Filter\FilterInterface $filter
     * @return void
     */
    public function executeViewHelper(ViewHelperCallData $viewHelperCallData,
        FilterInterface $filter): void
    {
        $this->getTemplateExpression()->executeViewHelper(
            $viewHelperCallData, $filter);
    }

    /**
     * @param \TPawl\LiTE\Expressions\TemplateExpression $templateExpression
     * @return void
     */
    public function setTemplateExpression(TemplateExpression $templateExpression): void
    {
        if (!$this->isContextEmpty()) {

            throw new ContextException('A template expression must not be used within a template expression');
        }
        $this->templateExpression = $templateExpression;
    }

    /**
     * @return void
     */
    public function resetTemplateExpression(): void
    {
        $this->templateExpression = null;
    }

    /**
     * @return \TPawl\LiTE\Expressions\TemplateExpression
     */
    public function getTemplateExpression(): TemplateExpression
    {
        Assertion::notIsNull($this->templateExpression);

        return $this->templateExpression;
    }

    /**
     * @param \TPawl\LiTE\Expressions\SubTemplateExpression $subTemplateExpression
     * @return void
     */
    public function pushSubTemplateExpression(SubTemplateExpression $subTemplateExpression): void
    {
        if ($this->isContextEmpty()) {

            throw new ContextException('A sub-template expression must only be used within a template expression');
        }
        $subTemplateExpression->setNext($this->firstSubTemplateExpression);

        $this->firstSubTemplateExpression = $subTemplateExpression;
    }

    /**
     * @return void
     */
    public function popSubTemplateExpression(): void
    {
        $topSubTemplateExpression = $this->topSubTemplateExpression();

        $this->firstSubTemplateExpression = $topSubTemplateExpression->getNext();

        $topSubTemplateExpression->setNext(null);
    }

    /**
     * @return \TPawl\LiTE\Expressions\SubTemplateExpression
     */
    public function topSubTemplateExpression(): SubTemplateExpression
    {
        Assertion::notIsNull($this->firstSubTemplateExpression);

        return $this->firstSubTemplateExpression;
    }

    /**
     * @return bool
     */
    private function isContextEmpty(): bool
    {
        return is_null($this->templateExpression);
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
