<?php
// Copyright (c) 2017, 2018 by Thomas Pawlitschko. (MIT License)

declare(strict_types=1);

namespace TPawl\LiTE\Tests;

use PHPUnit\Framework\TestCase;
use TPawl\LiTE\Context\Context;
use TPawl\LiTE\Expressions\TemplateExpression;
use TPawl\LiTE\Expressions\SubTemplateExpression;
use TPawl\LiTE\Tests\Asset\Functions;

class ContextTest extends TestCase
{
    protected function tearDown()
    {
        Functions::resetContext();
    }

    /**
     * @expectedException TPawl\LiTE\Exceptions\ContextException
     * @expectedExceptionMessage A template expression must not be used within a template expression
     */
    public function testTemplateExpressionWithinTemplateExpressionThrowsAnException()
    {
        $settings = [
            '<?php self::template(); ?>',
            [],
             __DIR__ . '/Asset/ViewHelpers',
            ''
        ];
        
        $te = new TemplateExpression($settings);
        
        $te->display();
    }
    
    /**
     * @expectedException TPawl\LiTE\Exceptions\ContextException
     * @expectedExceptionMessage A sub-template expression must only be used within a template expression
     */
    public function testSubTemplateExpressionNotWithinTemplateExpressionThrowsAnException()
    {   
        $ste = new SubTemplateExpression('', []);
        
        $ste->display();
    }
    
    public function testPushVariablesContext()
    {
        $context = Context::getInstance();
        
        $settings = [
            '',
            [],
            '.',
            ''
        ];
        
        $te = new TemplateExpression($settings);
        
        $context->setTemplateExpression($te);
        $context->pushSubTemplateExpression($te);
        
        $ste = new SubTemplateExpression('', []);
        
        $context->pushSubTemplateExpression($ste);
        
        $tste = $context->topSubTemplateExpression();
        
        $this->assertSame($ste, $tste);
        
        $context->popSubTemplateExpression();
        
        $tste = $context->topSubTemplateExpression();
        
        $this->assertSame($te, $tste);
        
        $context->popSubTemplateExpression();
        $context->resetTemplateExpression();
    }
    
    /**
     * @expectedException TPawl\LiTE\Exceptions\AssertException
     */
    public function testPopFromEmptyVariablesContextThrowsAnException()
    {
        $context = Context::getInstance();
        
        $context->popSubTemplateExpression();
    }

    public function testIsEmpty()
    {
        $this->assertTrue(Context::isEmpty());
        
        $context = Context::getInstance();
        
        $settings = [
            '',
            [],
            '.',
            ''
        ];
        
        $te = new TemplateExpression($settings);
        
        $context->setTemplateExpression($te);
        $context->pushSubTemplateExpression($te);
        
        $this->assertFalse(Context::isEmpty());
        
        $context->popSubTemplateExpression();
        $context->resetTemplateExpression();
        
        $this->assertTrue(Context::isEmpty());
    }
}
