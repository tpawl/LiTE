LiTE
====
**Li**ghtweight **T**emplate **E**ngine

[![Build Status](https://travis-ci.org/tpawl/LiTE.svg?branch=master)](https://travis-ci.org/tpawl/LiTE) [![Coverage Status](https://coveralls.io/repos/github/tpawl/LiTE/badge.svg)](https://coveralls.io/github/tpawl/LiTE)

Description
-----------

**LiTE** is an ad hoc Template Engine especially suited for Backends. It´s native, because it uses PHP as its Template Language and needs no compiling of templates. It supports Template Variables and View Helpers.

Requirements
------------

**LiTE** requires PHP 7.1+

Installation
------------

Coming soon...

Usage
-----

### LiTE for Developers

#### Basics

```php
$configuration = [
    $template, // a string holding the template
    ['the' => 'variables', 'go' => 'here'],
    '/path/to/view_helpers',
    'view_helpers\namespace',
];

$templateExpression = new LiTE\Expressions\TemplateExpression($configuration);
```
This will create a template expression that looks up the view helpers in the `/path/to/view_helpers/` folder.

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

#### View helpers

```
<?php self::bar(); ?>
```

This calls the view helper `BarViewHelper` with no arguments.
If you have arguments, you have to write them as a comma separated list between the parentheses after `bar`.
Example: `<?php self::bar('arg1', 'arg2', ...); ?>`

The complete expression above is replaced by the output of the view helper `BarViewHelper`.

Example
-------

Save the following view helper to a file named `MsgViewHelper.php` in any folder:

```php
<?php

class MsgViewHelper implements LiTE\ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        if (version_compare(PHP_VERSION, '7.1.0') >= 0) {

            $msg = 'Everything is fine';

        } else {

            $msg = 'This is not good';
        }
        print $msg;
    }
}

```

Suppose you have the following script in the same folder as the above view helper:

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

If you call the above script in the browser, one possible output could be:

```
Hello Thomas!
You are running PHP 7.1.10: Everything is fine
```
