<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xerx
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'showcase-card' ); ?>>
	<?php xerx_featured_image(); ?>
	<?php the_title( '<h1 class="showcase-card__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h1>' ); ?>
	<div class="showcase-card__desc"><?php echo wp_kses_post( get_the_excerpt() ); ?></div>
</article>
