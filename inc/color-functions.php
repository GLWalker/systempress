<?php

/**
 * SystemPress Color Functions
 * @package SystemPress
 *
 * @since 0.0.1
 * @source SystemPress
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('sp_generate_base_vars')) {
    /**
     * Generates base shades and variables
     * for output
     *
     * @param [type] $slug slugname of theme color palette json settings
     *
     * @return void
     */
    function sp_generate_base_vars($slug)
    {
        $styles = '';
        $colors = wp_get_global_settings();
        $colors = $colors['color']['palette']['theme'];

        ob_start();
        $css = new SystemPress_CSS();
        foreach ($colors as $color) {

            if ($color['slug'] == ($slug)) {

                $slug = $color['slug'];
                $color = $color['color'];
                $slug2 = $slug;
                $color2 = $color;
                $emphasis = false;

                $rgb = '';
                $rgba = '';
                $rgb_value = '';
                $opacity = '0';
                $rgb_var = '';
                $rgb_value = $color;

                if (str_contains($color, 'rgb')) {

                    if (str_contains($color, 'rgba')) {
                        $rgba = true;
                        $opacity = strrchr($color, ',');
                        $opacity = str_replace(array(',', ')'), '', $opacity);

                        $rgb_value = str_replace(array($opacity,  ',)', '))'), ')', $rgb_value);
                    } else {
                        $rgb = true;
                    }

                    $rgb_value = str_replace('rgba', 'rgb', $rgb_value);
                }

                $color = new SystemPress_ColorPalette($color);

                if (!str_contains($rgb_value, 'rgb')) {
                    $rgb_value = $color->hex_to_rgb($rgb_value);
                }

                $textcolor = $color->rgb_to_hex($rgb_value);
                $textcolor = $color->parse_the_contrast($textcolor);

                $rgb_var = str_replace(array('rgb(', ')'), '', $rgb_value);

                /* creatPalette to generate body emphasis color */
                $colorPalette = $color->createPalette();
                $counter = 1;
                /* eol creatPalette */

                $css->set_selector('rawout');

                if ('contrast' === $slug) {
                    $slug = 'bs-body-color';
                    $emphasis = true;
                }
                if ('base' === $slug) {
                    $slug = 'bs-body-bg';
                }

                if ('bs-border-color' === $slug) {
                    $slug = 'bs-border-color';
                }

                /* This will output the var *
                $css->add_property( '--' . ($slug), 'var(--wp--preset--color--' . ($slug2) . ')' );
                $css->add_property( '--' . ( $slug ) . '-rgb', ( $rgb_var ) );
                */

                /* This will output the color code */
                $css->add_property('--' . ($slug), ($color2));
                $css->add_property('--' . ($slug) . '-rgb', ($rgb_var));

                if (true === $emphasis) {

                    foreach ($colorPalette as $color) {

                        if (true === $rgba || true === $rgb) {
                            $colorrgb = new SystemPress_ColorPalette($color);
                            $color = $colorrgb->hex_to_rgb($color);
                        }

                        $counter++;
                        /* only need emphasis color output */
                        if (4 == $counter) {

                            $css->add_property('--bs-emphasis-color', $color);

                            if (!str_contains($color, 'rgb')) {

                                $colorrgb = new SystemPress_ColorPalette($color);

                                $color = $colorrgb->hex_to_rgb($color);

                                $color = str_replace(array('rgb(', ')'), '',  $color);
                            }

                            $css->add_property('--bs-emphasis-color-rgb', $color);
                        }
                    }
                }

                $cssoutput = $css->css_output();

                return  $cssoutput;
            }
        }

        $styles = ob_get_clean();
        return $styles;
    }
}

