<?php

/**
 * SystemPress Generate Color Class
 * @package SystemPress
 *
 * @since 0.0.1
 * @source SystemPress
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!class_exists('SystemPress_ColorPalette')) {

    class SystemPress_ColorPalette
    {

        public $color;

        public function __construct($color)
        {
            if (!empty($color_vars)) {
                $color = $color;
            }

            if (str_contains($color, 'rgb')) {
                $color = $this->rgb_to_hex($color);
            }

            $this->color = $color;
        }

        public function hex_to_rgb($color, $opacity = false)
        {

            $default = 'rgb(0,0,0)';

            //Return default if no color provided
            if (empty($color))
                return $default;

            $color =  substr($color, 0, 7);

            //Sanitize $color if "#" is provided
            if ($color[0] == '#') {
                $color = substr($color, 1);
            }

            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
            } elseif (strlen($color) == 3) {
                $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
            } else {
                return $default;
            }

            //Convert hexadec to rgb
            $rgb =  array_map('hexdec', $hex);

            //Check if opacity is set(rgba or rgb)
            if ($opacity) {
                if (abs($opacity) > 1)
                    $opacity = 1.0;
                $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
            } else {
                $output = 'rgb(' . implode(",", $rgb) . ')';
            }

            //Return rgb(a) color string
            return $output;
        }

        public function rgb_to_hex($color)
        {
            $has_alpha = false;

            if (strpos($color, 'rgba') === 0) {
                $has_alpha = true;
            }

            $color = preg_replace('/^rgba?\(/', '', $color);
            $color = preg_replace('/\)$/', '', $color);

            if (strpos($color, ',') !== false) {
                $color = str_replace(' ', '', $color);
                $values = explode(',', $color);
            } else {
                $color = str_replace('/', ' ', $color);
                $color = preg_replace('/\s{2,}/', ' ', $color);
                $values = explode(' ', $color);
            }

            if ($has_alpha && count($values) === 4) {
                $color = sprintf('%02x%02x%02x%02x', $values[0], $values[1], $values[2], $values[3] * 255);
            } else if (!$has_alpha && count($values) === 3) {
                $color = sprintf('%02x%02x%02x', $values[0], $values[1], $values[2]) . 'ff';
            } else {
                $color = '';
            }

            if (empty($color)) {
                return;
            }

            return '#' . $color;
        }

        public function parse_the_contrast($color)
        {
            // HEX to RGB

            $r1 = hexdec(substr($color, 1, 2));
            $g1 = hexdec(substr($color, 3, 2));
            $b1 = hexdec(substr($color, 5, 2));

            // Black

            $black = '#000000';
            $r2black = hexdec(substr($black, 1, 2));
            $g2black = hexdec(substr($black, 3, 2));
            $b2black = hexdec(substr($black, 5, 2));

            // Contrast Ratio

            $l1 = 0.2126 * pow($r1 / 255, 2.2) +
                0.7152 * pow($g1 / 255, 2.2) +
                0.0722 * pow($b1 / 255, 2.2);

            $l2 = 0.2126 * pow($r2black / 255, 2.2) +
                0.7152 * pow($g2black / 255, 2.2) +
                0.0722 * pow($b2black / 255, 2.2);

            if ($l1 > $l2) {
                $contrastRatio = (int) (($l1 + 0.05) / ($l2 + 0.05));
            } else {
                $contrastRatio = (int) (($l2 + 0.05) / ($l1 + 0.05));
            }

            if ($contrastRatio > 5) {
                return '--bs-darker-text';
            } else {
                return '--bs-lighter-text';
            }
        }

        public function color_mod($hex, $diff)
        {
            $rgb = str_split(trim($hex, '# '), 2);

            foreach ($rgb as &$hex) {
                $dec = hexdec($hex);
                if ($diff >= 0) {
                    $dec += $diff;
                } else {
                    $dec -= abs($diff);
                }
                $dec = max(0, min(255, $dec));
                $hex = str_pad(dechex($dec), 2, '0', STR_PAD_LEFT);
            }
            return '#' . implode($rgb);
        }

        public function createPalette($colorCount = 5)
        {
            $colorPalette = array();
            $newColor = $this->color;

            for ($i = 1; $i <= $colorCount; $i++) {
                if ($i == 1) {
                    $color = $this->color;
                    $colorVariation = - (2);
                }
                if ($i == 2) {
                    $color = $this->color;
                    $colorVariation = - ($i * 15);
                }
                if ($i == 3) {
                    $color = $newColor;
                    $colorVariation = - (6);
                }
                if ($i == 4) {
                    $color = $newColor;
                    $colorVariation = - ($i * 15);
                }
                if ($i == 5) {
                    $color = $this->color;
                    $colorVariation = (25);
                }

                $newColor = $this->color_mod($color, $colorVariation);

                array_push($colorPalette, $newColor);
            }
            return $colorPalette;
        }
    }
}
