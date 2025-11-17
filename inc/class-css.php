<?php

/**
 * SystemPress Generate CSS Class
 * @package SystemPress
 *
 * @since 0.0.1
 *
 * This file is a modification of code originally created by Carlos Rios,
 * which was later modified by Tom Usborne for GeneratePress.
 *
 * The code is used under the terms of the GPL-2.0 or later license.
 *
 * You can find the full text of the GPL-2.0 license at:
 * https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Modifications by G.L. Walker (SystemPress).
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('sp_get_media_query')) {
	/**
	 * Get a responsive media query string based on Bootstrap-style breakpoint.
	 *
	 * Example usage with CSS builder:
	 *
	 * $breakpoints = [ 'xxl', 'xl', 'lg', 'md', 'sm' ];
	 *
	 * foreach ( $breakpoints as $size ) {
	 *     $media = sp_get_media_query( $size );
	 *
	 *     $css->start_media_query( $media );
	 *     $css->set_selector( ".my-class-{$size}" );
	 *     $css->add_property( 'display', 'none' );
	 *     $css->end_media_query();
	 * }
	 *
	 * @param string $name Breakpoint name (xxl, xl, lg, md, sm).
	 * @return string Media query string like '(max-width: 960px)'.
	 */
	function sp_get_media_query(string $name): string
	{
		// Define breakpoints for the different media queries.
		$breakpoints = [
			'xxl' => 1320,
			'xl'  => 1140,
			'lg'  => 960,
			'md'  => 720,
			'sm'  => 540,
		];

		// Initialize an empty array to store media queries.
		$queries = [];

		// Loop through each breakpoint and generate the media query.
		foreach ($breakpoints as $key => $max) {
			$queries[$key] = apply_filters("sp_media_query_{$key}", "(max-width: {$max}px)");
		}

		// Use `match` for PHP 8.0+
		return match ($name) {
			'xxl', 'xl', 'lg', 'md', 'sm' => $queries[$name],
			default => '', // Return empty if name doesn't match.
		};
	}
}

if (!class_exists('SystemPress_CSS')) {
	/**
	 * SystemPress CSS generator optimized for PHP 8.3
	 *
	 * Provides a chainable API for building CSS in PHP,
	 * with support for selectors, media queries, scoped output,
	 * and clean minified rendering.
	 */
	class SystemPress_CSS
	{
		protected string $_selector = '';
		protected string $_css = '';
		protected string $_output = '';

		protected ?string $_media_query = null;
		protected string $_media_query_output = '';

		protected ?string $_scope = null;
		protected string $_scope_output = '';

		/**
		 * Set a CSS selector.
		 *
		 * @param string $selector
		 * @return $this
		 *
		 * @example
		 * $css->set_selector('.btn')->add_property('color', 'red');
		 */
		public function set_selector(string $selector): self
		{
			if ($this->_selector !== '') {
				$this->add_selector_rules_to_output();
			}

			$this->_selector = $selector;
			return $this;
		}

		/**
		 * Add a CSS property to the current selector.
		 *
		 * Skips empty values and values equal to the original default.
		 *
		 * @param string $property     The CSS property name.
		 * @param mixed  $value        The value to assign.
		 * @param mixed  $og_default   Optional default to check against.
		 * @param string|null $unit    Optional unit (e.g. 'px', '%').
		 * @return $this|false
		 *
		 * @example
		 * $css->add_property('padding', 10, false, 'px');
		 */
		public function add_property(string $property, $value, $og_default = false, ?string $unit = null)
		{
			if ('font-size' === $property && 0 === $value) {
				return false;
			}

			if ($unit) {
				$value = $value . $unit;
				if ($og_default) {
					$og_default .= $unit;
				}
			}

			if ((empty($value) && !is_numeric($value)) || $og_default === $value) {
				return false;
			}

			$this->_css .= "$property:$value;";
			return $this;
		}

		/**
		 * Start a media query block. Use null to close.
		 *
		 * @param string|null $value Media query string, e.g., '(min-width: 768px)'
		 * @return $this
		 *
		 * @example
		 * $css->start_media_query('(min-width: 768px)')
		 *     ->set_selector('.grid')
		 *     ->add_property('display', 'grid');
		 */
		public function start_media_query(?string $value): self
		{
			$this->add_selector_rules_to_output();

			if (!empty($this->_media_query)) {
				$this->add_media_query_rules_to_output();
			}

			$this->_media_query = $value;
			return $this;
		}

		/**
		 * Close the current media query context.
		 *
		 * @return $this
		 *
		 * @example
		 * $css->stop_media_query();
		 */
		public function stop_media_query(): self
		{
			return $this->start_media_query(null);
		}

		/**
		 * Start a scoped block such as :root or [data-bs-theme=dark].
		 * Use null to close the scope.
		 *
		 * @param string|null $scope
		 * @return $this
		 *
		 * @example
		 * $css->start_scope('[data-bs-theme=dark]')
		 *     ->set_selector('.my-class')
		 *     ->add_property('color', '#fff');
		 */
		public function start_scope(?string $scope): self
		{
			$this->add_selector_rules_to_output();

			if (!empty($this->_scope)) {
				$this->add_scope_rules_to_output();
			}

			$this->_scope = $scope;
			return $this;
		}

		/**
		 * Close the current scope context.
		 *
		 * @return $this
		 *
		 * @example
		 * $css->stop_scope();
		 */
		public function stop_scope(): self
		{
			return $this->start_scope(null);
		}

		/**
		 * Internal method to compile and append scoped CSS rules to the output buffer.
		 *
		 * @return void
		 * @internal
		 */
		protected function add_scope_rules_to_output(): void
		{
			if (!empty($this->_scope_output)) {
				$this->_output .= "{$this->_scope} { {$this->_scope_output} }";
				$this->_scope_output = '';
			}
		}

		/**
		 * Internal method to compile and append media query rules to the output buffer.
		 *
		 * @return $this
		 * @internal
		 */
		protected function add_media_query_rules_to_output(): self
		{
			if (!empty($this->_media_query_output)) {
				$this->_output .= "@media {$this->_media_query} { {$this->_media_query_output} }";
				$this->_media_query_output = '';
			}
			return $this;
		}

		/**
		 * Internal method to finalize CSS rules for the current selector.
		 *
		 * Applies current rules into the appropriate output bucket
		 * (scope, media query, or global).
		 *
		 * @return $this
		 * @internal
		 */
		protected function add_selector_rules_to_output(): self
		{
			if (!empty($this->_css)) {
				$selector_output = ($this->_selector === 'rawout')
					? $this->_css
					: "{$this->_selector} { {$this->_css} }";

				if (!empty($this->_media_query)) {
					$this->_media_query_output .= $selector_output;
				} elseif (!empty($this->_scope)) {
					$this->_scope_output .= $selector_output;
				} else {
					$this->_output .= $selector_output;
				}

				$this->_css = '';
			}

			return $this;
		}

		/**
		 * Generate final CSS output.
		 *
		 * Closes any open scopes or media queries before returning.
		 *
		 * @return string Compiled CSS
		 *
		 * @example
		 * echo $css->css_output();
		 */
		public function css_output(): string
		{
			$this->add_selector_rules_to_output();
			$this->add_media_query_rules_to_output();
			$this->add_scope_rules_to_output();
			return $this->_output;
		}
	}
}
