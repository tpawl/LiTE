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

The heart of **LiTE** is a object called the **template expression** (of class `LiTE\Expressions\TemplateExpression`).

A template expression object is created like this:

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

Note that the only argument of the template expression is an array of configuration options.
* The first option is the template as a string.
* The second option is an associative array of template variables, with the name of the variable as the key and its value.
* The third option is the path to the folder in which the view helpers are stored.
* The fourth option is the namespace in which the view helpers are defined as a string. If you do not use a namespace for your view helpers, write the empty string (`''`) here.

#### Outputting the template

```php
$templateExpression->display();
```

#### Defining a view helper

A view helper is a class that implements the interface `LiTE\ViewHelperInterface`, that has a static `execute` method.
The name of that class must be ending with `ViewHelper` and the first letter must be upper-case.
The code for this class must be saved in a file with the name of the corresponding class with a trailing `.php`.
This file must be saved in a folder given as the third configuration option of the template expression.

Example:

```php
<?php
// HelloViewHelper.php

class HelloViewHelper implements LiTE\ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        print 'Hello world.';
    }
}

```

`$arguments` is an indexed array of arguments that can be given to the view helper.
Output in the view helper can be done with `echo`, `print`, `printf`, ...

#### Predefined view helpers

#### Sub template expression

#### Miscellaneous

To determine wether you are inside/outside of a view helper you can use the method `LiTE\Context\Context::isEmpty()`.
It returns `false` if you are inside a view helper, `true` otherwise.

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
