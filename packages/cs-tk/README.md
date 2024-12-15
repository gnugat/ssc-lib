# SSC - CS - Toolkit

Maintaining a Coding Standard configuration is hard.

So here are some tools to help take the load off your mind.

## Installation

```console
composer require --dev ssc/cs-tk
```

### Format SSC config to PHP CS Fixer

SSC CS provides a `ConfigBuilder` to make your life easier:

```php
<?php
// File: .php-cs-fixer.dist.php

return \Ssc\Cs\ConfigBuilder::forPath(__DIR__)
    ->build()
;
```

And that works perfectly fine with PHP CS Fixer.

When Coding Standards are updated in the `ssc/cs` package, all you need to do
is run `composer update` in all your project and they'll all benefit from it.

But this doesn't show you what rules and configuration is used, you have to
check the source files for that or rely on the documentation.

With `format-to-pcs`, you get to see what the SSC CS config would look like
if you had manually configured your PHP CS Fixer with equivalent settings.

Running:

```console
#./ssc-cs-tk format-to-pcs
php ./bin/format-to-pcs.php
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

## Want to know more?

* [copyright and MIT license](LICENSE)

You can find more information in the monorepo that groups all SSC libraries:
[ssc/lib](https://github.com/gnugat/ssc-lib/releases)

> _Note_: No contributions accepted in the libraries' individual repositories,
> Pull Requests and Issues should be submitted to the monorepo linked above instead.
