<?php
// Copyright (c) 2013 - 2017 by Thomas Pawlitschko. All rights reserved.

declare(strict_types=1);

namespace LiTE\Context;

class TemplateContext
{
   /**
    * @var string
    */
    private $template = null;

    /**
     * @param string $template
     * @return void
     */
    public function __construct(string $template)
    {
        $this->template = $template;
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->template;
       
        $this->clear();
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $this->template = null;
    }
}
