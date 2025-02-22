<?php

use PhpCsFixer\Finder;
use PhpCsFixer\Config;


$finder = (new Finder())
    ->in(__DIR__)
    ->exclude('var');

return (new Config())
    ->setRules([
        '@PER-CS2.0'                                    => true,
        '@PSR12'                                        => true,
        'phpdoc_param_order'                            => true,
        'phpdoc_return_self_reference'                  => true,
        'phpdoc_scalar'                                 => true,
        'phpdoc_separation'                             => true,
        'phpdoc_single_line_var_spacing'                => true,
        'phpdoc_summary'                                => true,
        'phpdoc_tag_casing'                             => true,
        'phpdoc_tag_type'                               => true,
        'phpdoc_to_comment'                             => false,
        'phpdoc_trim'                                   => true,
        'phpdoc_add_missing_param_annotation'           => false,
        'phpdoc_align'                                  => true,
        'phpdoc_annotation_without_dot'                 => true,
        'phpdoc_indent'                                 => true,
        'phpdoc_inline_tag_normalizer'                  => true,
        'phpdoc_no_access'                              => true,
        'phpdoc_no_alias_tag'                           => true,
        'phpdoc_no_empty_return'                        => true,
        'phpdoc_no_package'                             => true,
        'phpdoc_no_useless_inheritdoc'                  => true,
        'phpdoc_order'                                  => true,
        'phpdoc_order_by_value'                         => [
            'annotations' => [
                'covers',
                'dataProvider',
                'throws',
                'uses',
            ],
        ],
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_types'                                  => ['groups' => ['simple', 'meta']],
        'phpdoc_types_order'                            => true,
        'phpdoc_var_annotation_correct_order'           => true,
        'phpdoc_var_without_name'                       => true,
        'header_comment'                                => [
            'comment_type' => 'PHPDoc',
            'header'       => 'All Rights Reserved' . PHP_EOL . '@copyright Copyright (C) Michal Talar',
        ],
    ])
    ->setFinder($finder);
