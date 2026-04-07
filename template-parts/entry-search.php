<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xerx
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php the_title( sprintf( '<h2 class="entry__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php
	if ( 'post' === get_post_type() ) :
		?>
		<div class="entry__meta">
			<?php
			xerx_post_date();
			xerx_post_footer();
			?>
		</div>
	<?php endif; ?>

	<?php xerx_featured_image(); ?>

	<div class="entry__body">
		<?php the_excerpt(); ?>
	</div>
</article>
