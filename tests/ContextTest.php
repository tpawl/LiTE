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
        
        Functions::resetContext();
    }
    
     /**
     * @expectedException TPawl\LiTE\Exceptions\ContextException
     */
    public function testSubTemplateExpressionNotWithinTemplateExpressionThrowsAnException()
    {
        $context = Context::getInstance();
        
        $ste = new SubTemplateExpression('', []);
        
        $context->pushSubTemplateExpression($ste);
        
        Functions::resetContext();
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
        
        Functions::resetContext();
    }
    
    /**
     * @expectedException TPawl\LiTE\Exceptions\AssertException
     */
    public function testPopFromEmptyVariablesContextThrowsAnException()
    {
        $context = Context::getInstance();
        
        $context->popSubTemplateExpression();
        
        Functions::resetContext();
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
        
        Functions::resetContext();
    }
}
