#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use PhpCsFixer\RuleSet\Sets;

$ruleSets = [
    '@Symfony' => (new Sets\SymfonySet())->getRules(),
    '@PER-CS2.0' => (new Sets\PERCS2x0Set())->getRules(),
    '@PER-CS1.0' => (new Sets\PERCS1x0Set())->getRules(),
    '@PSR12' => (new Sets\PSR12Set())->getRules(),
    '@PSR2' => (new Sets\PSR2Set())->getRules(),
    '@PSR1' => (new Sets\PSR1Set())->getRules(),

    // '@SymfonyRisky' => (new Sets\SymfonyRiskySet())->getRules(),
    '@PHP56Migration:risky' => (new Sets\PHP56MigrationRiskySet())->getRules(),
    '@PSR12:risky' => (new Sets\PSR12RiskySet())->getRules(),

    // '@PhpCsFixer' => (new Sets\PhpCsFixerSet())->getRules(),
    '@PER-CS' => (new Sets\PERCSSet())->getRules(),
    
    // '@PhpCsFixer:risky' => (new Sets\PhpCsFixerRiskySet())->getRules(),
    '@PER-CS:risky' => (new Sets\PERCSRiskySet())->getRules(),
    '@PER-CS2.0:risky' => (new Sets\PERCS2x0RiskySet())->getRules(),
    '@PER-CS1.0:risky' => (new Sets\PERCS1x0RiskySet())->getRules(),
];

$stats = [
    'Overrides' => 0,
    'Duplicates' => 0,
    'Unique' => 0,
];
$sscRules = \Ssc\Cs\Factory\Rules::make();
foreach ($sscRules as $rule => $sscConfig) {
    if (str_starts_with($rule, '@')) {
        continue;
    }
    foreach ($ruleSets as $ruleSet => $rules) {
        if (array_key_exists($rule, $rules)) {
            $ruleSetConfig = $rules[$rule];
            if ($sscConfig !== $ruleSetConfig) {
                $stats['Overrides']++;
                echo "ℹ️  Rule {$rule} overrides the one defined in {$ruleSet}\n";
                echo '   SSC: '.config_to_string($sscConfig)."\n";
                echo "   {$ruleSet}: ".config_to_string($ruleSetConfig)."\n";

                continue;
            }
            $stats['Duplicates']++;
            echo "⚠️  Rule {$rule} is a duplicate of the one defined in {$ruleSet}\n";

            continue;
        }
    }
    $stats['Unique']++;
    echo "✅ Rule {$rule} from SSC is unique\n";
}

foreach ($stats as $metric => $total) {
    echo "{$metric}: {$total}\n";
}

function config_to_string(mixed $config): string {
    if (is_bool($config)) {
        return $config ? 'true' : 'false';
    }
    if (is_array($config)) {
        return json_encode($config);
    }

    echo "🚨 Unknown config format\n";
    var_dump($config);die;
}
