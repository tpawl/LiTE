<?php
// Copyright (c) 2013 - 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Context;

use TPawl\LiTE\Expressions\TemplateExpression;
use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\LiTE\Filter\FilterInterface;
use TPawl\LiTE\Miscellaneous\Assertions;
use TPawl\LiTE\Exceptions\ContextException;
use TPawl\LiTE\Miscellaneous\ViewHelperCallData as LiteViewHelperCallData;
use TPawl\LiTE\Miscellaneous\VariableFunctions;

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
    public static function getInstance(): self
    {
        if (VariableFunctions::isNull(self::$instance)) {
            
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
     * @throws \TPawl\LiTE\Exceptions\AssertionException if name is empty
     * @throws \DomainException if variable name is invalid
     * @throws \OutOfRangeException if name does not exist
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
     * @throws \TPawl\LiTE\Exceptions\AssertionException if view helper name is empty
     * @throws \DomainException if view helper name is invalid
     * @throws \TPawl\LiTE\Exceptions\TemplateExpressionException if view helper does not exist or
     * if view helper does not implement the interface TPawl\LiTE\ViewHelperInterface
     * @throws \TPawl\LiTE\Exceptions\ViewHelperRuntimeException if a runtime exception occured in view helper
     * @throws \TPawl\LiTE\Exceptions\ViewHelperLogicException if a logic exception occured in view helper
     */
    public function executeViewHelper(LiteViewHelperCallData $viewHelperCallData,
        FilterInterface $filter): void
    {
        $this->getTemplateExpression()->executeViewHelper(
            $viewHelperCallData, $filter);
    }

    /**
     * @param \TPawl\LiTE\Expressions\TemplateExpression $templateExpression
     * @return void
     */
    public function setTemplateExpression(
        TemplateExpression $templateExpression): void
    {
        if (!$this->isContextEmpty()) {

            throw new ContextException(
                'A template expression must not be used within a template expression'
            );
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
        Assertions::assertNotNull($this->templateExpression);

        return $this->templateExpression;
    }

    /**
     * @param \TPawl\LiTE\Expressions\SubTemplateExpression $subTemplateExpression
     * @return void
     */
    public function pushSubTemplateExpression(
        SubTemplateExpression $subTemplateExpression): void
    {
        if ($this->isContextEmpty()) {

            throw new ContextException(
                'A sub-template expression must only be used within a template expression'
            );
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

        $this->firstSubTemplateExpression = $topSubTemplateExpression->
            getNext();

        $topSubTemplateExpression->setNext(null);
    }

    /**
     * @return \TPawl\LiTE\Expressions\SubTemplateExpression
     */
    public function topSubTemplateExpression(): SubTemplateExpression
    {
        Assertions::assertNotNull($this->firstSubTemplateExpression);

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
     */
    public function __wakeup()
    {
        Assertions::assertNeverReachesHere(
		    'You can not deserialize a object of the class Context.');
    }
}
