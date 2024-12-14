# SSC - CS

Shared Coding Standards configuration, for SSC.

Provides [PHP CS Fixer](https://cs.symfony.com/) configuration,
with default for the SSC projects.

## Installation

```console
composer require --dev ssc/cs
```

Configure in `.php-cs-fixer.dist.php`:

```php
<?php

return \Ssc\Cs\ConfigBuilder::forPath(__DIR__)
    ->build()
;
```

This will set the following defaults:

* find PHP files in the given path excluding those folders:
    * bin
    * cache
    * config
    * doc
    * logs
    * public
    * var
    * vendor
* enable:
    * caching
    * parallel runner
* applies rules from:
    * [Symfony rule set](https://cs.symfony.com/doc/ruleSets/Symfony.html),
      all rules enabled, **2 overriden**:
        * [php_unit_method_casing](https://cs.symfony.com/doc/rules/php_unit/php_unit_method_casing.html),
          uses `snake_case` (phpspec style) instead of `camel_case`
        * [visibility_required](https://cs.symfony.com/doc/rules/class_notation/visibility_required.html),
          explicitly omits `method` (for phpspec test methods) but keeps `const` and `property`
    * [PHP 5.6 Migration risky rule set](https://cs.symfony.com/doc/ruleSets/PHP56MigrationRisky.html),
      all rules enabled
    * [PER-CS risky rule set](https://cs.symfony.com/doc/ruleSets/PERCSRisky.html),
      all rules enabled
    * [Symfony risky rule set](https://cs.symfony.com/doc/ruleSets/SymfonyRisky.html),
      a selection of 15 rules enabled, and **1 overriden**:
        * [php_unit_test_annotation](https://cs.symfony.com/doc/rules/php_unit/php_unit_test_annotation.html),
          uses `annotation` (to allow `it_` prefix, phpspec style) instead of `prefix`
    * [PHP CS Fixer rule set](https://cs.symfony.com/doc/ruleSets/PHPCSFixer.html),
      a selection of 4 rules enabled
    * [PHP CS Fixer risky rule set](https://cs.symfony.com/doc/ruleSets/PHPCSFixerRisky.html),
      a selection of 6 rules enabled
    * a unique selection of 16 rules

> **Note**: The static method `ConfigBuilder::forPath` will return an instance
> of `ConfigBuilder` which provides four public attributes:
>
> * `finder`, which is set with defaults values returned by
>   `Ssc\Cs\Factory\Finder::inPath(string $path)`
> * `parallelConfig`, which is set with defaults values returned by
>   `PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect()`
> * `rules`, which is set with defaults values returned by
>   `Ssc\Cs\Factory\Rules::make()`
> * `usingCache`, which is set with `true` as a default value
>
> Then, calling the `ConfigBuilder->build()` method will return an instance of
> `PhpCsFixer\Config` set up with these values.

## Customization

### License Header

The `ConfigBuilder->withLicenseHeader(string $licenceHeader)` method is a
shortcut that allows configuring a License Header PHPdoc.

With `Ssc\Cs\Factory\LicenseHeader::forPackage(string $name, array $owners, string $template = self::DEFAULT_TEMPLATE)`,
it's possible to only provide the minimum relevant information:

```php
<?php

return \Ssc\Cs\ConfigBuilder::forPath(__DIR__)
    ->withLicenseHeader(\Ssc\Cs\Factory\LicenseHeader::forPackage(
        name: 'ssc/lib',
        owners: [[
            'name' => 'Loïc Faugeron',
            'email' => 'faugeron.loic@gmail.com',
        ]],
    ))
    ->build()
;
```

> **Note**: while `owners` is an array,
> currently only the first element will be taken into account.

The default template used is similar to the following:

```
This file is part of the {{ package_name }} package.

(c) {{ owner_name }} <{{ owner_email }}>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
```

If the format doesn't fit your need you can provide a different template,
it can be any string, with the following placeholders being recognized:

* `{{ package_name }}`
* `{{ owner_name }}`
* `{{ owner_email }}`

Or you can alternatively skip the template and pass the header as a string:

```php
<?php

$licenceHeader =<<<TXT
ALL YOUR BASE ARE BELONG TO US
HA HA HA HA ....
TXT;

return \Ssc\Cs\ConfigBuilder::forPath(__DIR__)
    ->withLicenseHeader($licenceHeader);
    ->build()
;
```

### Rules

It's possible to override the rules used, to either add some or disable some:

```php
// using array_merge to add some value, and override existing ones
$configBuilder->rules = \array_merge($configBuilder->rules, [
    // With @PER-CS2.0 (and SSC), type casting looks like `(int) $total`
    // If you prefer no spaces, `(int)$total`, use the following instead:
    'cast_spaces' => 'none',

    // SSC requires the `declare(strict_types=1);`,
    // Use the line below to disable it:
    'declare_strict_types' => false,
]);
```

It's also possible to completely override all of them:

```php
// setting a new array to rease all previous values and replace them
$configBuilder->rules = [
    // Use the RuleSet of your choice:
    '@PhpCsFixer' => true,

    // You can also throw in some rules that fit your team:
    'psr_autoloading' => true,
];
```

## Want to know more?

* [copyright and MIT license](LICENSE)

You can find more information in the monorepo that groups all SSC libraries:
[ssc/lib](https://github.com/gnugat/ssc-lib/releases)

> _Note_: No contributions accepted in the libraries' individual repositories,
> Pull Requests and Issues should be submitted to the monorepo linked above instead.
