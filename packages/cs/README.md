# SSC - CS

Shared Coding Standards configuration, for SSC.

Provides [PHP CS Fixer](https://cs.symfony.com/) configuration,
with default for the SSC projects.

## Installation

```console
composer require ssc/cs
```

Configure in `.php-cs-fixer.dist.php`:

```php
<?php

return \Ssc\Cs\ConfigBuilder::forPath(__DIR__)
    ->build()
;
```

The static method `ConfigBuilder::forPath` will return an instance of
`ConfigBuilder` with default values for the following public properties:

* `$configBuilder->finder` (see `./src/Factory/Finder.php`),
  will look for files:
    * with the PHP extension (`*.php`)
    * located in given path and descendant folders
      (`__DIR__` in example above, which would be the root of your project)
    * but will not look in folders named
      `vendor`, `bin`, `cache`, `doc` and `logs`
* `$configBuilder->parallelConfig` (see `ParallelConfigFactory::detect()`)
  will enable the parallel runner
* `$configBuilder->rules` (see `./src/Factory/Rules.php`),
  will use a custom list of rules
* `$configBuilder->usingCache` will enable caching

Then, calling the `$configBuilder->build()` method will return an instance of
`PhpCsFixer\Config` set up with these values.

> **Note**: By default there's a large amount of custom rules set up,
> but SSC also relies on the following rule set:
>
> * `@Symfony`
> * `@PER-CS2.0` (this is included in `@Symfony`)
> * `@PER-CS1.0` (this is included in `@PER-CS2.0`)
> * `@PSR12` (this is included in `@PER-CS1.0`)
> * `@PSR2` (this is included in `@PSR12`)
> * `@PSR1` (this is included in `@PSR2`)
>
> * `@PHP56Migration:risky`
>
> * `@PER-CS:risky`
> * `@PER-CS2.0:risky` (this is included in `@PER-CS:risky`)
> * `@PER-CS1.0:risky` (this is included in `@PER-CS2.0:risky`)
> * `@PSR12:risky` (this is included in `@PER-CS1.0:risky`)
>
> However, the following rules have been overridden:
>
> ```php
>     'visibility_required' => [
>         // Overides `@PSR2`
>         // explicitly omits `method`, for phpspec test methods
>         'elements' => ['property', 'const'],
>     ],
>     'php_unit_method_casing' => [
>         // Overides `@Symfony`
>         // uses `snake_case` (phpspec style) instead of `camel_case`
>         'case' => 'snake_case',
>     ],
> ```

## Customization

The `ConfigBuilder` attributes are public to allow customization,
here are some examples.

### License Header

The `ConfigBuilder->withLicenseHeader` method is a shortcut that allows
configuring a License Header PHPdoc.

A factory that provides a template can even be used
(see `./src/Factory/LicenseHeader.php`):

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

It uses an optional third parameter `template` which looks like this
(see `LicenseHeader::DEFAULT_TEMPLATE`):
:

```
This file is part of the {{ package_name }} package.

(c) {{ owner_name }} <{{ owner_email }}>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
```

If the format doesn't fit your need you can provide a different template,
which follows the same schema, ie has the following placeholders:

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
$configBuilder->rules = \array_merge($configBuilder->rules, [
    // @PER-CS2.0 (and SSC) CS specify casts as follow `(int) $total`
    // Use the line below to have no spaces, `(int)$total`, instead:
    'cast_spaces' => 'none',

    // SSC requires the `declare(strict_types=1);`,
    // Use the line below to disable it:
    'declare_strict_types' => false,
]);
```

It's also possible to completely override all of them:

```php
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
