<?php
/**
 * Xerx functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package xerx
 */

if ( ! function_exists( 'xerx_setup' ) ) :
	function xerx_setup() {
		load_theme_textdomain( 'xerx', get_template_directory() . '/languages' );

		add_theme_support( 'editor-styles' );
		add_editor_style( 'editor-style.css' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
		add_theme_support( 'post-formats', array( 'aside', 'image', 'status', 'chat' ) );
		add_theme_support( 'appearance-tools' );
		add_theme_support( 'border' );
		add_theme_support( 'link-color' );
		add_theme_support( 'block-template-parts' );

		add_theme_support(
			'custom-background',
			array( 'default-color' => 'ffffff' )
		);

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 100,
				'flex-width'  => true,
				'flex-height' => false,
			)
		);

		add_theme_support(
			'editor-color-palette',
			array(
				array( 'name' => esc_html__( 'Brick',      'xerx' ), 'slug' => 'brick',      'color' => '#825A58' ),
				array( 'name' => esc_html__( 'Baby Pink',  'xerx' ), 'slug' => 'baby-pink',  'color' => '#E0BAC0' ),
				array( 'name' => esc_html__( 'Ecru',       'xerx' ), 'slug' => 'ecru',       'color' => '#E1D9D3' ),
				array( 'name' => esc_html__( 'Peach',      'xerx' ), 'slug' => 'peach',      'color' => '#E6AA88' ),
				array( 'name' => esc_html__( 'Sky Blue',   'xerx' ), 'slug' => 'sky-blue',   'color' => '#BADCE0' ),
				array( 'name' => esc_html__( 'Green',      'xerx' ), 'slug' => 'green',      'color' => '#81AE8A' ),
				array( 'name' => esc_html__( 'Olive',      'xerx' ), 'slug' => 'olive',      'color' => '#959686' ),
				array( 'name' => esc_html__( 'Dark Green', 'xerx' ), 'slug' => 'dark-green', 'color' => '#113118' ),
				array( 'name' => esc_html__( 'Dark Blue',  'xerx' ), 'slug' => 'dark-blue',  'color' => '#283D5D' ),
				array( 'name' => esc_html__( 'Light Gray', 'xerx' ), 'slug' => 'light-gray', 'color' => '#eaeaea' ),
				array( 'name' => esc_html__( 'Dark Gray',  'xerx' ), 'slug' => 'dark-gray',  'color' => '#222222' ),
			)
		);

		add_theme_support(
			'editor-font-sizes',
			array(
				array( 'name' => esc_html__( 'Small',    'xerx' ), 'slug' => 'small',    'size' => 14 ),
				array( 'name' => esc_html__( 'Medium',   'xerx' ), 'slug' => 'medium',   'size' => 16 ),
				array( 'name' => esc_html__( 'Large',    'xerx' ), 'slug' => 'large',    'size' => 18 ),
				array( 'name' => esc_html__( 'X-Large',  'xerx' ), 'slug' => 'x-large',  'size' => 24 ),
				array( 'name' => esc_html__( 'XX-Large', 'xerx' ), 'slug' => 'xx-large', 'size' => 32 ),
			)
		);

		register_nav_menus(
			array(
				'header-menu' => esc_html__( 'Primary', 'xerx' ),
				'footer-menu' => esc_html__( 'Footer', 'xerx' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'xerx_setup' );

if ( ! function_exists( 'xerx_init' ) ) :
	function xerx_init() {
		remove_filter( 'the_content', array( 'Syn_Config', 'the_content' ), 30 );
	}
endif;
add_action( 'init', 'xerx_init' );

function xerx_content_width() {
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'xerx_content_width', 640 );
}
add_action( 'after_setup_theme', 'xerx_content_width', 0 );

function xerx_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'xerx' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Widgets for the footer section.', 'xerx' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Intro', 'xerx' ),
			'id'            => 'sidebar-intro',
			'description'   => esc_html__( 'Widgets for the intro section.', 'xerx' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'xerx_widgets_init' );

function xerx_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	$google_fonts  = xerx_get_font_url();

	wp_enqueue_style( 'xerx-style', get_stylesheet_uri(), array(), $theme_version );

	if ( $google_fonts ) {
		wp_enqueue_style( 'xerx-google-fonts', $google_fonts, array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	}

	wp_enqueue_script( 'xerx-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), $theme_version, true );
	wp_enqueue_script( 'xerx-nav', get_template_directory_uri() . '/js/nav.js', array(), $theme_version, true );
	wp_enqueue_script( 'xerx-ui', get_template_directory_uri() . '/js/ui.js', array(), $theme_version, true );
	wp_localize_script(
		'xerx-ui',
		'xerxUi',
		array(
			'copied' => __( 'Link copied!', 'xerx' ),
		)
	);

	if ( ! is_singular() ) {
		wp_enqueue_script( 'xerx-reveal', get_template_directory_uri() . '/js/scroll.js', array( 'jquery' ), $theme_version, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'xerx_scripts' );

function xerx_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type && xerx_get_font_url() ) {
		$urls[] = array(
			'href'        => 'https://fonts.googleapis.com',
			'crossorigin' => '',
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => '',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'xerx_resource_hints', 10, 2 );

function xerx_lazy_thumbnail_attrs( $attr ) {
	$attr['loading']  = 'lazy';
	$attr['decoding'] = 'async';
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'xerx_lazy_thumbnail_attrs' );

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound,WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound,Squiz.Commenting.FunctionComment.Missing
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
// phpcs:enable

function xerx_get_font_url() {
	if ( get_theme_mod( 'load_remote_fonts', '1' ) !== '1' ) {
		return '';
	}

	$cached = get_transient( 'xerx_google_fonts_url' );
	if ( false !== $cached ) {
		return $cached;
	}

	$body_font     = str_replace( ' ', '+', sanitize_text_field( get_theme_mod( 'body_font',     'IBM Plex Serif' ) ) ) . ':ital,wght@0,400;0,700;1,300;1,400';
	$body_alt_font = str_replace( ' ', '+', sanitize_text_field( get_theme_mod( 'body_alt_font', 'IBM Plex Sans' ) ) ) . ':ital,wght@0,100;0,400;0,700;1,300;1,400';
	$heading_font  = str_replace( ' ', '+', sanitize_text_field( get_theme_mod( 'heading_font',  'IBM Plex Sans Condensed' ) ) ) . ':wght@700';
	$mono_font     = str_replace( ' ', '+', sanitize_text_field( get_theme_mod( 'mono_font',     'IBM Plex Mono' ) ) ) . ':wght@400';

	$url = esc_url_raw(
		'https://fonts.googleapis.com/css2?family=' .
		$mono_font . '&family=' .
		$heading_font . '&family=' .
		$body_font . '&family=' .
		$body_alt_font . '&display=swap'
	);

	set_transient( 'xerx_google_fonts_url', $url, HOUR_IN_SECONDS );

	return $url;
}

function xerx_flush_font_cache() {
	delete_transient( 'xerx_google_fonts_url' );
}
add_action( 'customize_save_after', 'xerx_flush_font_cache' );

require get_template_directory() . '/inc/custom-header.php';

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/customizer.php';

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/dark-mode.php';

require get_template_directory() . '/inc/block-patterns.php';

require get_template_directory() . '/inc/seo.php';
