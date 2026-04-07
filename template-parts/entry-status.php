<?php
/**
 * Template part for displaying status posts
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
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry__title entry__title--note e-content">', '</h1>' );
		else :
			the_title( '<h2 class="entry__title entry__title--note e-content"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
</article>
