<?php

/**
 * SystemPress Bootstrap Styles
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 *
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('sp_bs_stylesheets')) {
    /*  */
    /**
     * Check markup for trigger classes to load
     * files when needed
     *
     * @param [type] $content
     *
     * @return void
     */
    function sp_bs_stylesheets($content)
    {

        if (str_contains($content, 'accordion')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_accordion');
        }
        if (str_contains($content, 'alert')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_alert');
            wp_enqueue_script('bs-alert');
        }
        /* added to main bootstrap.css
        if ( str_contains( $content, 'badge' ) ) {
            wp_enqueue_style( 'bs-badge' );
        }
        */
        if (str_contains($content, 'rounded-')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_border_radius');
        }
        if (str_contains($content, 'border-')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_border');
        }
        if (str_contains($content, 'breadcrumb')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_breadcrumb');
            wp_enqueue_script('bs-breadcrumb');
        }
        if (str_contains_any($content, array('btn-group', 'btn-toolbar'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_button_group');
        }
        if (str_contains_any($content, array('btn', 'btn-', 'wp-element-button', 'wp-block-button'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_buttons');
            wp_enqueue_script('bs-buttons');
        }
        if (str_contains_any($content, array('card-body', 'card-header', 'card-text', 'card-img'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_card');
            wp_enqueue_script('bs-card');
        }

        if (str_contains($content, 'carousel')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_carousel');
            wp_enqueue_script('bs-carousel');
        }
        /* added to main bootstrap.css
        if ( str_contains( $content, 'btn-close' ) ) {
            wp_enqueue_style( 'bs-close' );
        }
        */
        /* added css to main bootstrap.css */
        if (str_contains_any($content, array(' container', ' container ', 'container-fluid', 'container-xxl', 'container-xl', 'container-lg', 'container-md', 'container-sm'))) {
            wp_enqueue_script('bs-container');
        }

        if (str_contains_any($content, array('dropup', 'dropend', 'dropdown', 'dropstart'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_dropdown');
        }
        /* added to main bootstrap.css
        if ( str_contains_any( $content, array( 'fixed-top', 'fixed-bottom' ) ) ) {
            wp_enqueue_style( 'bs-fixed' );
        }
        */
        if (str_contains($content, 'form-floating')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_floating_labels');
            wp_enqueue_script('bs-forms');
        }
        if (str_contains($content, 'focus-ring-')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_focus_ring');
        }
        if (str_contains_any($content, array('form-check', 'form-switch', 'btn-check', 'comment-form-cookies-consent'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_form_check');
            wp_enqueue_script('bs-forms');
        }
        if (str_contains_any($content, array('form-control', 'wp-block-loginout', 'comment-form', 'wp-block-search', 'wu-login-form'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_form_control');
            wp_enqueue_script('bs-forms');
        }
        if (str_contains($content, 'comment-form')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_validation');
        }
        if (str_contains($content, 'form-range')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_form_range');
            wp_enqueue_script('bs-forms');
        }
        if (str_contains_any($content, array('use-form-select', 'form-select', 'wp-block-categories-dropdown', 'wp-block-archives-dropdown'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_form_select');
            wp_enqueue_script('bs-forms');
        }
        /* added to main bootstrap.css
        if ( str_contains( $content, 'form-text' ) ) {
            wp_enqueue_style( 'bs-form-text' );
        }
        */
        if (str_contains($content, 'gap-')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_gap');
        }
        /* Dont want to load BS Grid unless specifically called by adding use-bs-grid class to block element */
        if (str_contains($content, 'use-bs-grid')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_grid');
        }
        if (str_contains_any($content, array('input-group', 'wp-block-search__inside-wrapper'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_input_group');
        }
        if (str_contains_any($content, array('form-label', 'comment-form-cookies-consent'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_labels');
            wp_enqueue_script('bs-forms');
        }

        if (str_contains_any($content, array('link-o', 'link-u'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_link');
        }

        if (str_contains($content, 'list-group')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_list_group');
            wp_enqueue_script('bs-list-group');
        }
        if (str_contains_any($content, array('m-0', 'm-1', 'm-2', 'm-3', 'm-4', 'm-5', 'mx-', 'my-', 'mt-', 'me-', 'mb-', 'ms-'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_margin');
        }
        if (str_contains_any($content, array('modal ', 'modal-'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_modal');
        }
        if (str_contains_any($content, array('nav ', 'nav', 'nav-'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_nav');
        }
        if (str_contains_any($content, array('navbar', 'navbar-'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_navbar');
        }
        if (str_contains($content, 'offcanvas')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_offcanvas');
        }

        if (str_contains_any($content, array('p-0', 'p-1', 'p-2', 'p-3', 'p-4', 'p-5', 'px-', 'py-', 'pt-', 'pe-', 'pb-', 'ps-'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_padding');
        }
        if (str_contains_any($content, array('pagination', 'page-number', 'page-link', 'wp-block-query-pagination'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_pagination');
        }
        if (str_contains($content, 'placeholder')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_placeholders');
        }
        if (str_contains($content, 'popover')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_popover');
            wp_enqueue_script('bs-popover');
        }
        if (str_contains($content, 'd-print')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_print');
        }
        if (str_contains($content, 'progress')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_progress');
        }
        /* added to main bootstrap.css
        if ( str_contains( $content, 'ratio' ) ) {
            wp_enqueue_style( 'bs-ratio' );
        }
        */
        if (str_contains($content, 'spinner-')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_spinners');
        }
        if (str_contains($content, 'sticky-')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_sticky');
        }
        if (str_contains_any($content, array('table', 'caption-'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_tables');
            wp_enqueue_script('bs-tables');
        }
        if (str_contains($content, 'toast')) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_toast');
            wp_enqueue_script('bs-toast');
        }
        if (str_contains_any($content, array('use-tooltip', 'tooltip'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_tooltip');
            wp_enqueue_script('bs-tooltip');
        }
        /* added to main bootstrap.css
        if ( str_contains_any( $content, array( 'fade', 'collaps' ) ) ) {
            wp_enqueue_style( 'bs-transitions' );
        }
        */
        if (str_contains_any($content, array('needs-validation', 'valid-', 'valid-', 'invalid-', 'was-validated'))) {
            add_action('enqueue_block_assets', 'sp_add_style_bs_validation');
        }
    }
}
/**
 * Bootstrap Stylesheet functions
 *
 * The following functions all do the same thing, for each BS stylesheet on the assets/css/bootstrap/ dir, it grabs the contents and prepares it for inserting into inline styles for main BootStrap css. Optionally the stylesheets could (still can) have been enqueued with no need to write new functions. This is simply a method to load the css into one inline style vs loading several inline styles.
 *
 * @return void
 */
function sp_add_style_bs_accordion()
{
    $style = 'bs-accordion';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_alert()
{
    $style = 'bs-alert';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_border()
{
    $style = 'bs-border';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_border_radius()
{
    $style = 'bs-border-radius';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_breadcrumb()
{
    $style = 'bs-breadcrumb';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_button_group()
{
    $style = 'bs-button-group';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_buttons()
{
    $style = 'bs-buttons';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}

function sp_add_style_bs_card()
{
    $style = 'bs-card';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_carousel()
{
    $style = 'bs-carousel';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_containers()
{
    $style = 'bs-containers';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_dropdown()
{
    $style = 'bs-dropdown';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_floating_labels()
{
    $style = 'bs-floating-labels';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_focus_ring()
{
    $style = 'bs-focus-ring';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_form_check()
{
    $style = 'bs-form-check';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_form_control()
{
    $style = 'bs-form-control';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_form_range()
{
    $style = 'bs-form-range';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_form_select()
{
    $style = 'bs-form-select';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_gap()
{
    $style = 'bs-gap';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_grid()
{
    $style = 'bs-grid';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_input_group()
{
    $style = 'bs-input-group';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_labels()
{
    $style = 'bs-labels';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_link()
{
    $style = 'bs-link';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_list_group()
{
    $style = 'bs-list-group';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_margin()
{
    $style = 'bs-margin';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_modal()
{
    $style = 'bs-modal';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_nav()
{
    $style = 'bs-nav';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_navbar()
{
    $style = 'bs-navbar';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_offcanvas()
{
    $style = 'bs-offcanvas';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_padding()
{
    $style = 'bs-padding';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_pagination()
{
    $style = 'bs-pagination';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_placeholders()
{
    $style = 'bs-placeholders';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_popover()
{
    $style = 'bs-popover';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_print()
{
    $style = 'bs-print';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_progress()
{
    $style = 'bs-progress';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_spinners()
{
    $style = 'bs-spinners';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_sticky()
{
    $style = 'bs-sticky';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_tables()
{
    $style = 'bs-tables';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_toast()
{
    $style = 'bs-toast';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_tooltip()
{
    $style = 'bs-tooltip';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
function sp_add_style_bs_validation()
{
    $style = 'bs-validation';
    if ('' === $style) {
        return;
    }
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    if (did_action('enqueue_block_assets') === 1) {
        // $css = '';
        $css = file_get_contents(get_template_directory() . '/assets/css/bootstrap/' . $style . $suffix . '.css');
        $css = str_replace(array("\r", "\n", "\t"), '', $css);

        wp_add_inline_style('@bootstrap', $css);
    }
}
