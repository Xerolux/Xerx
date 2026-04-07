<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package xerx
 */

function xerx_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( ! is_active_sidebar( 'sidebar-footer' ) && ! is_active_sidebar( 'sidebar-intro' ) ) {
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'xerx_body_classes' );

function xerx_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'xerx_pingback_header' );

function xerx_detect_format() {
	$format = get_post_format();
	if ( $format ) {
		return $format;
	}

	if ( has_post_thumbnail() && get_the_title() === '' ) {
		return 'image';
	}

	$body = get_the_content();
	$head = get_the_title();

	if ( '' === $body && '' !== $head ) {
		return 'status';
	}

	if ( '' !== $body && '' === $head ) {
		return 'aside';
	}

	return get_post_type();
}

function xerx_archive_title( $title ) {
	if ( is_rtl() ) {
		return $title;
	}

	$title_parts = explode( ': ', $title, 2 );

	if ( ! empty( $title_parts[1] ) ) {
		$title = wp_kses(
			$title_parts[1],
			array(
				'span' => array(
					'class' => array(),
				),
			)
		);
		$title = '<span class="section-intro__label">' . esc_html( $title_parts[0] ) . '</span>' . $title;
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'xerx_archive_title' );

function xerx_more_posts() {
	if ( ! is_single() ) {
		return;
	}

	$categories = get_the_category( get_the_ID() );
	if ( empty( $categories ) ) {
		return;
	}

	$category_ids = wp_list_pluck( $categories, 'term_id' );

	$related = new WP_Query(
		array(
			'category__in'        => $category_ids,
			'post__not_in'        => array( get_the_ID() ),
			'posts_per_page'      => 3,
			'orderby'             => 'rand',
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
		)
	);

	if ( ! $related->have_posts() ) {
		return;
	}
	?>
	<section class="also-read" aria-labelledby="related-posts-title">
		<h2 class="also-read__heading" id="related-posts-title">
			<?php esc_html_e( 'Related Posts', 'xerx' ); ?>
		</h2>
		<ul class="also-read__items">
			<?php
			while ( $related->have_posts() ) :
				$related->the_post();
				?>
				<li class="also-read__card">
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="also-read__thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
							<?php the_post_thumbnail( 'thumbnail', array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
						</a>
					<?php endif; ?>
					<div class="also-read__info">
						<a class="also-read__link" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
						<span class="also-read__date"><?php the_date(); ?></span>
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
	</section>
	<?php
	wp_reset_postdata();
}
