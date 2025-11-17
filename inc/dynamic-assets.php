<?php

/**
 * SystemPress Dynamic Assets
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Checks if any of the specified block attributes are present in the content.
 *
 * @param string $content The content to search through (typically the block's HTML content).
 * @param array $attrs An array of attribute strings to search for in the content.
 *
 * @return bool Returns `true` if any of the specified attributes are found in the content,
 *              otherwise `false`.
 */
function sp_has_any_block_attrs($content, $attrs)
{
    // Ensure $attrs is an array
    if (!is_array($attrs)) {
        $attrs = (array) $attrs;
    }

    foreach ($attrs as $attr) {
        // Convert arrays to space-separated strings before checking
        if (is_array($attr)) {
            $attr = implode(' ', array_filter($attr));
        }

        // Ensure we only check valid strings
        if (!is_string($attr) || $attr === '') {
            continue;
        }

        // Create a pattern to match the exact attribute name as a word boundary
        $pattern = '/\b' . preg_quote($attr, '/') . '\b/';

        // Check if the pattern exists in the content
        if (preg_match($pattern, $content)) {
            return true;
        }
    }

    return false;
}

/**
 * Add paths to stylesheets for inline script
 */
if (!function_exists('sp_inline_bootstrap_assets')) {
    function sp_inline_bootstrap_assets($component, $usePath = false)
    {
        static $loaded_assets = []; // Keeps track of loaded components.

        // Check if the asset is already loaded.
        if (isset($loaded_assets[$component])) {
            return;
        }

        $dir = '';
        $load_js = ($usePath === 'script'); // Load JS only if explicitly set to 'script'

        // Determine directory for responsive styles
        if (is_string($usePath) && in_array($usePath, ['sm', 'md', 'lg', 'xl', 'xxl'], true)) {
            $dir = "{$usePath}/"; // Set directory for responsive styles
            $load_js = false; // Prevent JavaScript loading when using responsive styles
        }

        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        $base_path = get_template_directory() . '/assets';

        // Adjust file paths
        $css_file = "{$base_path}/css/bootstrap/{$dir}{$component}{$suffix}.css";
        $js_file = "{$base_path}/js/bootstrap/{$component}{$suffix}.js";

        // Load CSS
        if (file_exists($css_file)) {
            if (defined('SP_LOAD_BOOTSTRAP_STYLESHEETS') && SP_LOAD_BOOTSTRAP_STYLESHEETS) {
                wp_enqueue_style("{$component}", get_template_directory_uri() . "/assets/css/bootstrap/{$dir}{$component}{$suffix}.css", ['@bootstrap'], null);
            } else {
                $css = file_get_contents($css_file);
                wp_add_inline_style('@bootstrap', $css);
            }
        }

        // Load JS only if "script" is explicitly set
        if ($load_js && file_exists($js_file)) {
            if (defined('SP_LOAD_BOOTSTRAP_JAVASCRIPTS') && SP_LOAD_BOOTSTRAP_JAVASCRIPTS) {
                wp_enqueue_script("{$component}", get_template_directory_uri() . "/assets/js/bootstrap/{$component}{$suffix}.js", ['@shared'], null, true);
            } else {
                $js = file_get_contents($js_file);
                wp_add_inline_script('@shared', $js);
            }
        }

        // Mark this component as loaded.
        $loaded_assets[$component] = true;
    }
}

if (!function_exists('sp_inline_bootstrap_color_assets')) {
    function sp_inline_bootstrap_color_assets($component)
    {
        static $loaded_assets = []; // Keeps track of loaded components.

        // Check if the asset is already loaded.
        if (isset($loaded_assets[$component])) {
            return;
        }

        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        $base_path = get_template_directory() . '/assets';

        // Add the CSS inline style.
        $css_file = "{$base_path}/css/bootstrap-colors/{$component}{$suffix}.css";

        if (file_exists($css_file)) {
            if (defined('SP_LOAD_BOOTSTRAP_STYLESHEETS') && SP_LOAD_BOOTSTRAP_STYLESHEETS) {
                wp_enqueue_style("{$component}", get_template_directory_uri() . "/assets/css/bootstrap-colors/{$component}{$suffix}.css", ['@bootstrap'], null);
            } else {
                $css = file_get_contents($css_file);
                wp_add_inline_style('global-styles', $css);
            }
        }

        // Mark this component as loaded.
        $loaded_assets[$component] = true;
    }
}

/**
 * Prepare to enqueue any assets as found by attributes
 */