if (!function_exists('sp_generate_contrast_vars')) {
    /**
     * Generates base shades and variables
     * for output
     *
     * @param [type] $slug slugname of theme color palette json settings
     *
     * @return void
     */
    function sp_generate_contrast_vars($slug)
    {
        $styles = '';
        $colors = wp_get_global_settings();
        $colors = $colors['color']['palette']['theme'];

        ob_start();
        $css = new SystemPress_CSS();
        foreach ($colors as $color) {

            if ($color['slug'] == ($slug)) {

                $slug = $color['slug'];
                $color = $color['color'];
                $color2 = $color;

                $rgb = '';
                $rgba = '';
                $rgb_value = '';
                $opacity = '0';
                $rgb_var = '';

                $rgb_value = $color;

                if (str_contains($color, 'rgb')) {

                    if (str_contains($color, 'rgba')) {
                        $rgba = true;
                        $opacity = strrchr($color, ',');
                        $opacity = str_replace(array(',', ')'), '', $opacity);

                        $rgb_value = str_replace(array($opacity,  ',)', '))'), ')', $rgb_value);
                    } else {
                        $rgb = true;
                    }

                    $rgb_value = str_replace('rgba', 'rgb', $rgb_value);
                }

                $color = new SystemPress_ColorPalette($color);

                if (!str_contains($rgb_value, 'rgb')) {
                    $rgb_value = $color->hex_to_rgb($rgb_value);
                }

                $rgb_var = str_replace(array('rgb(', ')'), '', $rgb_value);

                $colorPalette = $color->createPalette();
                $counter = 1;

                $css->set_selector('rawout');

                if ('contrast' === $slug) {
                    $slug = 'bs-body-color';
                }

                $css->add_property('--' . ($slug), ($color2));

                $css->add_property('--' . ($slug) . '-rgb', ($rgb_var));

                foreach ($colorPalette as $color) {

                    if (true === $rgba || true === $rgb) {
                        $colorrgb = new SystemPress_ColorPalette($color);
                        $color = $colorrgb->hex_to_rgb($color);
                    }

                    $counter++;
                    /* only need emphasis color output */
                    if (4 == $counter) {

                        $css->add_property('--bs-emphasis-color', $color);

                        if (!str_contains($color, 'rgb')) {

                            $colorrgb = new SystemPress_ColorPalette($color);

                            $color = $colorrgb->hex_to_rgb($color);

                            $color = str_replace(array('rgb(', ')'), '',  $color);
                        }

                        $css->add_property('--bs-emphasis-color-rgb', $color);
                    }
                }

                $cssoutput = $css->css_output();

                return  $cssoutput;
            }
        }
        $styles = ob_get_clean();
        return $styles;
    }
}
if (!function_exists('sp_generate_color_vars')) {
    /**
     * Generates BootStrap 5 color shades and variables
     * for output
     *
     * @param [type] $slug slugname of theme color palette json settings
     *
     * @return void
     */

    function sp_generate_color_vars($slug)
    {

        $styles = '';
        $colors = wp_get_global_settings();
        $colors = $colors['color']['palette']['theme'];

        ob_start();
        $css = new SystemPress_CSS();
        foreach ($colors as $color) {

            if ($color['slug'] == ($slug)) {

                $slug = $color['slug'];
                $color = $color['color'];
                $color2 = $color;

                $rgb = '';
                $rgba = '';
                $rgb_value = '';
                $opacity = '0';
                $rgb_var = '';
                $text = '';

                $rgb_value = $color;

                if (str_contains($color, 'rgb')) {

                    if (str_contains($color, 'rgba')) {
                        $rgba = true;
                        $opacity = strrchr($color, ',');
                        $opacity = str_replace(array(',', ')'), '', $opacity);

                        $rgb_value = str_replace(array($opacity,  ',)', '))'), ')', $rgb_value);
                    } else {
                        $rgb = true;
                    }

                    $rgb_value = str_replace('rgba', 'rgb', $rgb_value);
                }

                $color = new SystemPress_ColorPalette($color);

                if (!str_contains($rgb_value, 'rgb')) {
                    $rgb_value = $color->hex_to_rgb($rgb_value);
                }

                $rgb_var = str_replace(array('rgb(', ')'), '', $rgb_value);

                $textcolor = $color->rgb_to_hex($rgb_value);
                $textcolor = $color->parse_the_contrast($textcolor);

                $colorPalette = $color->createPalette();
                $counter = 1;

                $css->set_selector('rawout');

                /* output wp--preset--color var DEFAULT */
                $css->add_property('--' . ($slug), 'var(--wp--preset--color--' . ($slug) . ')');
                /* output actual color value */
                //$css->add_property('--' . ($slug), ($color2));
                foreach ($colorPalette as $color) {

                    if (true === $rgba) {
                        $opacity =  (round($opacity, 2) + 0.033);
                        if (4 == $counter) {
                            $opacity = '1';
                        }
                        $colorrgb = new SystemPress_ColorPalette($color);
                        $color = $colorrgb->hex_to_rgb($color, $opacity);
                    }
                    if (true === $rgb) {
                        $colorrgb = new SystemPress_ColorPalette($color);
                        $color = $colorrgb->hex_to_rgb($color);
                    }

                    if (5 == $counter) {
                        $colorrgb2 = new SystemPress_ColorPalette($color);
                        $color = $colorrgb2->hex_to_rgb($color);
                        $color = str_replace(array('rgb(', ')'), '', $color);
                    }

                    $css->add_property('--' . ($slug) . '-' . $counter++, $color);
                }

                $css->add_property('--' . ($slug) . '-rgb', ($rgb_var));

                $css->add_property('--' . ($slug) . '-text', 'var(' . ($textcolor) . ')');

                /*
                if ('bs-light' === $slug) {
                    $css->add_property( '--' . ($slug) . '-text-shadow','var(--bs-transparent-textshadow)' );
                } elseif  ('bs-dark' === $slug) {
                    $css->add_property( '--' . ($slug) . '-text-shadow','var(--bs-transparent-textshadow)' );
                } else {
                    $css->add_property('--' . ($slug) . '-text-shadow', 'var(' . $textcolor . '-textshadow)' );
                }
*/
                $cssoutput = $css->css_output();

                $cssoutput = str_replace('-1', '-border-color', $cssoutput);
                $cssoutput = str_replace('-bg-subtle-border-color', '-border-subtle', $cssoutput);
                $cssoutput = str_replace('-2', '-hover-bg', $cssoutput);
                $cssoutput = str_replace('-bg-subtle-hover-bg', '-hover-bg-subtle',  $cssoutput);
                $cssoutput = str_replace('-3', '-hover-border-color', $cssoutput);
                $cssoutput = str_replace('-bg-subtle-hover-border-color', '-hover-border-subtle', $cssoutput);
                $cssoutput = str_replace('-4', '-text-emphasis',  $cssoutput);
                $cssoutput = str_replace('-bg-subtle-text-emphasis', '-text-emphasis-subtle', $cssoutput);
                $cssoutput = str_replace('-5', '-shadow-rgb',  $cssoutput);
                $cssoutput = str_replace('-bg-subtle-shadow-rgb', '-shadow-rgb-subtle', $cssoutput);

                return  $cssoutput;
            }
        }
        $styles = ob_get_clean();
        return $styles;
    }
}
if (!function_exists('sp_generate_text_shadow_vars')) {
    /**
     * Generates text shadow variables
     * for output
     * !!!text colors only or output will be backwards!!!
     *
     * @param [type] $slug slugname of theme color palette json settings
     *
     * Usage : sp_generate_text_shadow_vars('bs-secondary-color');
     * @return void
     */
    function sp_generate_text_shadow_vars($slug)
    {
        $styles = '';
        $colors = wp_get_global_settings();
        $colors = $colors['color']['palette']['theme'];

        ob_start();
        $css = new SystemPress_CSS();
        foreach ($colors as $color) {

            if ($color['slug'] == ($slug)) {

                $slug = $color['slug'];
                $color = $color['color'];
                $color2 = $color;

                $rgb = '';
                $rgba = '';
                $rgb_value = '';
                $opacity = '0';
                $rgb_var = '';

                $rgb_value = $color;

                if (str_contains($color, 'rgb')) {

                    if (str_contains($color, 'rgba')) {
                        $rgba = true;
                        $opacity = strrchr($color, ',');
                        $opacity = str_replace(array(',', ')'), '', $opacity);

                        $rgb_value = str_replace(array($opacity,  ',)', '))'), ')', $rgb_value);
                    } else {
                        $rgb = true;
                    }

                    $rgb_value = str_replace('rgba', 'rgb', $rgb_value);
                }

                $color = new SystemPress_ColorPalette($color);

                if (!str_contains($rgb_value, 'rgb')) {
                    $rgb_value = $color->hex_to_rgb($rgb_value);
                }

                $rgb_var = str_replace(array('rgb(', ')'), '', $rgb_value);

                $css->set_selector('rawout');

                $textcolor = $color->rgb_to_hex($rgb_value);

                $textcolor = $color->parse_the_contrast($textcolor);

                if ('--bs-lighter-text' === $textcolor) {
                    $textcolor = '--bs-dark';
                } else {
                    $textcolor = '--bs-light';
                }

                $css->add_property('--wp--preset--color--' . ($slug) . '-text-shadow', 'var(' . $textcolor . '-textshadow)');

                $cssoutput = $css->css_output();

                return  $cssoutput;
            }
        }
        $styles = ob_get_clean();
        return $styles;
    }
}

