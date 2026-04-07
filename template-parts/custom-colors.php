<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xerx
 */

?>

<?php
$custom_fg = sanitize_hex_color( get_post_meta( get_the_ID(), 'fg_color', true ) );
$custom_bg = sanitize_hex_color( get_post_meta( get_the_ID(), 'bg_color', true ) );

if ( $custom_fg || $custom_bg ) :
	?>
	<style media="screen">
	:root {
		<?php
		if ( $custom_fg ) :
			?>
		--ink: <?php echo esc_attr( $custom_fg ); ?> !important;
		<?php endif; ?>
		<?php
		if ( $custom_bg ) :
			?>
		--surface: <?php echo esc_attr( $custom_bg ); ?> !important;
		<?php endif; ?>
	}
	<?php
	if ( $custom_bg ) :
		?>
	body.custom-background {
		background-color: <?php echo esc_attr( $custom_bg ); ?>;
	}
	<?php endif; ?>
	</style>
<?php endif; ?>
