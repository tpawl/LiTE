LiTE
====
**Li**ghtweight **T**emplate **E**ngine

[![Build Status](https://travis-ci.org/tpawl/LiTE.svg?branch=master)](https://travis-ci.org/tpawl/LiTE) [![Coverage Status](https://coveralls.io/repos/github/tpawl/LiTE/badge.svg)](https://coveralls.io/github/tpawl/LiTE)

Description
-----------

**LiTE** is an ad hoc Template Engine especially suited for Backends. It´s native, because it uses PHP as its Template Language and needs no compiling of templates. It supports Template Variables and View-helpers.

Requirements
------------

**LiTE** requires PHP 7.1+

Installation
------------

Coming soon...

Usage
-----

### LiTE for Developers

```php
$configuration = [
    $template, // a string holding the template
    ['the' => 'variables', 'go' => 'here'],
    '/path/to/view_helpers',
    'view_helpers\namespace',
];

$templateExpression = new LiTE\Expressions\TemplateExpression($configuration);
```

#### Outputting the Template

```php
$templateExpression->display();
```

### LiTE for Template Designers

#### Template variables

```
<?php $this->foo; ?>
```

This defines a template variable with name `foo`.
The complete expression above is replaced by the value of the template variable `foo`.

Example
-------
```php
<?php

require_once '/path/to/vendor/autoload.php';

$template = <<<'HTML'
<!DOCTYPE html>
Hello <?php $this->name; ?>!<br>
You are running PHP <?php $this->ver; ?>: <?php self::msg(); ?>
HTML;

$variables = [
    'name' => 'Thomas',
    'ver' => PHP_VERSION,
];

$configuration = [
    $template,
    $variables,
    '.',
    '',
];

$templateExpression = new LiTE\Expressions\TemplateExpression($configuration);

$templateExpression->display();
```
