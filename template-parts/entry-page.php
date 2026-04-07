<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xerx
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php the_title( '<h1 class="entry__title">', '</h1>' ); ?>

	<?php xerx_featured_image(); ?>

	<div class="entry__body">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'xerx' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>
