<?php
/**
 * Register custom block patterns.
 *
 * @package xerx
 */
function xerx_register_block_patterns() {
	register_block_pattern_category(
		'xerx',
		array( 'label' => __( 'Xerx', 'xerx' ) )
	);

	register_block_pattern(
		'xerx/hero-with-call-to-action',
		array(
			'title'       => __( 'Hero with Call to Action', 'xerx' ),
			'description' => _x( 'A large hero section with a heading, description, and button.', 'Block pattern description', 'xerx' ),
			'content'     => '<!-- wp:group {"align":"full","style":{"color":{"text":"#000000"},"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"ecru","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-text-color has-background has-ecru-background-color" style="color:#000000;padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Welcome to Xerx</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem"}}} -->
<p style="font-size:1.5rem">A stream of your life. Capture your moments, thoughts, and experiences in beautiful simplicity.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"dark-green","textColor":"white"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-white-color has-dark-green-background-color has-text-color has-background">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
			'categories'  => array( 'xerx' ),
		)
	);

	register_block_pattern(
		'xerx/two-column-text',
		array(
			'title'       => __( 'Two Column Text', 'xerx' ),
			'description' => _x( 'Two columns of text content.', 'Block pattern description', 'xerx' ),
			'content'     => '<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">First Column</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Add your content here. This two-column layout is perfect for comparing ideas, presenting related information, or creating an engaging layout for your readers.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Second Column</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Add more content here. The columns will stack vertically on mobile devices for better readability and will appear side-by-side on larger screens.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
			'categories'  => array( 'xerx' ),
		)
	);

	register_block_pattern(
		'xerx/quote-with-attribution',
		array(
			'title'       => __( 'Quote with Attribution', 'xerx' ),
			'description' => _x( 'A styled quote block with author attribution.', 'Block pattern description', 'xerx' ),
			'content'     => '<!-- wp:quote {"style":{"elements":{"link":{"color":{"text":"var:preset|color|brick"}}},"color":{"text":"#825A58"}},"className":"is-style-large"} -->
<blockquote class="wp-block-quote is-style-large has-text-color" style="color:#825A58"><!-- wp:paragraph -->
<p>The only way to do great work is to love what you do.</p>
<!-- /wp:paragraph -->
<cite>— Author Name</cite></blockquote>
<!-- /wp:quote -->',
			'categories'  => array( 'xerx' ),
		)
	);

	register_block_pattern(
		'xerx/image-with-caption',
		array(
			'title'       => __( 'Image with Caption', 'xerx' ),
			'description' => _x( 'An image placeholder with a styled caption.', 'Block pattern description', 'xerx' ),
			'content'     => '<!-- wp:group {"align":"wide"} -->
<div class="wp-block-group alignwide"><!-- wp:image {"sizeSlug":"large","style":{"color":{"background":"#E1D9D3"}}} -->
<figure class="wp-block-image size-large"><img src="" alt="' . esc_attr__( 'Add your image', 'xerx' ) . '"/><figcaption class="wp-element-caption">' . esc_html__( 'Add your caption here', 'xerx' ) . '</figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->',
			'categories'  => array( 'xerx' ),
		)
	);

	register_block_pattern(
		'xerx/gallery-grid',
		array(
			'title'       => __( 'Gallery Grid', 'xerx' ),
			'description' => _x( 'A three-column image gallery grid.', 'Block pattern description', 'xerx' ),
			'content'     => '<!-- wp:gallery {"linkTo":"none","sizeSlug":"large","className":"columns-3"} -->
<figure class="wp-block-gallery has-nested-images columns-default is-cropped columns-3"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="" alt="' . esc_attr__( 'Gallery image 1', 'xerx' ) . '"/></figure>
<!-- /wp:image -->
<!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="" alt="' . esc_attr__( 'Gallery image 2', 'xerx' ) . '"/></figure>
<!-- /wp:image -->
<!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="" alt="' . esc_attr__( 'Gallery image 3', 'xerx' ) . '"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery -->',
			'categories'  => array( 'xerx' ),
		)
	);

	register_block_pattern(
		'xerx/text-with-highlight',
		array(
			'title'       => __( 'Text with Highlight Box', 'xerx' ),
			'description' => _x( 'A paragraph followed by a highlighted callout box.', 'Block pattern description', 'xerx' ),
			'content'     => '<!-- wp:paragraph -->
<p>Add your introductory text here. This pattern includes a highlighted callout box below to draw attention to key information.</p>
<!-- /wp:paragraph -->
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"left":{"color":"#825A58","width":"4px"}}},"backgroundColor":"baby-pink","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-baby-pink-background-color has-background" style="border-left-color:#825A58;border-left-width:4px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}}} -->
<p style="font-style:normal;font-weight:600">Key Takeaway: Add your most important point here for emphasis.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->',
			'categories'  => array( 'xerx' ),
		)
	);

	register_block_pattern(
		'xerx/simple-footer',
		array(
			'title'       => __( 'Simple Footer', 'xerx' ),
			'description' => _x( 'A simple footer with copyright and quick links.', 'Block pattern description', 'xerx' ),
			'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"backgroundColor":"dark-blue","textColor":"light-gray"} -->
<div class="wp-block-group alignfull has-light-gray-color has-dark-blue-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph -->
<p><strong>&copy; ' . gmdate( 'Y' ) . ' ' . esc_html( get_bloginfo( 'name' ) ) . '</strong></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>' . esc_html__( 'Proudly powered by WordPress.', 'xerx' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph -->
<p><strong>' . esc_html__( 'Quick Links', 'xerx' ) . '</strong></p>
<!-- /wp:paragraph --><!-- wp:navigation {"textColor":"light-gray"} -->
<!-- wp:navigation-link {"label":"' . esc_html__( 'Home', 'xerx' ) . '","url":"/"} /-->
<!-- wp:navigation-link {"label":"' . esc_html__( 'About', 'xerx' ) . '","url":"#"} /-->
<!-- wp:navigation-link {"label":"' . esc_html__( 'Contact', 'xerx' ) . '","url":"#"} /-->
<!-- /wp:navigation --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
			'categories'  => array( 'xerx', 'footer' ),
		)
	);
}
add_action( 'init', 'xerx_register_block_patterns' );