if (!function_exists('sp_remove_color_css')) {
    /**
     * Remove CSS color styles from global stylesheet
     *
     * @param [type] $color
     * @param [type] $string
     *
     * @return void
     */
    function sp_remove_color_css($color, $string)
    {

        if (!$color || '' === $color) {
            return;
        }

        $find = '.has-' . $color . '-color{color: var(--wp--preset--color--' . $color . ') !important;}';

        $css = ($find) ?  sanitize_text_field(str_replace($find, '', $string)) : '';

        return $css;
    }
}
if (!function_exists('sp_remove_background_css')) {
    /**
     * Remove CSS background color styles from global stylesheet
     *
     * @param [type] $color
     * @param [type] $string
     *
     * @return void
     */
    function sp_remove_background_css($color, $string)
    {

        if (!$color || '' === $color) {
            return;
        }

        $find = '.has-' . $color . '-background-color{background-color: var(--wp--preset--color--' . $color . ') !important;}';

        $css = ($find) ?  sanitize_text_field(str_replace($find, '', $string)) : '';

        return $css;
    }
}
if (!function_exists('sp_remove_border_css')) {
    /**
     * Remove CSS border color styles from global stylesheet
     *
     * @param [type] $color
     * @param [type] $string
     *
     * @return void
     */
    function sp_remove_border_css($color, $string)
    {

        if (!$color || '' === $color) {
            return;
        }

        $find = '.has-' . $color . '-border-color{border-color: var(--wp--preset--color--' . $color . ') !important;}';

        $css = ($find) ?  sanitize_text_field(str_replace($find, '', $string)) : '';

        return $css;
    }
}
if (!function_exists('sp_color_css')) {
    /**
     * Modify the css output for merging WP color styles with BS styles
     *
     * @param [type] $color
     * @param [type] $string
     *
     * @return void
     */
    function sp_color_css($color, $string)
    {

        if (!$color || '' === $color) {
            return;
        }

        /* The PHP 8 way
         if (str_starts_with ($color, 'bs-' )) {
            $stripped = substr( $color, 3, null );
        } else {
            $stripped = $color;
        }
        */

        if (substr($color, 0, 3) === 'bs-') {
            $stripped = str_replace('bs-', '', $color);
        } else {
            $stripped = $color;
        }

        $find = '.has-' . $color . '-color{';

        $replace = '.text-' . $stripped . ', .link-' . $stripped . ', .has-' . $color . '-color{';

        $css = ($find) ?  sanitize_text_field(str_replace($find, $replace, $string)) : '';

        return $css;
    }
}
if (!function_exists('sp_background_css')) {
    /**
     * Modify the css output for merging WP background color styles with BS styles
     *
     * @param [type] $color
     * @param [type] $string
     *
     * @return void
     */
    function sp_background_css($color, $string)
    {

        if (!$color || '' === $color) {
            return;
        }

        if (substr($color, 0, 3) === 'bs-') {
            $stripped = str_replace('bs-', '', $color);
        } else {
            $stripped = $color;
        }

        $find = '.has-' . $color . '-background-color{';

        $replace = '.text-bg-' . $stripped . ', .bg-' . $stripped . ', .has-' . $color . '-background-color{';
        $replace .= 'color: var(--' . $color . '-text); ';

        $css = ($find) ?  sanitize_text_field(str_replace($find, $replace, $string)) : '';

        return $css;
    }
}
if (!function_exists('sp_border_css')) {
    /**
     * Modify the css output for merging WP border color styles with BS styles
     *
     * @param [type] $color
     * @param [type] $string
     *
     * @return void
     */
    function sp_border_css($color, $string)
    {

        if (!$color || '' === $color) {
            return;
        }

        if (substr($color, 0, 3) === 'bs-') {
            $stripped = str_replace('bs-', '', $color);
        } else {
            $stripped = $color;
        }

        $find = '.has-' . $color . '-border-color{';
        $replace = '.border-' . $stripped . ', .has-' . $color . '-border-color{';

        $find .= 'border-color: var(--wp--preset--color--' . $color . ')';
        $replace .= 'border-color: var(--' . $color . '-border-color)';

        $css = ($find) ?  sanitize_text_field(str_replace($find, $replace, $string)) : '';

        return $css;
    }
}
if (!function_exists('sp_font_size_css')) {
    /**
     *  Modify the css output for merging WP font size styles with BS styles
     *
     * @param [type] $size
     * @param [type] $string
     *
     * @return void
     */

    function sp_font_size_css($size, $string)
    {

        if (!$size || '' === $size) {
            return;
        }

        $name = '';

        if ('x-small' === $size) {
            $name = '.tiny, .x-small';
        } elseif ('small' === $size) {
            $name = 'small,.small';
        } elseif ('medium' === $size) {
            $name = '.fs-6';
        } elseif ('large' === $size) {
            $name = '.fs-5';
        } elseif ('x-large' === $size) {
            $name = '.fs-4';
        } elseif ('xx-large' === $size) {
            $name = '.fs-3';
        } elseif ('xxx-large' === $size) {
            $name = '.fs-2';
        } elseif ('huge' === $size) {
            $name = '.fs-1';
        } elseif ('display-6' === $size) {
            $name = '.display-6';
        } elseif ('display-5' === $size) {
            $name = '.display-5';
        } elseif ('display-4' === $size) {
            $name = '.display-4';
        } elseif ('display-3' === $size) {
            $name = '.display-3';
        } elseif ('display-2' === $size) {
            $name = '.display-2';
        } elseif ('display-1' === $size) {
            $name = '.display-1';
        } else {
            return;
        }

        $find = '.has-' . $size . '-font-size';

        $replace = $name . ',.has-' . $size . '-font-size';

        $css = ($find) ?  sanitize_text_field(str_replace($find, $replace, $string)) : '';

        return $css;
    }
}
