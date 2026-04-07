<?php
// phpcs:ignoreFile Squiz.Commenting.FileComment.Missing
/**
 * Dark mode support.
 *
 * @package xerx
 */

function xerx_load_dark_mode() {
	if ( get_theme_mod( 'enable_darkmode' ) !== '1' ) {
		return;
	}

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'xerx-dark-mode', get_template_directory_uri() . '/js/dark-mode.js', array(), $theme_version, true );
	wp_localize_script(
		'xerx-dark-mode',
		'xerxTheme',
		array(
			'enabled' => true,
		)
	);
}
add_action( 'wp_enqueue_scripts', 'xerx_load_dark_mode' );

function xerx_render_theme_switch() {
	if ( get_theme_mod( 'enable_darkmode' ) !== '1' ) {
		return;
	}
	?>
	<button
		id="theme-switch"
		class="theme-switch"
		aria-label="<?php esc_attr_e( 'Toggle dark mode', 'xerx' ); ?>"
		aria-pressed="false"
		type="button"
	>
		<svg class="ico-sun" width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" focusable="false">
			<path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
		</svg>
		<svg class="ico-moon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" focusable="false">
			<path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
		</svg>
	</button>
	<?php
}
add_action( 'wp_footer', 'xerx_render_theme_switch' );
