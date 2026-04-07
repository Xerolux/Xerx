<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xerx
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry--wide' ); ?>>
	<?php the_title( '<h1 class="entry__title">', '</h1>' ); ?>

	<div class="entry__body">
		<?php
		the_content();
		?>
		<div class="wp-block-spacer" aria-hidden="true"></div>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'xerx' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>
