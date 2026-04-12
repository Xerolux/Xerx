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
	<div class="entry__meta">
		<?php if ( 'post' === get_post_type() ) : ?>
			<?php
			xerx_post_date();
			xerx_read_time();
			xerx_post_footer();
			?>
		<?php else : ?>
			<span class="meta-type"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></span>
		<?php endif; ?>
	</div>

	<?php the_title( sprintf( '<h2 class="entry__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php xerx_featured_image(); ?>

	<div class="entry__body">
		<?php the_excerpt(); ?>
	</div>
</article>
