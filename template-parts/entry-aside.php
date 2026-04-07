<?php
/**
 * Template part for displaying aside posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package xerx
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry h-entry' ); ?>>
	<div class="entry__meta">
		<?php
		xerx_post_date();
		xerx_read_time();
		xerx_post_footer();
		?>
	</div>
	<?php if ( is_singular() ) : ?>
		<div class="entry__share"><?php xerx_share_links(); ?></div>
	<?php endif; ?>

	<div class="entry__body entry__body--aside e-content">
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
