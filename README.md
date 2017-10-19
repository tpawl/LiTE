LiTE
====
**Li**ghtweight **T**emplate **E**ngine

[![Build Status](https://travis-ci.org/tpawl/LiTE.svg?branch=master)](https://travis-ci.org/tpawl/LiTE) [![Coverage Status](https://coveralls.io/repos/github/tpawl/LiTE/badge.svg)](https://coveralls.io/github/tpawl/LiTE)

Description
-----------

**LiTE** is an ad hoc Template Engine especially suited for Backends. It´s native, because it uses PHP as its Template Language and needs no compiling of templates. It supports Template-variables and View-helpers.

## Requirements

**LiTE** requires PHP 7.1+

## Installation

Coming soon...

## Usage

### LiTE for Developers

```php
$configuration = [
    $template, // a string holding the template
    ['the' => 'variables', 'go' => 'here'],
    '/path/to/view-helpers',
    'view-helpers\namespace',
];

$templateExpression = new LiTE\Expressions\TemplateExpression($configuration);
```

#### Outputting the Template

```php
$templateExpression->display();
```

### LiTE for Template Designers

#### Template-variables

```php
<?php $this->foo; ?>
```
This defines a template-variable with name `foo`.
