LiTE
====
**Li**ghtweight **T**emplate **E**ngine

[![Build Status](https://travis-ci.org/tpawl/LiTE.svg?branch=master)](https://travis-ci.org/tpawl/LiTE)
[![Coverage Status](https://coveralls.io/repos/github/tpawl/LiTE/badge.svg?branch=master)](https://coveralls.io/github/tpawl/LiTE?branch=master)

Description
-----------

**LiTE** is an ad hoc Template Engine especially suited for Backends.
It is native, because it uses PHP as its Template Language and needs no compiling of templates.
It supports Template Variables and View Helpers.

Requirements
------------

**LiTE** requires PHP 7.3+

Installation
------------

Via Composer

```bash
$ composer require tpawl/lite
```

Usage
-----

### LiTE for Developers

#### Basics

The heart of **LiTE** is a object called the **template expression** (of class `TPawl\LiTE\Expressions\TemplateExpression`).

A template expression object is created like this:

```php
$settings = [
    $template, // a string holding the template
    ['the' => 'variables', 'go' => 'here'],
    '/path/to/view_helpers',
    'view_helpers\namespace',
];

$templateExpression = new TPawl\LiTE\Expressions\TemplateExpression($settings);
```
This will create a template expression that looks up the view helpers in the `/path/to/view_helpers/` folder.

Note that the only argument of the template expression is an array of settings options.
* The first option is the template as a string.
* The second option is an associative array of template variables, with the name of the variable as the key and its value.
* The third option is the path to the folder in which the view helpers are stored.
* The fourth option is the namespace in which the view helpers are defined as a string. If you do not use a namespace for your view helpers, write the empty string (`''`) here.

#### Outputting the template

```php
$templateExpression->display();
```

#### Defining a view helper

A view helper is a class that implements the interface `TPawl\LiTE\ViewHelperInterface`, that has a static `execute` method.
The name of that class must be ending with `ViewHelper` and the first letter must be upper-case.
The code for this class must be saved in a file with the name of the corresponding class with a trailing `.php`.
This file must be stored in a folder given as the third configuration option of the template expression.

Example:

```php
<?php
// HelloViewHelper.php

class HelloViewHelper implements TPawl\LiTE\ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        print 'Hello world.';
    }
}

```

`$arguments` is an indexed array of arguments that can be given to the view helper.
Output in the view helper can be done with `echo`, `print`, `printf`, ...

#### Sub template expression

Objects of the class `TPawl\LiTE\Expressions\SubTemplateExpression` are intended for use inside a view helper.
The constructor takes two arguments:
* The first argument is the template as a string.
* The second argument is an associative array of template variables, with the name of the variable as the key and its value.

Example:

```php
use TPawl\LiTE\Expressions\SubTemplateExpression;

class ExampleViewHelper implements TPawl\LiTE\ViewHelperInterface
{
    public static function execute(array $arguments): void
    {
        $condition = $arguments[0];

        if ($condition) {

            $subTemplateExpression = new SubTemplateExpression(
                $templateA, ['the' => 'variables', 'go' => 'here']);

            $subTemplateExpression->display();

        } else {

            $subTemplateExpression = new SubTemplateExpression(
                $templateB, ['the' => 'variables', 'go' => 'here']);

            $subTemplateExpression->display();
        }
    }
}
```

#### Miscellaneous

To determine wether you are inside/outside of a view helper you can use the static method `TPawl\LiTE\Context\Context::isEmpty()`.
It returns `false` if you are inside a view helper, `true` otherwise.

There is the class `TPawl\LiTE\Version` defined, that holds version information for **LiTE**.
It has the following constants defined:
* `MAJOR` for the major version number (major release).
* `MINOR` for the minor version number (minor release).
* `REVISION` for the revision number (patch level).

Examples:

```php
use TPawl\LiTE\PackageInformations;

echo 'Powered by ', PackageInformations::PACKAGE_NAME , ' ', PackageInformations::makePackageVersionString();

echo 'Copyright &copy; ', PackageInformations::PACKAGE_COPYRIGHT['years'], ' by ', PackageInformations::makePackageCopyrightHoldersString();
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

#### Predefined view helpers

There is the view helper `_xmlViewHelper` predefined.
It is called like this:

```
<?php self::_xml('version="1.0" encoding="UTF-8" standalone="yes"'); ?>
```

This will convert to `<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>`.
It is useful if you want to output XML.

Example
-------

Save the following view helper to a file named `MsgViewHelper.php` in any folder:

```php
<?php

class MsgViewHelper implements TPawl\LiTE\ViewHelperInterface
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

$settings = [
    $template,
    $variables,
    '.',
    '',
];

$templateExpression = new TPawl\LiTE\Expressions\TemplateExpression($settings);

$templateExpression->display();

```

If you call the above script in the browser, one possible output could be:

```
Hello Thomas!
You are running PHP 7.1.10: Everything is fine
```
