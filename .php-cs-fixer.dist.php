<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCSIgnored(true);

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR12'                             => true,
    '@DoctrineAnnotation'                => true,
    'blank_line_after_opening_tag'       => true,
    'blank_line_between_import_groups'   => true,
    'braces'                             => [
        'allow_single_line_anonymous_class_with_empty_body' => true,
    ],
    'class_definition'                   => [
        'inline_constructor_arguments' => false,
        'space_before_parenthesis'     => true,
    ],
    'compact_nullable_typehint'          => true,
    'declare_equal_normalize'            => true,
    'lowercase_cast'                     => true,
    'lowercase_static_reference'         => true,
    'new_with_braces'                    => true,
    'no_blank_lines_after_class_opening' => true,
    'no_leading_import_slash'            => true,
    'no_whitespace_in_blank_line'        => true,
    'ordered_class_elements'             => ['order' => ['use_trait']],
    'ordered_imports'                    => [
        'imports_order'  => [
            'class',
            'function',
            'const'
        ],
        'sort_algorithm' => 'none',
    ],
    'return_type_declaration'            => true,
    'short_scalar_cast'                  => true,
    'single_import_per_statement'        => ['group_to_single_imports' => false],
    'single_trait_insert_per_statement'  => true,
    'ternary_operator_spaces'            => true,
    'visibility_required'                => true,
    'array_syntax'                       => ['syntax' => 'short'],
    'strict_param'                       => false,

    // Risky rules
    'void_return'                        => true,
    'declare_strict_types'               => true
])->setFinder($finder);
