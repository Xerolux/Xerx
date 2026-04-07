<?php
/**
 * Implementation of the Custom Header feature
 *
 * @package xerx
 */

function xerx_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'xerx_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'flex-width'         => true,
				'flex-height'        => true,
				'wp-head-callback'   => 'xerx_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'xerx_custom_header_setup' );

if ( ! function_exists( 'xerx_header_style' ) ) :
	function xerx_header_style() {
		$header_text_color = get_header_textcolor();

		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}
		?>
		<style type="text/css">
		<?php
		if ( ! display_header_text() ) :
			?>
			.banner__title,
			.banner__tagline,
			.navbar__title,
			.navbar__tagline {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			<?php
			else :
				?>
			.banner__title a,
			.banner__tagline,
			.navbar__title a,
			.navbar__tagline {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
