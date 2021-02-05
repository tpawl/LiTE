<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Expressions\TemplateExpression;
use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\LiTE\Tests\Asset\Functions;
use TPawl\LiTE\Exceptions\ContextException;

class ContextTest extends TestCase
{
    private $context;

    protected function setUp(): void
    {
        $this->context = Context::getInstance();
    }

    protected function tearDown(): void
    {
        Functions::resetContext();
    }

    public function testTemplateExpressionWithinTemplateExpressionThrowsAnException()
    {
		$this->expectException(ContextException::class);
		$this->expectExceptionMessage(
		    'A template expression must not be used within a template expression');
		
        $settings = [
            '',
            [],
            '.',
            ''
        ];

        $te1 = new TemplateExpression($settings);

        $te1->initialize($this->context);

        $te2 = new TemplateExpression($settings);

        $te2->initialize($this->context);
    }

    /**
     * @expectedException TPawl\LiTE\Exceptions\ContextException
     * @expectedExceptionMessage A sub-template expression must only be used within a template expression
     */
    public function testSubTemplateExpressionNotWithinTemplateExpressionThrowsAnException()
    {
        $ste = new SubTemplateExpression('', []);

        $ste->initialize($this->context);
    }

    public function testPushVariablesContext()
    {
        $settings = [
            '',
            [],
            '.',
            ''
        ];

        $te = new TemplateExpression($settings);

        $te->initialize($this->context);

        $ste = new SubTemplateExpression('', []);

        $ste->initialize($this->context);

        $tste = $this->context->topSubTemplateExpression();

        $this->assertSame($ste, $tste);

        SubTemplateExpression::cleanup($this->context);

        $tste = $this->context->topSubTemplateExpression();

        $this->assertSame($te, $tste);

        TemplateExpression::cleanup($this->context);
    }

    /**
     * @expectedException TPawl\LiTE\Exceptions\AssertionException
     */
    public function testPopFromEmptyVariablesContextThrowsAnException()
    {
        $this->context->popSubTemplateExpression();
    }

    public function testIsEmpty()
    {
        $this->assertTrue(Context::isEmpty());

        $settings = [
            '',
            [],
            '.',
            ''
        ];

        $te = new TemplateExpression($settings);

        $te->initialize($this->context);

        $this->assertFalse(Context::isEmpty());

        TemplateExpression::cleanup($this->context);

        $this->assertTrue(Context::isEmpty());
    }
}
