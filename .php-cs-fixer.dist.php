<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__)
    ->exclude(['application/cache', 'application/views', 'system', 'vendor'])
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new Config();

return $config->setRules([
    '@PSR12' => true,
    // Alias
    'array_push' => true,
    'backtick_to_shell_exec' => true,
    'mb_str_functions' => true,
    'no_mixed_echo_print' => true,
    'pow_to_exponentiation' => true,
    'random_api_migration' => true,
    'set_type_to_cast' => true,

    // Arrays
    'array_syntax' => true,
    'no_multiline_whitespace_around_double_arrow' => true,
    'no_trailing_comma_in_singleline_array' => true,
    'no_whitespace_before_comma_in_array' => true,
    'normalize_index_brace' => true,
    'trim_array_spaces' => true,
    'whitespace_after_comma_in_array' => true,

    // Basic
    'braces' => true,
    'encoding' => true,
    'non_printable_character' => true,
    'psr_autoloading' => true,

    // Casing
    'constant_case' => true,
    'lowercase_keywords' => true,
    'lowercase_static_reference' => true,
    'magic_constant_casing' => true,
    'magic_method_casing' => true,
    'native_function_casing' => true,
    'native_function_type_declaration_casing' => true,

    // Cast notation
    'cast_spaces' => true,
    'lowercase_cast' => true,
    'modernize_types_casting' => true,
    'no_short_bool_cast' => true,
    'no_unset_cast' => true,
    'short_scalar_cast' => true,

    // Class notation
    'class_attributes_separation' => true,
    'class_definition' => true,
    'no_blank_lines_after_class_opening' => true,
    'no_null_property_initialization' => true,
    'no_php4_constructor' => true,
    'no_unneeded_final_method' => true,
    'ordered_class_elements' => true,
    'ordered_interfaces' => true,
    'ordered_traits' => true,
    'self_accessor' => true,
    'self_static_accessor' => true,
    'single_class_element_per_statement' => true,
    'single_trait_insert_per_statement' => true,
    'visibility_required' => true,

    // Comments
    'comment_to_phpdoc' => true,
    'multiline_comment_opening_closing' => true,
    'no_empty_comment' => true,
    'no_trailing_whitespace_in_comment' => true,
    'single_line_comment_style' => true,

    // Control structure
    'elseif' => true,
    'include' => true,
    'no_break_comment' => true,
    'no_superfluous_elseif' => true,
    'no_unneeded_control_parentheses' => true,
    'no_unneeded_curly_braces' => true,
    'no_useless_else' => true,
    'simplified_if_return' => true,
    'switch_case_semicolon_to_colon' => true,
    'switch_case_space' => true,
    'switch_continue_to_break' => true,
    'trailing_comma_in_multiline' => true,

    // Function notation
    'combine_nested_dirname' => true,
    'fopen_flag_order' => true,
    'fopen_flags' => true,
    'function_declaration' => true,
    'function_typehint_space' => true,
    'implode_call' => true,
    'lambda_not_used_import' => true,
    'method_argument_space' => true,
    'no_spaces_after_function_name' => true,
    'no_unreachable_default_argument_value' => true,
    'no_useless_sprintf' => true,
    'nullable_type_declaration_for_default_null_value' => true,
    'regular_callable_call' => true,
    'return_type_declaration' => true,
    'single_line_throw' => true,
    'static_lambda' => true,
    'use_arrow_functions' => true,
    'void_return' => true,

    // Import
    'fully_qualified_strict_types' => true,
    'global_namespace_import' => true,
    'no_leading_import_slash' => true,
    'no_unused_imports' => true,
    'ordered_imports' => true,
    'single_import_per_statement' => true,
    'single_line_after_imports' => true,

    // Language constructs
    'combine_consecutive_issets' => true,
    'combine_consecutive_unsets' => true,
    'dir_constant' => true,
    'error_suppression' => true,
    'explicit_indirect_variable' => true,
    'function_to_constant' => true,
    'is_null' => true,
    'no_unset_on_property' => true,
    'single_space_after_construct' => true,

    // List notation
    'list_syntax' => ['syntax' => 'short'],

    // Namespace notations
    'blank_line_after_namespace' => true,
    'clean_namespace' => true,
    'no_leading_namespace_whitespace' => true,
    'single_blank_line_before_namespace' => true,

    // Naming
    'no_homoglyph_names' => true,

    // Operator
    'binary_operator_spaces' => true,
    'concat_space' => ['spacing' => 'one'],
    'increment_style' => true,
    'logical_operators' => true,
    'new_with_braces' => true,
    'not_operator_with_successor_space' => true,
    'object_operator_without_whitespace' => true,
    'operator_linebreak' => true,
    'standardize_increment' => true,
    'standardize_not_equals' => true,
    'ternary_operator_spaces' => true,
    'ternary_to_elvis_operator' => true,
    'ternary_to_null_coalescing' => true,
    'unary_operator_spaces' => true,

    // PHP tag
    'blank_line_after_opening_tag' => true,
    'full_opening_tag' => true,
    'linebreak_after_opening_tag' => true,
    'no_closing_tag' => true,

    // PHPUnit
    'php_unit_construct' => true,
    'php_unit_dedicate_assert' => true,
    'php_unit_dedicate_assert_internal_type' => true,
    'php_unit_expectation' => true,
    'php_unit_fqcn_annotation' => true,
    'php_unit_internal_class' => ['types' => ['final']],
    'php_unit_method_casing' => ['case' => 'snake_case'],
    'php_unit_mock' => true,
    'php_unit_mock_short_will_return' => true,
    'php_unit_namespaced' => true,
    'php_unit_no_expectation_annotation' => true,
    'php_unit_set_up_tear_down_visibility' => true,
    'php_unit_size_class' => true,
    'php_unit_strict' => true,
    'php_unit_test_annotation' => ['style' => 'prefix'],
    'php_unit_test_case_static_method_calls' => true,
    'php_unit_test_class_requires_covers' => true,

    // PHPDoc
    'align_multiline_comment' => true,
    'no_blank_lines_after_phpdoc' => true,
    'no_empty_phpdoc' => true,
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_indent' => true,
    'phpdoc_inline_tag_normalizer' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_order' => true,
    'phpdoc_return_self_reference' => true,
    'phpdoc_scalar' => true,
    'phpdoc_summary' => true,
    'phpdoc_to_comment' => true,
    'phpdoc_trim_consecutive_blank_line_separation' => true,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'phpdoc_types_order' => true,

    // Return notation
    'no_useless_return' => true,
    'return_assignment' => true,
    'simplified_null_return' => true,

    // Semicolon
    'multiline_whitespace_before_semicolons' => true,
    'no_empty_statement' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'semicolon_after_instruction' => true,

    // Strict
    'strict_comparison' => true,
    'strict_param' => true,

    // String notation
    'escape_implicit_backslashes' => true,
    'explicit_string_variable' => true,
    'heredoc_to_nowdoc' => true,
    'no_binary_string' => true,
    'no_trailing_whitespace_in_string' => true,
    'simple_to_complex_string_variable' => true,
    'single_quote' => true,
    'string_line_ending' => true,

    // Whitespace
    'array_indentation' => true,
    'blank_line_before_statement' => true,
    'compact_nullable_typehint' => true,
    'heredoc_indentation' => true,
    'indentation_type' => true,
    'line_ending' => true,
    'method_chaining_indentation' => true,
    'no_extra_blank_lines' => true,
    'no_spaces_around_offset' => true,
    'no_spaces_inside_parenthesis' => true,
    'no_trailing_whitespace' => true,
    'no_whitespace_in_blank_line' => true,
    'single_blank_line_at_eof' => true,
])->setFinder($finder);
