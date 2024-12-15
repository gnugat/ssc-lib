# CHANGELOG

## 0.0.8: Created `ssc/cs-tk` - `format-to-pcs`

Maintaining a Coding Standard configuration is hard.

With `format-to-pcs`, you get to see what the SSC CS config would look like
if you had manually configured your PHP CS Fixer with equivalent settings.

Running:

```console
php ./packages/cs-tk/bin/format-to-pcs.php
```

Will print:

```php
<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('bin')
    ->exclude('cache')
    ->exclude('config')
    ->exclude('doc')
    ->exclude('logs')
    ->exclude('public')
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'psr_autoloading' => true,
        'php_unit_method_casing' => [
            'case' => 'snake_case',
        ],
    ])
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setUsingCache(true)
    ->setFinder($finder)
;
```

## 0.0.7: Upgrading `ssc/cs`

* added `config`, `public` and `var` to the list of excluded folders

## 0.0.6: Fixed coucsous

## 0.0.5: Tidied up project

* Configured and Applied `ssc/cs` in all of `ssc/lib`
* Fixed documentation typo
* Updated couscous

## 0.0.4: Created `ssc/cs`

Shared Coding Standards configuration, for SSC.

Provides [PHP CS Fixer](https://cs.symfony.com/) configuration,
with default for the SSC projects.

Configure in `.php-cs-fixer.dist.php`:

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

## 0.0.3: Tidied up project

* Introduced Coding Standards
* Added License headers
* Harmonised `composer.json` files

## 0.0.2: Created `ssc/exception`

When an error occurs, one of the following exception has to be thrown:

* **400** `ClientErrorException`: request with malformed syntax (example: invalid JSON)
* **401** `UnauthorizedException`: an authentication error (missing or invalid credentials)
* **403** `ForbiddenException`: an authorization error (credentials found and valid, but not allowed for this resource)
* **404** `NotFoundException`: an error when trying to locate a resource (doesn't exist or has been removed)
* **422** `ValidationFailedException`: an error when trying to validate a resource
* **500** `ServerErrorException`: application crashed

All of those exceptions are a subtype of `SscException` which provides
the possibility to add an error code:

```php
throw NotFoundException::make('No Product found for ID 42')
    ->withCode(4423)
;
```

## 0.0.1: First Monorepo Test

* Testing monorepo-builder, round 1

## 0.0.0: Initiated

* ssc/lib created
