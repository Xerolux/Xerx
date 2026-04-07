<?php
// phpcs:ignoreFile Squiz.Commenting.FileComment.Missing
/**
 * SEO enhancements.
 *
 * @package xerx
 */

function xerx_has_seo_plugin() {
	return defined( 'WPSEO_VERSION' )
		|| defined( 'RANK_MATH_VERSION' )
		|| class_exists( 'All_in_One_SEO_Pack' )
		|| defined( 'SEOPRESS_VERSION' );
}

function xerx_output_canonical() {
	if ( xerx_has_seo_plugin() ) {
		return;
	}

	if ( is_singular() ) {
		?>
		<link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>">
		<?php
	}
}
add_action( 'wp_head', 'xerx_output_canonical', 1 );

function xerx_noindex_thin() {
	if ( is_search() || is_404() ) {
		?>
		<meta name="robots" content="noindex, nofollow">
		<?php
	}
}
add_action( 'wp_head', 'xerx_noindex_thin', 1 );

function xerx_output_site_schema() {
	if ( xerx_has_seo_plugin() ) {
		return;
	}

	$schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'WebSite',
		'name'            => get_bloginfo( 'name' ),
		'url'             => home_url( '/' ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'       => 'EntryPoint',
				'urlTemplate' => home_url( '/?s={search_term_string}' ),
			),
			'query-input' => 'required name=search_term_string',
		),
	);
	?>
	<script type="application/ld+json"><?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
	<?php
}
add_action( 'wp_head', 'xerx_output_site_schema', 4 );

function xerx_output_seo() {
	if ( xerx_has_seo_plugin() ) {
		return;
	}

	$type           = 'website';
	$title          = get_bloginfo( 'name' );
	$description    = get_bloginfo( 'description' );
	$url            = home_url( '/' );
	$image          = null;
	$published_time = null;
	$modified_time  = null;
	$author         = null;

	if ( is_singular() ) {
		$type           = is_front_page() ? 'website' : 'article';
		$title          = get_the_title();
		$description    = get_the_excerpt() ? wp_trim_words( get_the_excerpt(), 30 ) : get_bloginfo( 'description' );
		$image          = get_the_post_thumbnail_url( get_the_ID(), 'large' );
		$url            = get_permalink();
		$published_time = get_the_date( 'c' );
		$modified_time  = get_the_modified_date( 'c' );
		$author         = get_the_author_meta( 'display_name', (int) get_post_field( 'post_author', get_the_ID() ) );
	}

	if ( is_archive() ) {
		$title = post_type_archive_title( '', false ) . ' — ' . get_bloginfo( 'name' );
	}

	if ( is_search() ) {
		$title = sprintf(
			/* translators: %s: Search query. */
			__( 'Search Results for: %s', 'xerx' ),
			get_search_query()
		) . ' — ' . get_bloginfo( 'name' );
	}

	?>
	<meta name="description" content="<?php echo esc_attr( $description ); ?>">

	<?php if ( $image ) : ?>
	<meta property="og:image" content="<?php echo esc_url( $image ); ?>">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta name="twitter:image" content="<?php echo esc_url( $image ); ?>">
	<?php endif; ?>

	<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $url ); ?>">
	<meta property="og:type" content="<?php echo esc_attr( $type ); ?>">
	<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	<meta property="og:locale" content="<?php echo esc_attr( str_replace( '-', '_', get_locale() ) ); ?>">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">

	<?php
	$schema_data = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'article' === $type ? 'BlogPosting' : 'WebPage',
		'name'        => $title,
		'description' => $description,
		'url'         => $url,
	);

	if ( $published_time ) {
		$schema_data['datePublished'] = $published_time;
	}

	if ( $modified_time ) {
		$schema_data['dateModified'] = $modified_time;
	}

	$schema_data['publisher'] = array(
		'@type' => 'Organization',
		'name'  => get_bloginfo( 'name' ),
		'url'   => home_url( '/' ),
	);

	if ( $author ) {
		$schema_data['author'] = array(
			'@type' => 'Person',
			'name'  => $author,
		);
	}

	if ( $image ) {
		$schema_data['image'] = array(
			'@type' => 'ImageObject',
			'url'   => $image,
		);
	}
	?>
	<script type="application/ld+json"><?php echo wp_json_encode( $schema_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
	<?php
}
add_action( 'wp_head', 'xerx_output_seo', 5 );

function xerx_output_trail_schema() {
	if ( xerx_has_seo_plugin() ) {
		return;
	}

	if ( ! is_singular() ) {
		return;
	}

	$items = array(
		array(
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => get_bloginfo( 'name' ),
			'item'     => home_url( '/' ),
		),
	);

	if ( ! is_front_page() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => get_the_title(),
			'item'     => get_permalink(),
		);
	}

	$schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	);
	?>
	<script type="application/ld+json"><?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
	<?php
}
add_action( 'wp_head', 'xerx_output_trail_schema', 6 );
