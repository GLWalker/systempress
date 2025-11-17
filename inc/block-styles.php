<?php

/**
 * SystemPress Block Styles
 *
 * @package SystemPress
 * @since 0.0.1
 * @author G.L. Walker
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Register custom block styles for SystemPress.
 */
add_action('init', function () {

    // Squared Button stlye for Button block.
    register_block_style(
        'core/button',
        array(
            'name'         => 'squared',
            'label'        => __('Squared', 'systempress'),
        )
    );
    // Squared Button stlye for Button block.
    register_block_style(
        'core/button',
        array(
            'name'         => 'outline-squared',
            'label'        => __('Squared Outline', 'systempress'),
        )
    );
    // Link Button stlye for Button block.
    register_block_style(
        'core/button',
        array(
            'name'         => 'link',
            'label'        => __('Link', 'systempress'),
        )
    );

    // Pill style for Post Terms block.
    register_block_style(
        'core/post-terms',
        array(
            'name'         => 'pill',
            'label'        => __('Pill', 'systempress'),
        )
    );

    // Pill style for Tag Cloud block.
    register_block_style(
        'core/tag-cloud',
        array(
            'name'         => 'pill',
            'label'        => __('Pill', 'systempress'),
            'inline_style' => '
                .is-style-pill a.tag-cloud-link {
                    display: inline-block;
                    background-color: var(--wp--preset--color--bs-secondary-bg);
                    color: var(--wp--preset--color--bs-secondary-color);
                    padding: var(--bs-sp-spacing-y) var(--bs-sp-spacing-x);
                    margin-bottom: var(--bs-sp-spacing-y);
                    border-radius: var(--wp--preset--spacing--20);
                    line-height: 1 !important;
                    vertical-align: middle;
                }

                .is-style-pill a.tag-cloud-link:hover {
                    background-color: var(--wp--preset--color--bs-tertiary-color);
                    color: var(--wp--preset--color--bs-tertiary-bg);
                }
            ',
        )
    );

    register_block_style(
        'core/list',
        array(
            'name'         => 'checkmark-list',
            'label'        => __('Checkmark', 'systempress'),
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
