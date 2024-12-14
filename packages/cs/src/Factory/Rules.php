<?php

/**
 * This file is part of the ssc/lib package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Ssc\Cs\Factory;

class Rules
{
    public static function make(): array
    {
        return [
            // Rule Sets
            '@Symfony' => true,
            '@PHP56Migration:risky' => true, // @Symfony:risky
            '@PER-CS:risky' => true, // @PhpCsFixer:risky, contains @PSR12:risky included in @Symfony:risky

            // alias
            'ereg_to_preg' => true, // @Symfony:risky
            'no_alias_functions' => true, // @Symfony:risky
            'set_type_to_cast' => true, // @Symfony:risky

            // basic
            'psr_autoloading' => true, // @Symfony:risky

            // cast_notation
            'modernize_types_casting' => true, // @Symfony:risky
            'no_php4_constructor' => true, // @Symfony:risky

            // class_notation
            'no_unneeded_final_method' => true, // @Symfony:risky
            // use_trait? 'ordered_class_elements' => true,
            'ordered_interfaces' => true, // SSC
            'protected_to_private' => true, // SSC
            'self_accessor' => true, // @Symfony:risky
            'visibility_required' => [
                // Overrides `@PSR2`
                // explicitly omits `method`, for phpspec test methods
                'elements' => ['property', 'const'],
            ],

            // control_structures
            'no_superfluous_elseif' => true, // SSC
            'no_useless_else' => true, // SSC

            // function_notation
            'fopen_flag_order' => true, // @Symfony:risky
            'implode_call' => true, // @Symfony:risky
            'void_return' => true, // SSC

            // language_construct
            'dir_constant' => true, // @Symfony:risky
            'explicit_indirect_variable' => true, // SSC
            'is_null' => true, // @Symfony:risky
            'no_unset_on_property' => true, // @PhpCsFixer:risky

            // list_notation
            'list_syntax' => [ // SSC
                'syntax' => 'short',
            ],

            // operator
            'logical_operators' => true, // @Symfony:risky
            'ternary_to_null_coalescing' => true, // SSC

            // php_unit
            'php_unit_expectation' => true, // SSC
            'php_unit_method_casing' => [
                // Overrides `@Symfony`
                // uses `snake_case` (phpspec style) instead of `camel_case`
                'case' => 'snake_case',
            ],
            'php_unit_mock_short_will_return' => true, // @Symfony:risky
            'php_unit_namespaced' => true, // SSC
            'php_unit_no_expectation_annotation' => true, // SSC
            'php_unit_set_up_tear_down_visibility' => true, // @Symfony:risky
            'php_unit_strict' => true, // @PhpCsFixer:risky
            'php_unit_test_annotation' => [
                // Overrides `@Symfony:risky`
                // uses `annotation` (to allow `it_` prefix, phpspec style) instead of `prefix`
                'style' => 'annotation',
            ],
            'php_unit_test_case_static_method_calls' => [ // @PhpCsFixer:risky
                'call_type' => 'self',
            ],

            // semicolon
            'multiline_whitespace_before_semicolons' => [ // @PhpCsFixer
                'strategy' => 'new_line_for_chained_calls',
            ],

            // strict
            'strict_comparison' => true, // @PhpCsFixer:risky
            'strict_param' => true, // @PhpCsFixer:risky
            'declare_strict_types' => true, // SSC

            // string_notation
            'explicit_string_variable' => true, // @PhpCsFixer
            'heredoc_to_nowdoc' => true, // @PhpCsFixer
            'static_lambda' => true, // @PhpCsFixer:risky

            // whitespace
            'heredoc_indentation' => true, // SSC
            'method_chaining_indentation' => true, // @PhpCsFixer
        ];
    }
}
