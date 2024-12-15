#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\VarExporter\VarExporter;

$stringDumper = new \Ssc\CsTk\StringDumper();
$configBuilder = \Ssc\Cs\ConfigBuilder::forPath(__DIR__);

// Start of file
echo <<<'CONFIG'
<?php

CONFIG;

// Finder
echo <<<'CONFIG'

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

CONFIG;

// Config
echo <<<'CONFIG'

return (new PhpCsFixer\Config())

CONFIG;

// Rules
$rules = VarExporter::export($configBuilder->rules);
$rules = str_replace("\n", "\n    ", $rules); // Fixes indentation
echo <<<CONFIG
    ->setRules({$rules})

CONFIG;

// Parallel Config
echo <<<CONFIG
    ->setParallelConfig(ParallelConfigFactory::detect())

CONFIG;

// Using Cache
$usingCache = VarExporter::export($configBuilder->usingCache);
echo <<<CONFIG
    ->setUsingCache({$usingCache})

CONFIG;

// Finder
echo <<<'CONFIG'
    ->setFinder($finder)

CONFIG;

// End of File
echo <<<'CONFIG'
;

CONFIG;
