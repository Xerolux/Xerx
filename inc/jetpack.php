<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package xerx
 */

function xerx_jetpack_setup() {
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'main',
			'render'    => 'xerx_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	add_theme_support( 'jetpack-responsive-videos' );

	add_theme_support(
		'jetpack-content-options',
		array(
			'post-details'    => array(
				'stylesheet' => 'xerx-style',
				'date'       => '.meta-date',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
			'featured-images' => array(
				'archive' => true,
				'post'    => true,
				'page'    => true,
			),
		)
	);
}
add_action( 'after_setup_theme', 'xerx_jetpack_setup' );

function xerx_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/entry', 'search' );
		else :
			get_template_part( 'template-parts/entry', xerx_detect_format() );
		endif;
	}
}
