<?php

/**
 * SystemPress Block Styles
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 *
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('init', function () {

    register_block_style(
        'core/post-terms',
        array(
            'name'         => 'pill',
            'label'        => __('Pill', 'systempress'),
            /*
             * Styles variation for post terms
             * https://github.com/WordPress/gutenberg/issues/24956
             */
            'inline_style' => '
            .is-style-pill a,
            .is-style-pill span:not([class], [data-rich-text-placeholder]) {
                display: inline-block;
                background-color: var(--wp--preset--color--bs-secondary-bg);
                color: var(    --wp--preset--color--bs-secondary-color);
                padding: var(--bs-sp-spacing-y) var(--bs-sp-spacing-x);
                margin-bottom: var(--bs-sp-spacing-y);
                border-radius: var(--wp--preset--spacing--20);
                font-size: var(--wp--preset--font-size--small);
            }

            .is-style-pill a:hover {
                background-color: var(--wp--preset--color--bs-tertiary-color);
                color: var(--wp--preset--color--bs-tertiary-bg);
            }',
        )
    );

    register_block_style(
        'core/tag-cloud',
        array(
            'name'         => 'pill',
            'label'        => __('Pill', 'systempress'),
            /*
             * Styles variation for tag cloud
             * https://github.com/WordPress/gutenberg/issues/24956
             */
            'inline_style' => '.is-style-pill a.tag-cloud-link {
                display: inline-block;
                background-color: var(--wp--preset--color--bs-secondary-bg);
                color: var(    --wp--preset--color--bs-secondary-color);
                padding: var(--bs-sp-spacing-y) var(--bs-sp-spacing-x);
                margin-bottom: var(--bs-sp-spacing-y);
                border-radius: var(--wp--preset--spacing--20);
                line-height: 1 !important;
                verticle-align: middle;

            }

            .is-style-pill a.tag-cloud-link:hover {
                background-color: var(--wp--preset--color--bs-tertiary-color);
                color: var(--wp--preset--color--bs-tertiary-bg);
            }',
        )
    );

    register_block_style(
        'core/list',
        array(
            'name'         => 'checkmark-list',
            'label'        => __('Checkmark', 'systempress'),
            /*
             * Styles for the custom checkmark list block style
             * https://github.com/WordPress/gutenberg/issues/51480
             */
            'inline_style' => '
            ul.is-style-checkmark-list {
                list-style-type: "\2713";
            }

            ul.is-style-checkmark-list li {
                padding-inline-start: 1ch;
            }',
        )
    );
});