if (!function_exists('sp_compile_bootstrap_assets')) {

    function sp_compile_bootstrap_assets($content)
    {
        $asset_map = [
            'bs-accordion' => [
                'classes' => ['use-bs-accordion', 'accordion'],
                'usePath' => 'script',
            ],
            'bs-alert' => [
                'classes' => ['use-bs-alert', 'alert'],
                'usePath' => 'script',
            ],
            'bs-align-content' => [
                'classes' => array_merge(
                    ['use-bs-align-content'],
                    array_map(fn($ac) => "align-content-{$ac}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'stretch'
                    ])
                ),
                'usePath' => false,
            ],
            'bs-align-items' => [
                'classes' => array_merge(
                    ['use-bs-align-items'],
                    array_map(fn($ai) => "align-items-{$ai}", [
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => false,
            ],
            'bs-align-self' => [
                'classes' => array_merge(
                    ['use-bs-align-self'],
                    array_map(fn($as) => "align-self-{$as}", [
                        'auto',
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => false,
            ],
            'bs-align' => [
                'classes' => array_merge(
                    ['use-bs-align'],
                    array_merge(
                        array_map(fn($align) => "align-{$align}", ['baseline', 'top', 'middle', 'bottom', 'text-bottom', 'text-top']),
                        array_map(fn($float) => "float-{$float}", ['start', 'end', 'none'])
                    )
                ),
                'usePath' => false,
            ],
            'bs-border-radius' => [
                'classes' => array_merge(
                    ['use-bs-border-radius'],
                    array_map(fn($size) => "rounded-{$size}", [0, 1, 2, 3, 4, 5, 'circle', 'pill']),
                    // Top, End, Bottom, Start rounded variations
                    array_map(fn($position) => "rounded-{$position}", ['top', 'end', 'bottom', 'start']),
                    array_map(fn($position) => "rounded-{$position}-0", ['top', 'end', 'bottom', 'start'])
                ),
                'usePath' => false,
            ],
            'bs-border' => [
                'classes' => array_merge(
                    ['use-bs-border'],
                    // Base border classes
                    array_map(fn($size) => "border-{$size}", [0, 1, 2, 3, 4, 5]),

                    // Border positions: top, end, bottom, start
                    array_map(fn($position) => "border-{$position}", ['top', 'end', 'bottom', 'start']),
                    array_map(fn($position) => "border-{$position}-0", ['top', 'end', 'bottom', 'start']),

                    // Border opacity classes
                    array_map(fn($opacity) => "border-opacity-{$opacity}", [10, 25, 50, 75, 100])
                ),
                'usePath' => false,
            ],
            'bs-bottom' => [
                'classes' => array_merge(
                    ['use-bs-bottom'],
                    array_map(fn($value) => "bottom-{$value}", ['0', '50', '100'])
                ),
                'usePath' => false
            ],
            'bs-breadcrumb' => [
                'classes' => ['use-bs-breadcrumb', 'breadcrumb'],
                'usePath' => 'script',
            ],
            'bs-button-group' => [
                'classes' => array_merge(
                    ['use-bs-button-group'],
                    // Base button group classes
                    ['btn-group', 'btn-group-vertical', 'btn-check', 'btn-toolbar'],

                    // Size variations for button groups
                    array_map(fn($size) => "btn-group-{$size}", ['lg', 'sm'])
                ),
                'usePath' => false,
            ],
            'bs-buttons' => [
                'classes' => array_merge(
                    ['use-bs-buttons'],
                    // Base button classes
                    ['button', 'btn', 'btn-link', 'btn-check', 'btn-toolbar'],

                    // Size variations for buttons
                    array_map(fn($size) => "btn-{$size}", ['lg', 'sm']),

                    // Button group classes
                    ['btn-group', 'btn-group-vertical'],

                    // Size variations for button groups
                    array_map(fn($size) => "btn-group-{$size}", ['lg', 'sm'])
                ),
                'usePath' => 'script',
            ],
            'bs-card' => [
                'classes' => ['use-bs-card', 'card'],
                'usePath' => false,
            ],
            'bs-carousel' => [
                'classes' => ['use-bs-carousel', 'carousel'],
                'usePath' => 'script',
            ],
            'bs-container' => [
                'classes' => array_merge(
                    ['use-bs-container', 'use-container', 'container-fluid'],

                    // Size variations for containers
                    array_map(fn($size) => "container-{$size}", ['xxl', 'xl', 'lg', 'md', 'sm'])
                ),
                'usePath' => false,
            ],
            'bs-display' => [
                'classes' => array_merge(
                    ['use-bs-display'],
                    // General display classes
                    array_map(fn($display) => "d-{$display}", ['inline', 'inline-block', 'block', 'grid', 'inline-grid', 'table', 'table-row', 'table-cell', 'flex', 'inline-flex'])
                ),
                'usePath' => false
            ],
            'bs-dropdown' => [
                'classes' => array_merge(
                    ['use-bs-dropdown'],
                    [
                        'dropup',
                        'dropend',
                        'dropdown',
                        'dropstart',
                        'dropdown-toggle',
                        'dropdown-menu',
                    ]
                ),
                'usePath' => false,
            ],
            'bs-end' => [
                'classes' => array_merge(
                    ['use-bs-end'],
                    array_map(fn($value) => "end-{$value}", ['0', '50', '100'])
                ),
                'usePath' => false
            ],
            'bs-flex' => [
                'classes' => array_merge(
                    ['use-bs-flex'],
                    ['flex-fill'],
                    array_map(fn($dir) => "flex-{$dir}", ['row', 'column', 'row-reverse', 'column-reverse']),
                    array_map(fn($grow) => "flex-grow-{$grow}", [0, 1]),
                    array_map(fn($shrink) => "flex-shrink-{$shrink}", [0, 1]),
                    array_map(fn($wrap) => "flex-{$wrap}", ['wrap', 'nowrap', 'wrap-reverse'])
                ),
                'usePath' => false,
            ],
            'bs-floating-labels' => [
                'classes' => [
                    'use-bs-floating-labels',
                    'use-form-floating',
                    'form-floating'
                ],
                'usePath' => false,
            ],
            'bs-focus-ring' => [
                'classes' => [
                    'use-bs-focus-ring',
                    'focus-ring',
                ],
                'usePath' => false,
            ],
            'bs-form-check' => [
                'classes' => [
                    'use-bs-form-check',
                    'use-form-check',
                    'form-check',
                    'form-switch',
                    'btn-check',
                    'wp-comment-cookies-consent',
                ],
                'usePath' => false,
            ],
            'bs-form-control' => [
                'classes' => [
                    'use-bs-form-control',
                    'use-form-control',
                    'form-control',
                    'form-control-plaintext',
                ],
                'usePath' => false,
            ],
            'bs-form-range' => [
                'classes' => [
                    'use-bs-form-range',
                    'form-range',
                ],
                'usePath' => false,
            ],
            'bs-form-select' => [
                'classes' => [
                    'use-bs-form-select',
                    'use-form-select',
                    'form-select',
                ],
                'usePath' => false,
            ],
            'bs-gap' => [
                'classes' => array_merge(
                    ['use-bs-gap'],
                    array_map(fn($gap) => "gap-{$gap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($rowGap) => "row-gap-{$rowGap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($colGap) => "column-gap-{$colGap}", [0, 1, 2, 3, 4, 5])
                ),
                'usePath' => false,
            ],
            'bs-grid' => [
                'classes' => array_merge(
                    ['use-bs-grid'],
                    ['row', 'col', 'col-auto', 'row-cols-auto'],
                    array_map(fn($cols) => "row-cols-{$cols}", range(1, 6)),
                    array_map(fn($col) => "col-{$col}", range(1, 12)),
                    array_map(fn($offset) => "offset-{$offset}", range(1, 11)),
                    array_map(fn($g) => "g-{$g}", range(0, 5)),
                    array_map(fn($gx) => "gx-{$gx}", range(0, 5)),
                    array_map(fn($gy) => "gy-{$gy}", range(0, 5))
                ),
                'usePath' => false,
            ],
            'bs-height' => [
                'classes' => array_merge(
                    ['use-bs-height'],
                    array_map(fn($height) => "h-{$height}", [25, 50, 75, 100]),
                    ['h-auto', 'mh-100', 'vh-100', 'min-vh-100']
                ),
                'usePath' => false,
            ],
            'bs-input-group' => [
                'classes' => [
                    'use-bs-input-group',
                    'use-input-group',
                    'input-group',
                    'button-inside',
                ],
                'usePath' => false,
            ],
            'bs-justify-content' => [
                'classes' => array_merge(
                    ['use-bs-justify-content'],
                    array_map(fn($jc) => "justify-content-{$jc}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'evenly'
                    ])
                ),
                'usePath' => false,
            ],
            'bs-label' => [
                'classes' => [
                    'use-bs-label',
                    'use-form-label',
                    'form-label',
                    'col-form-label',
                    'col-form-label-lg',
                    'col-form-label-sm',
                ],
                'usePath' => false,
            ],
            'bs-list-group' => [
                'classes' => [
                    'use-bs-list-group',
                    'list-group',
                    'list-group-horizontal',
                ],
                'usePath' => 'script',
            ],
            'bs-margin' => [
                'classes' => array_merge(
                    ['use-bs-margin'],
                    // General margin class
                    array_map(fn($level) => "m-{$level}", range(0, 5)),

                    // Horizontal (X-axis)
                    array_map(fn($level) => "mx-{$level}", range(0, 5)),

                    // Vertical (Y-axis)
                    array_map(fn($level) => "my-{$level}", range(0, 5)),

                    // Top margin
                    array_map(fn($level) => "mt-{$level}", range(0, 5)),

                    // End margin
                    array_map(fn($level) => "me-{$level}", range(0, 5)),

                    // Bottom margin
                    array_map(fn($level) => "mb-{$level}", range(0, 5)),

                    // Start margin
                    array_map(fn($level) => "ms-{$level}", range(0, 5))
                ),
                'usePath' => false,
            ],
            'bs-modal' => [
                'classes' => [
                    'use-bs-modal',
                    'modal',
                    'search-modal-trigger',
                ],
                'usePath' => 'script',
            ],
            'bs-nav' => [
                'classes' => [
                    'use-bs-nav',
                    'nav',
                ],
                'usePath' => false,
            ],
            'bs-navbar' => [
                'classes' => [
                    'use-bs-navbar',
                    'navbar',
                ],
                'usePath' => 'script',
            ],
            'bs-object-fit' => [
                'classes' => array_merge(
                    ['use-bs-object-fit'],
                    array_map(fn($fit) => "object-fit-{$fit}", ['contain', 'cover', 'fill', 'scale', 'none'])
                ),
                'usePath' => false,
            ],
            'bs-offcanvas' => [
                'classes' => [
                    'use-bs-offcanvas',
                    'offcanvas',
                ],
                'usePath' => 'script',
            ],
            'bs-opacity' => [
                'classes' => array_merge(
                    ['use-bs-opacity'],
                    array_map(fn($level) => "opacity-{$level}", [0, 25, 50, 75, 100])
                ),
                'usePath' => false,
            ],
            'bs-order' => [
                'classes' => array_merge(
                    ['use-bs-order'],
                    array_map(fn($order) => "order-{$order}", ['first', 0, 1, 2, 3, 4, 5, 'last'])
                ),
                'usePath' => false,
            ],
            'bs-overflow' => [
                'classes' => array_merge(
                    ['use-bs-overflow'],
                    // General overflow classes
                    array_map(fn($suffix) => "overflow-{$suffix}", ['auto', 'hidden', 'visible', 'scroll']),

                    // Horizontal overflow classes
                    array_map(fn($suffix) => "overflow-x-{$suffix}", ['auto', 'hidden', 'visible', 'scroll']),

                    // Vertical overflow classes
                    array_map(fn($suffix) => "overflow-y-{$suffix}", ['auto', 'hidden', 'visible', 'scroll'])
                ),
                'usePath' => false,
            ],
            'bs-padding' => [
                'classes' => array_merge(
                    ['use-bs-padding'],
                    // Padding on all sides (p)
                    array_map(fn($level) => "p-{$level}", range(0, 5)),  // p-0 to p-5

                    // Horizontal padding (px)
                    array_map(fn($level) => "px-{$level}", range(0, 5)),  // px-0 to px-5

                    // Vertical padding (py)
                    array_map(fn($level) => "py-{$level}", range(0, 5)),  // py-0 to py-5

                    // Padding top (pt)
                    array_map(fn($level) => "pt-{$level}", range(0, 5)),  // pt-0 to pt-5

                    // Padding end (pe) - right in LTR and left in RTL
                    array_map(fn($level) => "pe-{$level}", range(0, 5)),  // pe-0 to pe-5

                    // Padding bottom (pb)
                    array_map(fn($level) => "pb-{$level}", range(0, 5)),  // pb-0 to pb-5

                    // Padding start (ps) - left in LTR and right in RTL
                    array_map(fn($level) => "ps-{$level}", range(0, 5))  // ps-0 to ps-5
                ),
                'usePath' => false,
            ],
            'bs-pagination' => [
                'classes' => [
                    'use-bs-pagination',
                    'pagination',
                ],
                'usePath' => false,
            ],
            'bs-placeholder' => [
                'classes' => [
                    'use-bs-placeholder',
                    'use-placeholder',
                ],
                'usePath' => false,
            ],
            'bs-popover' => [
                'classes' => [
                    'use-bs-popover',
                    'popover',
                ],
                'usePath' => 'script',
            ],
            'bs-position' => [
                'classes' => array_merge(
                    ['use-bs-position'],
                    array_map(fn($position) => "position-{$position}", ['static', 'relative', 'absolute', 'fixed', 'sticky'])
                ),
                'usePath' => false,
            ],
            'bs-print' => [
                'classes' => array_merge(
                    ['use-bs-print'],
                    // Print display classes
                    array_map(fn($display) => "d-print-{$display}", [
                        'inline',
                        'inline-block',
                        'block',
                        'grid',
                        'inline-grid',
                        'table',
                        'table-row',
                        'table-cell',
                        'flex',
                        'inline-flex',
                        'none'
                    ])
                ),
                'usePath' => false,
            ],
            'bs-progress' => [
                'classes' => [
                    'use-bs-progress',
                    'progress',
                    'progress-stacked',
                ],
                'usePath' => false,
            ],
            'bs-spinners' => [
                'classes' => [
                    'use-bs-spinners',
                    'spinner-grow',
                    'spinner-border',
                ],
                'usePath' => false,
            ],
            'bs-ratio' => [
                'classes' => array_merge(
                    ['use-bs-ratio'],
                    array_map(fn($ratio) => "ratio-{$ratio}", ['1x1', '4x3', '16x9', '21x9'])
                ),
                'usePath' => false,
            ],
            'bs-shadow' => [
                'classes' => [
                    'use-bs-shadow',
                    'shadow-lg',
                    'shadow-sm',
                    'shadow-inset',
                ],
                'usePath' => false,
            ],
            'bs-start' => [
                'classes' => array_merge(
                    ['use-bs-start'],
                    array_map(fn($value) => "start-{$value}", ['0', '50', '100'])
                ),
                'usePath' => false,
            ],
            'bs-sticky' => [
                'classes' => [
                    'use-bs-sticky',
                    'sticky-top',
                    'sticky-bottom',
                ],
                'usePath' => false,
            ],
            'bs-tables' => [
                'classes' => [
                    'use-bs-tables',
                    'table',
                ],
                'usePath' => 'script',
            ],
            'bs-text' => [
                'classes' => array_merge(
                    ['use-bs-text'],
                    array_map(fn($value) => "text-{$value}", ['start', 'end', 'center', 'lowercase', 'uppercase', 'capitalize', 'wrap', 'nowrap', 'break', 'truncate'])
                ),
                'usePath' => false,
            ],
            'bs-toast' => [
                'classes' => [
                    'use-bs-toast',
                    'toast',
                ],
                'usePath' => 'script',
            ],
            'bs-tooltip' => [
                'classes' => [
                    'use-bs-tooltip',
                    'use-tooltip',
                    'tooltip',
                ],
                'usePath' => 'script',
            ],
            'bs-top' => [
                'classes' => array_merge(
                    ['use-bs-top'],
                    array_map(fn($value) => "top-{$value}", ['0', '50', '100'])
                ),
                'usePath' => false,
            ],
            'bs-translate' => [
                'classes' => array_merge(
                    ['use-bs-translate'],
                    array_map(fn($axis) => "translate-middle{$axis}", ['', '-x', '-y'])
                ),
                'usePath' => false,
            ],
            'bs-validation' => [
                'classes' => [
                    'use-bs-validation',
                    'use-validation',
                    'valid-feedback',
                    'valid-tooltip',
                    'was-validated',
                    'is-valid',
                    'invalid-feedback',
                    'invalid-tooltip',
                    'is-invalid',
                ],
                'usePath' => false,
            ],
            'bs-user-select' => [
                'classes' => array_merge(
                    ['use-bs-user-select'],
                    array_map(fn($value) => "user-select-{$value}", ['all', 'auto', 'none'])
                ),
                'usePath' => false,
            ],
            'bs-width' => [
                'classes' => array_merge(
                    ['use-bs-width'],
                    array_map(fn($width) => "w-{$width}", [25, 33, 50, 66, 75, 100]),
                    ['w-auto', 'mw-100', 'vw-100', 'min-vw-100']
                ),
                'usePath' => false,
            ],
            'bs-z-index' => [
                'classes' => array_merge(
                    ['use-bs-z-index'],
                    array_map(fn($z) => "z-{$z}", ['n1', 0, 1, 2, 3])
                ),
                'usePath' => false,
            ],
            // Responsive classes
            'bs-align-lg' => [
                'classes' => array_merge(
                    ['use-bs-align-lg'],

                    array_map(fn($float) => "float-lg-{$float}", ['start', 'end', 'none'])

                ),
                'usePath' => 'lg',
            ],
            'bs-align-md' => [
                'classes' => array_merge(
                    ['use-bs-align-md'],

                    array_map(fn($float) => "float-md-{$float}", ['start', 'end', 'none'])

                ),
                'usePath' => 'md',
            ],
            'bs-align-sm' => [
                'classes' => array_merge(
                    ['use-bs-align-sm'],

                    array_map(fn($float) => "float-sm-{$float}", ['start', 'end', 'none'])

                ),
                'usePath' => 'sm',
            ],
            'bs-align-xl' => [
                'classes' => array_merge(
                    ['use-bs-align-xl'],

                    array_map(fn($float) => "float-xl-{$float}", ['start', 'end', 'none'])

                ),
                'usePath' => 'xl',
            ],
            'bs-align-xxl' => [
                'classes' => array_merge(
                    ['use-bs-align-xxl'],

                    array_map(fn($float) => "float-xxl-{$float}", ['start', 'end', 'none'])

                ),
                'usePath' => 'xxl',
            ],
            'bs-align-content-lg' => [
                'classes' => array_merge(
                    ['use-bs-align-content-lg'],
                    array_map(fn($ac) => "align-content-lg-{$ac}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'stretch'
                    ])
                ),
                'usePath' => 'lg',
            ],
            'bs-align-content-md' => [
                'classes' => array_merge(
                    ['use-bs-align-content-md'],
                    array_map(fn($ac) => "align-content-md-{$ac}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'stretch'
                    ])
                ),
                'usePath' => 'md',
            ],
            'bs-align-content-sm' => [
                'classes' => array_merge(
                    ['use-bs-align-content-sm'],
                    array_map(fn($ac) => "align-content-sm-{$ac}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'stretch'
                    ])
                ),
                'usePath' => 'sm',
            ],
            'bs-align-content-xl' => [
                'classes' => array_merge(
                    ['use-bs-align-content-xl'],
                    array_map(fn($ac) => "align-content-xl-{$ac}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'stretch'
                    ])
                ),
                'usePath' => 'xl',
            ],
            'bs-align-content-xxl' => [
                'classes' => array_merge(
                    ['use-bs-align-content-xxl'],
                    array_map(fn($ac) => "align-content-xxl-{$ac}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'stretch'
                    ])
                ),
                'usePath' => 'xxl',
            ],
            'bs-align-items-lg' => [
                'classes' => array_merge(
                    ['use-bs-align-items-lg'],
                    array_map(fn($ai) => "align-items-lg-{$ai}", [
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => 'lg',
            ],
            'bs-align-items-md' => [
                'classes' => array_merge(
                    ['use-bs-align-items-md'],
                    array_map(fn($ai) => "align-items-md-{$ai}", [
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => 'md',
            ],
            'bs-align-items-sm' => [
                'classes' => array_merge(
                    ['use-bs-align-items-sm'],
                    array_map(fn($ai) => "align-items-sm-{$ai}", [
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => 'sm',
            ],
            'bs-align-items-xl' => [
                'classes' => array_merge(
                    ['use-bs-align-items-xl'],
                    array_map(fn($ai) => "align-items-xl-{$ai}", [
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => 'xl',
            ],
            'bs-align-items-xxl' => [
                'classes' => array_merge(
                    ['use-bs-align-items-xxl'],
                    array_map(fn($ai) => "align-items-xxl-{$ai}", [
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => 'xxl',
            ],
            'bs-align-self-sm' => [
                'classes' => array_merge(
                    ['use-bs-align-self-sm'],
                    array_map(fn($as) => "align-self-sm-{$as}", [
                        'auto',
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => 'sm',
            ],
            'bs-align-self-md' => [
                'classes' => array_merge(
                    ['use-bs-align-self-md'],
                    array_map(fn($as) => "align-self-md-{$as}", [
                        'auto',
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => 'md',
            ],
            'bs-align-self-lg' => [
                'classes' => array_merge(
                    ['use-bs-align-self-lg'],
                    array_map(fn($as) => "align-self-lg-{$as}", [
                        'auto',
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => 'lg',
            ],
            'bs-align-self-xl' => [
                'classes' => array_merge(
                    ['use-bs-align-self-xl'],
                    array_map(fn($as) => "align-self-xl-{$as}", [
                        'auto',
                        'start',
                        'end',
                        'center',
                        'baseline',
                        'stretch'
                    ])
                ),
                'usePath' => 'xl',
            ],
            'bs-display-lg' => [
                'classes' => array_merge(
                    ['use-bs-display-lg'],
                    array_map(fn($display) => "d-lg-{$display}", ['inline', 'inline-block', 'block', 'grid', 'inline-grid', 'table', 'table-row', 'table-cell', 'flex', 'inline-flex'])
                ),
                'usePath' => 'lg',
            ],
            'bs-display-md' => [
                'classes' => array_merge(
                    ['use-bs-display-md'],
                    array_map(fn($display) => "d-md-{$display}", ['inline', 'inline-block', 'block', 'grid', 'inline-grid', 'table', 'table-row', 'table-cell', 'flex', 'inline-flex'])
                ),
                'usePath' => 'md',
            ],
            'bs-display-sm' => [
                'classes' => array_merge(
                    ['use-bs-display-sm'],
                    array_map(fn($display) => "d-sm-{$display}", ['inline', 'inline-block', 'block', 'grid', 'inline-grid', 'table', 'table-row', 'table-cell', 'flex', 'inline-flex'])
                ),
                'usePath' => 'sm',
            ],
            'bs-display-xl' => [
                'classes' => array_merge(
                    ['use-bs-display-xl'],
                    array_map(fn($display) => "d-xl-{$display}", ['inline', 'inline-block', 'block', 'grid', 'inline-grid', 'table', 'table-row', 'table-cell', 'flex', 'inline-flex'])
                ),
                'usePath' => 'xl',
            ],
            'bs-display-xxl' => [
                'classes' => array_merge(
                    ['use-bs-display-xxl'],
                    array_map(fn($display) => "d-xxl-{$display}", ['inline', 'inline-block', 'block', 'grid', 'inline-grid', 'table', 'table-row', 'table-cell', 'flex', 'inline-flex'])
                ),
                'usePath' => 'xxl',
            ],
            'bs-dropdown-lg' => [
                'classes' => array_merge(
                    ['use-bs-dropdown-lg'],
                    [
                        'dropdown-menu-lg-start',
                        'dropdown-menu-lg-end',
                    ]
                ),
                'usePath' => 'lg',
            ],
            'bs-dropdown-md' => [
                'classes' => array_merge(
                    ['use-bs-dropdown-md'],
                    [
                        'dropdown-menu-md-start',
                        'dropdown-menu-md-end',
                    ]
                ),
                'usePath' => 'md',
            ],
            'bs-dropdown-sm' => [
                'classes' => array_merge(
                    ['use-bs-dropdown-sm'],
                    [
                        'dropdown-menu-sm-start',
                        'dropdown-menu-sm-end',
                    ]
                ),
                'usePath' => 'sm',
            ],
            'bs-dropdown-xl' => [
                'classes' => array_merge(
                    ['use-bs-dropdown-xl'],
                    [
                        'dropdown-menu-xl-start',
                        'dropdown-menu-xl-end',
                    ]
                ),
                'usePath' => 'xl',
            ],
            'bs-dropdown-xxl' => [
                'classes' => array_merge(
                    ['use-bs-dropdown-xxl'],
                    [
                        'dropdown-menu-xxl-start',
                        'dropdown-menu-xxl-end',
                    ]
                ),
                'usePath' => 'xxl',
            ],
            'bs-flex-lg' => [
                'classes' => array_merge(
                    ['use-bs-flex-lg'],
                    ['flex-fill'],
                    array_map(fn($dir) => "flex-lg-{$dir}", ['row', 'column', 'row-reverse', 'column-reverse']),
                    array_map(fn($grow) => "flex-grow-lg-{$grow}", [0, 1]),
                    array_map(fn($shrink) => "flex-shrink-lg-{$shrink}", [0, 1]),
                    array_map(fn($wrap) => "flex-lg-{$wrap}", ['wrap', 'nowrap', 'wrap-reverse'])
                ),
                'usePath' => 'lg',
            ],
            'bs-flex-md' => [
                'classes' => array_merge(
                    ['use-bs-flex-md'],
                    ['flex-fill'],
                    array_map(fn($dir) => "flex-md-{$dir}", ['row', 'column', 'row-reverse', 'column-reverse']),
                    array_map(fn($grow) => "flex-grow-md-{$grow}", [0, 1]),
                    array_map(fn($shrink) => "flex-shrink-md-{$shrink}", [0, 1]),
                    array_map(fn($wrap) => "flex-md-{$wrap}", ['wrap', 'nowrap', 'wrap-reverse'])
                ),
                'usePath' => 'md',
            ],
            'bs-flex-sm' => [
                'classes' => array_merge(
                    ['use-bs-flex-sm'],
                    ['flex-fill'],
                    array_map(fn($dir) => "flex-sm-{$dir}", ['row', 'column', 'row-reverse', 'column-reverse']),
                    array_map(fn($grow) => "flex-grow-sm-{$grow}", [0, 1]),
                    array_map(fn($shrink) => "flex-shrink-sm-{$shrink}", [0, 1]),
                    array_map(fn($wrap) => "flex-sm-{$wrap}", ['wrap', 'nowrap', 'wrap-reverse'])
                ),
                'usePath' => 'sm',
            ],
            'bs-flex-xl' => [
                'classes' => array_merge(
                    ['use-bs-flex-xl'],
                    ['flex-fill'],
                    array_map(fn($dir) => "flex-xl-{$dir}", ['row', 'column', 'row-reverse', 'column-reverse']),
                    array_map(fn($grow) => "flex-grow-xl-{$grow}", [0, 1]),
                    array_map(fn($shrink) => "flex-shrink-xl-{$shrink}", [0, 1]),
                    array_map(fn($wrap) => "flex-xl-{$wrap}", ['wrap', 'nowrap', 'wrap-reverse'])
                ),
                'usePath' => 'xl',
            ],
            'bs-flex-xxl' => [
                'classes' => array_merge(
                    ['use-bs-flex-xxl'],
                    ['flex-fill'],
                    array_map(fn($dir) => "flex-xxl-{$dir}", ['row', 'column', 'row-reverse', 'column-reverse']),
                    array_map(fn($grow) => "flex-grow-xxl-{$grow}", [0, 1]),
                    array_map(fn($shrink) => "flex-shrink-xxl-{$shrink}", [0, 1]),
                    array_map(fn($wrap) => "flex-xxl-{$wrap}", ['wrap', 'nowrap', 'wrap-reverse'])
                ),
                'usePath' => 'xxl',
            ],
            'bs-gap-lg' => [
                'classes' => array_merge(
                    ['use-bs-gap-lg'],
                    array_map(fn($gap) => "gap-lg-{$gap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($rowGap) => "row-gap-lg-{$rowGap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($colGap) => "column-gap-lg-{$colGap}", [0, 1, 2, 3, 4, 5])
                ),
                'usePath' => 'lg',
            ],
            'bs-gap-md' => [
                'classes' => array_merge(
                    ['use-bs-gap-md'],
                    array_map(fn($gap) => "gap-md-{$gap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($rowGap) => "row-gap-md-{$rowGap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($colGap) => "column-gap-md-{$colGap}", [0, 1, 2, 3, 4, 5])
                ),
                'usePath' => 'md',
            ],
            'bs-gap-sm' => [
                'classes' => array_merge(
                    ['use-bs-gap-sm'],
                    array_map(fn($gap) => "gap-sm-{$gap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($rowGap) => "row-gap-sm-{$rowGap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($colGap) => "column-gap-sm-{$colGap}", [0, 1, 2, 3, 4, 5])
                ),
                'usePath' => 'sm',
            ],
            'bs-gap-xl' => [
                'classes' => array_merge(
                    ['use-bs-gap-xl'],
                    array_map(fn($gap) => "gap-xl-{$gap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($rowGap) => "row-gap-xl-{$rowGap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($colGap) => "column-gap-xl-{$colGap}", [0, 1, 2, 3, 4, 5])
                ),
                'usePath' => 'xl',
            ],
            'bs-gap-xxl' => [
                'classes' => array_merge(
                    ['use-bs-gap-xxl'],
                    array_map(fn($gap) => "gap-xxl-{$gap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($rowGap) => "row-gap-xxl-{$rowGap}", [0, 1, 2, 3, 4, 5]),
                    array_map(fn($colGap) => "column-gap-xxl-{$colGap}", [0, 1, 2, 3, 4, 5])
                ),
                'usePath' => 'xxl',
            ],
            'bs-grid-lg' => [
                'classes' => array_merge(
                    ['use-bs-grid-lg'],
                    ['col-lg', 'col-lg-auto', 'row-cols-lg-auto'],
                    array_map(fn($cols) => "row-cols-lg-{$cols}", range(1, 6)),
                    array_map(fn($col) => "col-lg-{$col}", range(1, 12)),
                    array_map(fn($offset) => "offset-lg-{$offset}", range(1, 11)),
                    array_map(fn($g) => "g-lg-{$g}", range(0, 5)),
                    array_map(fn($gx) => "gx-lg-{$gx}", range(0, 5)),
                    array_map(fn($gy) => "gy-lg-{$gy}", range(0, 5))
                ),
                'usePath' => 'lg',
            ],
            'bs-grid-md' => [
                'classes' => array_merge(
                    ['use-bs-grid-md'],
                    ['col-md', 'col-md-auto', 'row-cols-md-auto'],
                    array_map(fn($cols) => "row-cols-md-{$cols}", range(1, 6)),
                    array_map(fn($col) => "col-md-{$col}", range(1, 12)),
                    array_map(fn($offset) => "offset-md-{$offset}", range(1, 11)),
                    array_map(fn($g) => "g-md-{$g}", range(0, 5)),
                    array_map(fn($gx) => "gx-md-{$gx}", range(0, 5)),
                    array_map(fn($gy) => "gy-md-{$gy}", range(0, 5))
                ),
                'usePath' => 'md',
            ],
            'bs-grid-sm' => [
                'classes' => array_merge(
                    ['use-bs-grid-sm'],
                    ['col-sm', 'col-sm-auto', 'row-cols-sm-auto'],
                    array_map(fn($cols) => "row-cols-sm-{$cols}", range(1, 6)),
                    array_map(fn($col) => "col-sm-{$col}", range(1, 12)),
                    array_map(fn($offset) => "offset-sm-{$offset}", range(1, 11)),
                    array_map(fn($g) => "g-sm-{$g}", range(0, 5)),
                    array_map(fn($gx) => "gx-sm-{$gx}", range(0, 5)),
                    array_map(fn($gy) => "gy-sm-{$gy}", range(0, 5))
                ),
                'usePath' => 'sm',
            ],
            'bs-grid-xl' => [
                'classes' => array_merge(
                    ['use-bs-grid-xl'],
                    ['col-xl', 'col-xl-auto', 'row-cols-xl-auto'],
                    array_map(fn($cols) => "row-cols-xl-{$cols}", range(1, 6)),
                    array_map(fn($col) => "col-xl-{$col}", range(1, 12)),
                    array_map(fn($offset) => "offset-xl-{$offset}", range(1, 11)),
                    array_map(fn($g) => "g-xl-{$g}", range(0, 5)),
                    array_map(fn($gx) => "gx-xl-{$gx}", range(0, 5)),
                    array_map(fn($gy) => "gy-xl-{$gy}", range(0, 5))
                ),
                'usePath' => 'xl',
            ],
            'bs-grid-xxl' => [
                'classes' => array_merge(
                    ['use-bs-grid-xxl'],
                    ['col-xxl', 'col-xxl-auto', 'row-cols-xxl-auto'],
                    array_map(fn($cols) => "row-cols-xxl-{$cols}", range(1, 6)),
                    array_map(fn($col) => "col-xxl-{$col}", range(1, 12)),
                    array_map(fn($offset) => "offset-xxl-{$offset}", range(1, 11)),
                    array_map(fn($g) => "g-xxl-{$g}", range(0, 5)),
                    array_map(fn($gx) => "gx-xxl-{$gx}", range(0, 5)),
                    array_map(fn($gy) => "gy-xxl-{$gy}", range(0, 5))
                ),
                'usePath' => 'xxl',
            ],
            'bs-justify-content-lg' => [
                'classes' => array_merge(
                    ['use-bs-justify-content-lg'],
                    array_map(fn($jc) => "justify-content-lg-{$jc}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'evenly'
                    ])
                ),
                'usePath' => 'lg',
            ],
            'bs-justify-content-md' => [
                'classes' => array_merge(
                    ['use-bs-justify-content-md'],
                    array_map(fn($jc) => "justify-content-md-{$jc}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'evenly'
                    ])
                ),
                'usePath' => 'md',
            ],
            'bs-justify-content-sm' => [
                'classes' => array_merge(
                    ['use-bs-justify-content-sm'],
                    array_map(fn($jc) => "justify-content-sm-{$jc}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'evenly'
                    ])
                ),
                'usePath' => 'sm',
            ],
            'bs-justify-content-xl' => [
                'classes' => array_merge(
                    ['use-bs-justify-content-xl'],
                    array_map(fn($jc) => "justify-content-xl-{$jc}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'evenly'
                    ])
                ),
                'usePath' => 'xl',
            ],
            'bs-justify-content-xxl' => [
                'classes' => array_merge(
                    ['use-bs-justify-content-xxl'],
                    array_map(fn($jc) => "justify-content-xxl-{$jc}", [
                        'start',
                        'end',
                        'center',
                        'between',
                        'around',
                        'evenly'
                    ])
                ),
                'usePath' => 'xxl',
            ],
            'bs-list-group-lg' => [
                'classes' => [
                    'use-bs-list-group-lg',
                    'list-group-lg',
                    'list-group-horizontal-lg',
                ],
                'usePath' => 'lg',
            ],
            'bs-list-group-md' => [
                'classes' => [
                    'use-bs-list-group-md',
                    'list-group-md',
                    'list-group-horizontal-md',
                ],
                'usePath' => 'md',
            ],
            'bs-list-group-sm' => [
                'classes' => [
                    'use-bs-list-group-sm',
                    'list-group-sm',
                    'list-group-horizontal-sm',
                ],
                'usePath' => 'sm',
            ],
            'bs-list-group-xl' => [
                'classes' => [
                    'use-bs-list-group-xl',
                    'list-group-xl',
                    'list-group-horizontal-xl',
                ],
                'usePath' => 'xl',
            ],
            'bs-list-group-xxl' => [
                'classes' => [
                    'use-bs-list-group-xxl',
                    'list-group-xxl',
                    'list-group-horizontal-xxl',
                ],
                'usePath' => 'xxl',
            ],
            'bs-margin-lg' => [
                'classes' => array_merge(
                    ['use-bs-margin-lg'],
                    // General margin class
                    array_map(fn($level) => "m-lg-{$level}", range(1, 5)),

                    // Horizontal (X-axis)
                    array_map(fn($level) => "mx-lg-{$level}", range(1, 5)),

                    // Vertical (Y-axis)
                    array_map(fn($level) => "my-lg-{$level}", range(1, 5)),

                    // Top margin
                    array_map(fn($level) => "mt-lg-{$level}", range(1, 5)),

                    // End margin
                    array_map(fn($level) => "me-lg-{$level}", range(1, 5)),

                    // Bottom margin
                    array_map(fn($level) => "mb-lg-{$level}", range(1, 5)),

                    // Start margin
                    array_map(fn($level) => "ms-lg-{$level}", range(1, 5))
                ),
                'usePath' => 'lg',
            ],
            'bs-margin-md' => [
                'classes' => array_merge(
                    ['use-bs-margin-md'],
                    // General margin class
                    array_map(fn($level) => "m-md-{$level}", range(1, 5)),

                    // Horizontal (X-axis)
                    array_map(fn($level) => "mx-md-{$level}", range(1, 5)),

                    // Vertical (Y-axis)
                    array_map(fn($level) => "my-md-{$level}", range(1, 5)),

                    // Top margin
                    array_map(fn($level) => "mt-md-{$level}", range(1, 5)),

                    // End margin
                    array_map(fn($level) => "me-md-{$level}", range(1, 5)),

                    // Bottom margin
                    array_map(fn($level) => "mb-md-{$level}", range(1, 5)),

                    // Start margin
                    array_map(fn($level) => "ms-md-{$level}", range(1, 5))
                ),
                'usePath' => 'md',
            ],
            'bs-margin-sm' => [
                'classes' => array_merge(
                    ['use-bs-margin-sm'],
                    // General margin class
                    array_map(fn($level) => "m-sm-{$level}", range(1, 5)),

                    // Horizontal (X-axis)
                    array_map(fn($level) => "mx-sm-{$level}", range(1, 5)),

                    // Vertical (Y-axis)
                    array_map(fn($level) => "my-sm-{$level}", range(1, 5)),

                    // Top margin
                    array_map(fn($level) => "mt-sm-{$level}", range(1, 5)),

                    // End margin
                    array_map(fn($level) => "me-sm-{$level}", range(1, 5)),

                    // Bottom margin
                    array_map(fn($level) => "mb-sm-{$level}", range(1, 5)),

                    // Start margin
                    array_map(fn($level) => "ms-sm-{$level}", range(1, 5))
                ),
                'usePath' => 'sm',
            ],
            'bs-margin-xl' => [
                'classes' => array_merge(
                    ['use-bs-margin-xl'],
                    // General margin class
                    array_map(fn($level) => "m-xl-{$level}", range(1, 5)),

                    // Horizontal (X-axis)
                    array_map(fn($level) => "mx-xl-{$level}", range(1, 5)),

                    // Vertical (Y-axis)
                    array_map(fn($level) => "my-xl-{$level}", range(1, 5)),

                    // Top margin
                    array_map(fn($level) => "mt-xl-{$level}", range(1, 5)),

                    // End margin
                    array_map(fn($level) => "me-xl-{$level}", range(1, 5)),

                    // Bottom margin
                    array_map(fn($level) => "mb-xl-{$level}", range(1, 5)),

                    // Start margin
                    array_map(fn($level) => "ms-xl-{$level}", range(1, 5))
                ),
                'usePath' => 'xl',
            ],
            'bs-margin-xxl' => [
                'classes' => array_merge(
                    ['use-bs-margin-xxl'],
                    // General margin class
                    array_map(fn($level) => "m-xxl-{$level}", range(1, 5)),

                    // Horizontal (X-axis)
                    array_map(fn($level) => "mx-xxl-{$level}", range(1, 5)),

                    // Vertical (Y-axis)
                    array_map(fn($level) => "my-xxl-{$level}", range(1, 5)),

                    // Top margin
                    array_map(fn($level) => "mt-xxl-{$level}", range(1, 5)),

                    // End margin
                    array_map(fn($level) => "me-xxl-{$level}", range(1, 5)),

                    // Bottom margin
                    array_map(fn($level) => "mb-xxl-{$level}", range(1, 5)),

                    // Start margin
                    array_map(fn($level) => "ms-xxl-{$level}", range(1, 5))
                ),
                'usePath' => 'xxl',
            ],
            'bs-modal-lg' => [
                'classes' => [
                    'use-bs-modal-lg',
                    'modal-fullscreen-lg-down',
                ],
                'usePath' => 'lg',
            ],
            'bs-modal-md' => [
                'classes' => [
                    'use-bs-modal-md',
                    'modal-fullscreen-md-down',
                ],
                'usePath' => 'md',
            ],
            'bs-modal-sm' => [
                'classes' => [
                    'use-bs-modal-sm',
                    'modal-fullscreen-sm-down',
                ],
                'usePath' => 'sm',
            ],
            'bs-modal-xl' => [
                'classes' => [
                    'use-bs-modal-xl',
                    'modal-fullscreen-xl-down',
                ],
                'usePath' => 'xl',
            ],
            'bs-modal-xxl' => [
                'classes' => [
                    'use-bs-modal-xxl',
                    'modal-fullscreen-xxl-down',
                ],
                'usePath' => 'xxl',
            ],
            'bs-navbar-lg' => [
                'classes' => [
                    'use-bs-navbar-lg',
                    'navbar-expand-lg',
                ],
                'usePath' => 'lg',
            ],
            'bs-navbar-md' => [
                'classes' => [
                    'use-bs-navbar-md',
                    'navbar-expand-md',
                ],
                'usePath' => 'md',
            ],
            'bs-navbar-sm' => [
                'classes' => [
                    'use-bs-navbar-sm',
                    'navbar-expand-sm',
                ],
                'usePath' => 'sm',
            ],
            'bs-navbar-xl' => [
                'classes' => [
                    'use-bs-navbar-xl',
                    'navbar-expand-xl',
                ],
                'usePath' => 'xl',
            ],
            'bs-navbar-xxl' => [
                'classes' => [
                    'use-bs-navbar-xxl',
                    'navbar-expand-xxl',
                ],
                'usePath' => 'xxl',
            ],
            'bs-object-fit-lg' => [
                'classes' => array_merge(
                    ['use-bs-object-fit-lg'],
                    array_map(fn($fit) => "object-fit-lg-{$fit}", ['contain', 'cover', 'fill', 'scale', 'none'])
                ),
                'usePath' => 'lg',
            ],
            'bs-object-fit-md' => [
                'classes' => array_merge(
                    ['use-bs-object-fit-md'],
                    array_map(fn($fit) => "object-fit-md-{$fit}", ['contain', 'cover', 'fill', 'scale', 'none'])
                ),
                'usePath' => 'md',
            ],
            'bs-object-fit-sm' => [
                'classes' => array_merge(
                    ['use-bs-object-fit-sm'],
                    array_map(fn($fit) => "object-fit-sm-{$fit}", ['contain', 'cover', 'fill', 'scale', 'none'])
                ),
                'usePath' => 'sm',
            ],
            'bs-object-fit-xl' => [
                'classes' => array_merge(
                    ['use-bs-object-fit-xl'],
                    array_map(fn($fit) => "object-fit-xl-{$fit}", ['contain', 'cover', 'fill', 'scale', 'none'])
                ),
                'usePath' => 'xl',
            ],
            'bs-object-fit-xxl' => [
                'classes' => array_merge(
                    ['use-bs-object-fit-xxl'],
                    array_map(fn($fit) => "object-fit-xxl-{$fit}", ['contain', 'cover', 'fill', 'scale', 'none'])
                ),
                'usePath' => 'xxl',
            ],
            'bs-offcanvas-lg' => [
                'classes' => [
                    'use-bs-offcanvas-lg',
                    'offcanvas-lg',
                ],
                'usePath' => 'lg',
            ],
            'bs-offcanvas-md' => [
                'classes' => [
                    'use-bs-offcanvas-md',
                    'offcanvas-md',
                ],
                'usePath' => 'md',
            ],
            'bs-offcanvas-sm' => [
                'classes' => [
                    'use-bs-offcanvas-sm',
                    'offcanvas-sm',
                ],
                'usePath' => 'sm',
            ],
            'bs-offcanvas-xl' => [
                'classes' => [
                    'use-bs-offcanvas-xl',
                    'offcanvas-xl',
                ],
                'usePath' => 'xl',
            ],
            'bs-offcanvas-xxl' => [
                'classes' => [
                    'use-bs-offcanvas-xxl',
                    'offcanvas-xxl',
                ],
                'usePath' => 'xxl',
            ],
            'bs-order-lg' => [
                'classes' => array_merge(
                    ['use-bs-order-lg'],
                    array_map(fn($order) => "order-lg-{$order}", ['first', 0, 1, 2, 3, 4, 5, 'last'])
                ),
                'usePath' => 'lg',
            ],
            'bs-order-md' => [
                'classes' => array_merge(
                    ['use-bs-order-md'],
                    array_map(fn($order) => "order-md-{$order}", ['first', 0, 1, 2, 3, 4, 5, 'last'])
                ),
                'usePath' => 'md',
            ],
            'bs-order-sm' => [
                'classes' => array_merge(
                    ['use-bs-order-sm'],
                    array_map(fn($order) => "order-sm-{$order}", ['first', 0, 1, 2, 3, 4, 5, 'last'])
                ),
                'usePath' => 'sm',
            ],
            'bs-order-xl' => [
                'classes' => array_merge(
                    ['use-bs-order-xl'],
                    array_map(fn($order) => "order-xl-{$order}", ['first', 0, 1, 2, 3, 4, 5, 'last'])
                ),
                'usePath' => 'xl',
            ],
            'bs-order-xxl' => [
                'classes' => array_merge(
                    ['use-bs-order-xxl'],
                    array_map(fn($order) => "order-xxl-{$order}", ['first', 0, 1, 2, 3, 4, 5, 'last'])
                ),
                'usePath' => 'xxl',
            ],
            'bs-padding-lg' => [
                'classes' => array_merge(
                    ['use-bs-padding-lg'],
                    // Padding on all sides (p)
                    array_map(fn($level) => "p-lg-{$level}", range(1, 5)),

                    // Horizontal padding (px)
                    array_map(fn($level) => "px-lg-{$level}", range(1, 5)),

                    // Vertical padding (py)
                    array_map(fn($level) => "py-lg-{$level}", range(1, 5)),

                    // Padding top (pt)
                    array_map(fn($level) => "pt-lg-{$level}", range(1, 5)),

                    // Padding end (pe) - right in LTR and left in RTL
                    array_map(fn($level) => "pe-lg-{$level}", range(1, 5)),

                    // Padding bottom (pb)
                    array_map(fn($level) => "pb-lg-{$level}", range(1, 5)),

                    // Padding start (ps) - left in LTR and right in RTL
                    array_map(fn($level) => "ps-lg-{$level}", range(1, 5))
                ),
                'usePath' => 'lg'
            ],
            'bs-padding-md' => [
                'classes' => array_merge(
                    ['use-bs-padding-md'],
                    // Padding on all sides (p)
                    array_map(fn($level) => "p-md-{$level}", range(1, 5)),

                    // Horizontal padding (px)
                    array_map(fn($level) => "px-md-{$level}", range(1, 5)),

                    // Vertical padding (py)
                    array_map(fn($level) => "py-md-{$level}", range(1, 5)),

                    // Padding top (pt)
                    array_map(fn($level) => "pt-md-{$level}", range(1, 5)),

                    // Padding end (pe) - right in LTR and left in RTL
                    array_map(fn($level) => "pe-md-{$level}", range(1, 5)),

                    // Padding bottom (pb)
                    array_map(fn($level) => "pb-md-{$level}", range(1, 5)),

                    // Padding start (ps) - left in LTR and right in RTL
                    array_map(fn($level) => "ps-md-{$level}", range(1, 5))
                ),
                'usePath' => 'md'
            ],
            'bs-padding-sm' => [
                'classes' => array_merge(
                    ['use-bs-padding-sm'],
                    // Padding on all sides (p)
                    array_map(fn($level) => "p-sm-{$level}", range(1, 5)),

                    // Horizontal padding (px)
                    array_map(fn($level) => "px-sm-{$level}", range(1, 5)),

                    // Vertical padding (py)
                    array_map(fn($level) => "py-sm-{$level}", range(1, 5)),

                    // Padding top (pt)
                    array_map(fn($level) => "pt-sm-{$level}", range(1, 5)),

                    // Padding end (pe) - right in LTR and left in RTL
                    array_map(fn($level) => "pe-sm-{$level}", range(1, 5)),

                    // Padding bottom (pb)
                    array_map(fn($level) => "pb-sm-{$level}", range(1, 5)),

                    // Padding start (ps) - left in LTR and right in RTL
                    array_map(fn($level) => "ps-sm-{$level}", range(1, 5))
                ),
                'usePath' => 'sm'
            ],
            'bs-padding-xl' => [
                'classes' => array_merge(
                    ['use-bs-padding-xl'],
                    // Padding on all sides (p)
                    array_map(fn($level) => "p-xl-{$level}", range(1, 5)),

                    // Horizontal padding (px)
                    array_map(fn($level) => "px-xl-{$level}", range(1, 5)),

                    // Vertical padding (py)
                    array_map(fn($level) => "py-xl-{$level}", range(1, 5)),

                    // Padding top (pt)
                    array_map(fn($level) => "pt-xl-{$level}", range(1, 5)),

                    // Padding end (pe) - right in LTR and left in RTL
                    array_map(fn($level) => "pe-xl-{$level}", range(1, 5)),

                    // Padding bottom (pb)
                    array_map(fn($level) => "pb-xl-{$level}", range(1, 5)),

                    // Padding start (ps) - left in LTR and right in RTL
                    array_map(fn($level) => "ps-xl-{$level}", range(1, 5))
                ),
                'usePath' => 'xl'
            ],
            'bs-padding-xxl' => [
                'classes' => array_merge(
                    ['use-bs-padding-xxl'],
                    // Padding on all sides (p)
                    array_map(fn($level) => "p-xxl-{$level}", range(1, 5)),

                    // Horizontal padding (px)
                    array_map(fn($level) => "px-xxl-{$level}", range(1, 5)),

                    // Vertical padding (py)
                    array_map(fn($level) => "py-xxl-{$level}", range(1, 5)),

                    // Padding top (pt)
                    array_map(fn($level) => "pt-xxl-{$level}", range(1, 5)),

                    // Padding end (pe) - right in LTR and left in RTL
                    array_map(fn($level) => "pe-xxl-{$level}", range(1, 5)),

                    // Padding bottom (pb)
                    array_map(fn($level) => "pb-xxl-{$level}", range(1, 5)),

                    // Padding start (ps) - left in LTR and right in RTL
                    array_map(fn($level) => "ps-xxl-{$level}", range(1, 5))
                ),
                'usePath' => 'xxl'
            ],
            'bs-sticky-lg' => [
                'classes' => [
                    'use-bs-sticky-lg',
                    'sticky-lg-top',
                    'sticky-lg-bottom',
                ],
                'usePath' => 'lg',
            ],
            'bs-sticky-md' => [
                'classes' => [
                    'use-bs-sticky-md',
                    'sticky-md-top',
                    'sticky-md-bottom',
                ],
                'usePath' => 'md',
            ],
            'bs-sticky-sm' => [
                'classes' => [
                    'use-bs-sticky-sm',
                    'sticky-sm-top',
                    'sticky-sm-bottom',
                ],
                'usePath' => 'sm',
            ],
            'bs-sticky-xl' => [
                'classes' => [
                    'use-bs-sticky-xl',
                    'sticky-xl-top',
                    'sticky-xl-bottom',
                ],
                'usePath' => 'xl',
            ],
            'bs-sticky-xxl' => [
                'classes' => [
                    'use-bs-sticky-xxl',
                    'sticky-xxl-top',
                    'sticky-xxl-bottom',
                ],
                'usePath' => 'xxl',
            ],
            'bs-tables-lg' => [
                'classes' => [
                    'use-bs-tables-lg',
                    'table-responsive-lg',
                ],
                'usePath' => 'lg',
            ],
            'bs-tables-md' => [
                'classes' => [
                    'use-bs-tables-md',
                    'table-responsive-md',
                ],
                'usePath' => 'md',
            ],
            'bs-tables-sm' => [
                'classes' => [
                    'use-bs-tables-sm',
                    'table-responsive-sm',
                ],
                'usePath' => 'sm',
            ],
            'bs-tables-xl' => [
                'classes' => [
                    'use-bs-tables-xl',
                    'table-responsive-xl',
                ],
                'usePath' => 'xl',
            ],
            'bs-tables-xxl' => [
                'classes' => [
                    'use-bs-tables-xxl',
                    'table-responsive-xxl',
                ],
                'usePath' => 'xxl',
            ],
            'bs-text-lg' => [
                'classes' => array_merge(
                    ['use-bs-text-lg'],
                    array_map(fn($value) => "text-lg-{$value}", ['center', 'end', 'start'])
                ),
                'usePath' => 'lg',
            ],
            'bs-text-md' => [
                'classes' => array_merge(
                    ['use-bs-text-md'],
                    array_map(fn($value) => "text-md-{$value}", ['center', 'end', 'start'])
                ),
                'usePath' => 'md',
            ],
            'bs-text-sm' => [
                'classes' => array_merge(
                    ['use-bs-text-sm'],
                    array_map(fn($value) => "text-sm-{$value}", ['center', 'end', 'start'])
                ),
                'usePath' => 'sm',
            ],
            'bs-text-xl' => [
                'classes' => array_merge(
                    ['use-bs-text-xl'],
                    array_map(fn($value) => "text-xl-{$value}", ['center', 'end', 'start'])
                ),
                'usePath' => 'xl',
            ],
            'bs-text-xxl' => [
                'classes' => array_merge(
                    ['use-bs-text-xxl'],
                    array_map(fn($value) => "text-xxl-{$value}", ['center', 'end', 'start'])
                ),
                'usePath' => 'xxl',
            ],
            'bs-width-lg' => [
                'classes' => array_merge(
                    ['use-bs-width-lg'],
                    array_map(fn($width) => "w-lg-{$width}", [25, 33, 50, 66, 75, 100]),
                    ['w-lg-auto', 'mw-lg-100', 'vw-lg-100', 'min-vw-lg-100']
                ),
                'usePath' => 'lg',
            ],
            'bs-width-md' => [
                'classes' => array_merge(
                    ['use-bs-width-md'],
                    array_map(fn($width) => "w-md-{$width}", [25, 33, 50, 66, 75, 100]),
                    ['w-md-auto', 'mw-md-100', 'vw-md-100', 'min-vw-md-100']
                ),
                'usePath' => 'md',
            ],
            'bs-width-sm' => [
                'classes' => array_merge(
                    ['use-bs-width-sm'],
                    array_map(fn($width) => "w-sm-{$width}", [25, 33, 50, 66, 75, 100]),
                    ['w-sm-auto', 'mw-sm-100', 'vw-sm-100', 'min-vw-sm-100']
                ),
                'usePath' => 'sm',
            ],
            'bs-width-xl' => [
                'classes' => array_merge(
                    ['use-bs-width-xl'],
                    array_map(fn($width) => "w-xl-{$width}", [25, 33, 50, 66, 75, 100]),
                    ['w-xl-auto', 'mw-xl-100', 'vw-xl-100', 'min-vw-xl-100']
                ),
                'usePath' => 'xl',
            ],
            'bs-width-xxl' => [
                'classes' => array_merge(
                    ['use-bs-width-xxl'],
                    array_map(fn($width) => "w-xxl-{$width}", [25, 33, 50, 66, 75, 100]),
                    ['w-xxl-auto', 'mw-xxl-100', 'vw-xxl-100', 'min-vw-xxl-100']
                ),
                'usePath' => 'xxl',
            ],
        ];

        foreach ($asset_map as $component => $data) {
            $classes = $data['classes'];
            $usePath = $data['usePath'] ?? false;

            if (sp_has_any_block_attrs($content, $classes)) {
                add_action('enqueue_block_assets', function () use ($component, $usePath) {
                    sp_inline_bootstrap_assets($component, $usePath);
                });
            }
        }
    }
}

if (!function_exists('sp_compile_bootstrap_color_assets')) {
    function sp_compile_bootstrap_color_assets($content)
    {
        // Process the classes as needed...
        $colors = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'light', 'dark'];

        $asset_map = [];
        foreach ($colors as $color) {

            $asset_map["bs-accordion-color-{$color}"] = [
                'classes' => [
                    "accordion-{$color}",
                ],
            ];

            /* $asset_map["bs-alert-color-{$color}"] = [
                'classes' => [
                    "alert-{$color}",
                ],
            ];
        */
            $asset_map["bs-button-color-{$color}"] = [
                'classes' => [
                    "btn-{$color}",
                    "btn-outline-{$color}",
                ],
            ];
            /*
            $asset_map["bs-card-color-{$color}"] = [
                'classes' => [
                    "bg-{$color}-bg-subtle",
                    "bg-{$color}",
                ],
            ];
            */
            /*
            $asset_map["bs-list-group-color-{$color}"] = [
                'classes' => [
                    "list-group-item-{$color}",
                    "bg-{$color}-bg-subtle",
                    "bg-{$color}",
                ],
            ];
            */
            // Add other components here...
        }

        foreach ($asset_map as $component => $data) {
            $classes = $data['classes'];

            if (sp_has_any_block_attrs($content, $classes)) {
                /* do Stuff */
                add_action('enqueue_block_assets', function () use ($component) {
                    sp_inline_bootstrap_color_assets($component);
                });
                /* finish Stuff */
            }
        }
    }
}

if (!function_exists('sp_compile_wp_color_assets')) {
    function sp_compile_wp_color_assets($asset, $content)
    {
        //$asset stylesheet name bs-card-color-

        // Process the classes as needed...
        $colors = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'light', 'dark'];

        // $asset_map = [];
        foreach ($colors as $color) {

            $asset_map[$asset . $color] = [
                'color-background' => [
                    "bs-{$color}",
                    "bs-{$color}-bg-subtle",
                ],
            ];
        }

        foreach ($asset_map as $component => $data) {
            $colorbackGround = $data['color-background'];

            if (sp_has_any_block_attrs($content, $colorbackGround)) {
                add_action('enqueue_block_assets', function () use ($component) {
                    sp_inline_bootstrap_color_assets($component);
                });
            }
        }
    }
}

/**
 * Filter assets to load stylesheet data
 */
if (!function_exists('sp_block_stylesheet_filters')) {

    // Hook into 'render_block' filter to check block content for classNames
    /*
    add_filter('render_block', function ($block_content, $block) {

        // For non-core/html blocks, check the className attribute.
        if (!empty($block['attrs']['className'])) {
            // This will only execute if className exists and isn't empty.
            sp_compile_bootstrap_assets($block['attrs']['className']);

            sp_compile_bootstrap_color_assets($block['attrs']['className']);
        }

        // For core/html blocks, scan the entire block content for class attributes.
        elseif ($block['blockName'] === 'core/html' && !empty($block_content)) {
            // Extract class attributes from the HTML content.
            if (preg_match_all('/class=["\']([^"\']+)["\']/', $block_content, $matches)) {
                $classes = implode(' ', $matches[1]); // Combine all class attributes found.
                sp_compile_bootstrap_assets($classes);
                sp_compile_bootstrap_color_assets($classes);
            }
        }

        return $block_content;
    }, 10, 2);
    */

    add_filter('render_block', function ($block_content, $block) {
        if (!empty($block['attrs']['className'])) {
            sp_compile_bootstrap_assets($block['attrs']['className']);
            sp_compile_bootstrap_color_assets($block['attrs']['className']);
        }
        return $block_content;
    }, 10, 2);

    add_filter('render_block', function ($block_content, $block) {
        if (!empty($block_content) && isset($block['blockName']) && $block['blockName'] === 'core/html') {
            if (preg_match_all('/class=["\']([^"\']+)["\']/', $block_content, $matches)) {
                $classes = implode(' ', $matches[1]); // Combine all found class attributes
                sp_compile_bootstrap_assets($classes);
                sp_compile_bootstrap_color_assets($classes);
            }
        }
        return $block_content;
    }, 10, 2);

    add_filter('render_block', function ($block_content, $block) {
        if (empty($block['attrs']['backgroundColor']) || empty($block['attrs']['className'])) {
            return $block_content;
        }

        $class = sp_get_class_name($block);
        $color = $block['attrs']['backgroundColor'];

        $map = [
            //   'alert'       => 'bs-alert-color-',
            'btn'       => 'bs-button-color-',
            //  'card'        => 'bs-card-color-',
            //   'list-group'  => 'bs-list-group-color-',
        ];

        foreach ($map as $key => $prefix) {
            if (strpos($class, $key) !== false) {
                sp_compile_wp_color_assets($prefix, $color);
                break; // No need to check further once a match is found
            }
        }

        foreach ($map as $key => $prefix) {
            $classes = explode(' ', trim($class)); // Split into an array
            if (in_array($key, $classes, true)) { // Strict match
                sp_compile_wp_color_assets($prefix, $color);
                return $block_content;
            }
        }

        return $block_content;
    }, 10, 2);
}

/* button filter */
add_filter('render_block', function ($block_content, $block) {
    // Check if this is a button block
    if (!empty($block['blockName']) && $block['blockName'] === 'core/button') {

        if (empty($block['attrs']['backgroundColor']) && empty($block['attrs']['textColor'])) {
            return $block_content;
        }

        // Do something when a button block is present

        if (! empty($block['attrs']['textColor'])) {
            $color = $block['attrs']['textColor'];
        } elseif (! empty($block['attrs']['backgroundColor'])) {
            $color = $block['attrs']['backgroundColor'];
        }

        $component = 'bs-buttons';
        $usePath = 'script';

        add_action('enqueue_block_assets', function () use ($component, $usePath) {
            sp_inline_bootstrap_assets($component, $usePath);
        });

        sp_compile_wp_color_assets('bs-button-color-', $color);
    }

    return $block_content;
}, 10, 2);
