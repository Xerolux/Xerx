<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xerx
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry h-entry' ); ?>>
	<?php
	if ( is_singular() ) {
		the_title( '<h1 class="entry__title entry__title--hero p-name">', '</h1>' );
	} else {
		the_title( '<h2 class="entry__title p-name"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}
	?>

	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry__meta">
			<?php
			xerx_post_date();
			xerx_read_time();
			xerx_post_author();
			xerx_post_footer();
			?>
		</div>
		<?php if ( is_singular() ) : ?>
			<div class="entry__share">
				<?php xerx_share_links(); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php xerx_featured_image(); ?>

	<div class="entry__body e-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'xerx' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'xerx' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>
