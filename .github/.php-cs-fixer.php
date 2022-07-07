<?php declare(strict_types = 1);

$finder = Symfony\Component\Finder\Finder::create()
    ->notPath(dirname(__DIR__, 1) . '/bootstrap/*')
    ->notPath(dirname(__DIR__, 1) . '/storage/*')
    ->notPath(dirname(__DIR__, 1) . '/vendor')
    ->notPath(dirname(__DIR__, 1) . '/resources/view/mail/*')
    ->in([
        dirname(__DIR__, 1) . '/src',
        dirname(__DIR__, 1) . '/tests',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR2'                             => true,
        'array_syntax'                      => ['syntax' => 'short'],
        'ordered_imports'                   => ['sort_algorithm' => 'length'],
        'no_unused_imports'                 => true,
        'not_operator_with_successor_space' => true,
        'trailing_comma_in_multiline'       => ['elements' => ['arrays']],
        'phpdoc_scalar'                     => true,
        'unary_operator_spaces'             => true,
        'binary_operator_spaces'            => [
            'operators' => ['=' => 'align', '=>' => 'align'],
        ],
        'blank_line_before_statement' => [
            'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
        ],
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_var_without_name'        => true,
        'class_attributes_separation'    => [
            'elements' => [
               'method'   => 'one',
               'property' => 'one',
            ],
        ],
        'method_argument_space' => [
            'on_multiline'                     => 'ensure_fully_multiline',
            'keep_multiple_spaces_after_comma' => true,
        ],
        'method_chaining_indentation'        => true,
        'object_operator_without_whitespace' => true,
        'no_superfluous_phpdoc_tags'         => true,
        'function_declaration'               => [
            'closure_function_spacing' => 'none',
        ],
    ])
    ->setFinder($finder);
