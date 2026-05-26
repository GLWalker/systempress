<?php

/**
 * Prepare to enqueue any assets as found by attributes
 * CONSOLIDATED FOR TESTING
 */
if (!function_exists('sp_compile_bootstrap_assets')) {

    function sp_compile_bootstrap_assets($content)
    {
        $asset_map = [
            'bs-accordion' => [
                'classes' => ['use-bs-accordion', 'accordion'],
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
