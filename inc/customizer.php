<?php
/**
 * Xerx Theme Customizer
 *
 * @package xerx
 */

function xerx_customize_register( $wp_customize ) {
	$post_message_settings = array(
		'blogname',
		'blogdescription',
		'header_textcolor',
		'header_image',
		'header_image_data',
	);

	foreach ( $post_message_settings as $setting_id ) {
		$setting = $wp_customize->get_setting( $setting_id );
		if ( $setting instanceof WP_Customize_Setting ) {
			$setting->transport = 'postMessage';
		}
	}

	$wp_customize->add_setting(
		'header_bgcolor',
		array(
			'default'           => '#f8f9fb',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_bgcolor',
			array(
				'label'    => __( 'Header Background Color', 'xerx' ),
				'section'  => 'colors',
				'settings' => 'header_bgcolor',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_setting(
		'fgcolor',
		array(
			'default'           => '#1a1a2e',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fgcolor',
			array(
				'label'    => __( 'Foreground Color', 'xerx' ),
				'section'  => 'colors',
				'settings' => 'fgcolor',
			)
		)
	);

	$wp_customize->add_setting(
		'button_color',
		array(
			'default'           => '#6366f1',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'button_color',
			array(
				'label'    => __( 'Primary Button Color', 'xerx' ),
				'section'  => 'colors',
				'settings' => 'button_color',
			)
		)
	);

	$wp_customize->add_setting(
		'link_color',
		array(
			'default'           => '#6366f1',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label'    => __( 'Link Color', 'xerx' ),
				'section'  => 'colors',
				'settings' => 'link_color',
			)
		)
	);

	$wp_customize->add_section(
		'dark_mode',
		array(
			'title'    => __( 'Dark Mode', 'xerx' ),
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'enable_darkmode',
		array(
			'default'           => '',
			'sanitize_callback' => 'xerx_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'enable_darkmode',
			array(
				'label'    => __( 'Enable dark mode', 'xerx' ),
				'section'  => 'dark_mode',
				'settings' => 'enable_darkmode',
				'type'     => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting(
		'dark_mode_background',
		array(
			'default'           => '#0f172a',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'dark_mode_background',
			array(
				'label'    => __( 'Dark mode background', 'xerx' ),
				'section'  => 'dark_mode',
				'settings' => 'dark_mode_background',
			)
		)
	);

	$wp_customize->add_setting(
		'dark_mode_text',
		array(
			'default'           => '#e2e8f0',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'dark_mode_text',
			array(
				'label'    => __( 'Dark mode text color', 'xerx' ),
				'section'  => 'dark_mode',
				'settings' => 'dark_mode_text',
			)
		)
	);

	$wp_customize->add_section(
		'spacing',
		array(
			'title'    => __( 'Spacing', 'xerx' ),
			'priority' => 85,
		)
	);

	$wp_customize->add_section(
		'layout_options',
		array(
			'title'    => __( 'Layout Options', 'xerx' ),
			'priority' => 88,
		)
	);

	$wp_customize->add_setting(
		'show_colophon',
		array(
			'default'           => '1',
			'sanitize_callback' => 'xerx_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'show_colophon',
			array(
				'label'       => __( 'Show footer colophon', 'xerx' ),
				'description' => __( 'Displays a small footer note with theme and WordPress attribution.', 'xerx' ),
				'section'     => 'layout_options',
				'settings'    => 'show_colophon',
				'type'        => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting(
		'show_comment_avatars',
		array(
			'default'           => '1',
			'sanitize_callback' => 'xerx_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'show_comment_avatars',
			array(
				'label'       => __( 'Show comment avatars', 'xerx' ),
				'description' => __( 'Displays commenter avatars in the comments list.', 'xerx' ),
				'section'     => 'layout_options',
				'settings'    => 'show_comment_avatars',
				'type'        => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting(
		'content_width',
		array(
			'default'           => '720',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'content_width',
			array(
				'type'        => 'number',
				'label'       => __( 'Content Width (px)', 'xerx' ),
				'description' => __( 'Maximum width of the main content area.', 'xerx' ),
				'section'     => 'spacing',
				'settings'    => 'content_width',
				'input_attrs' => array(
					'min'  => 400,
					'max'  => 1200,
					'step' => 10,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'line_height',
		array(
			'default'           => '1.7',
			'sanitize_callback' => 'xerx_sanitize_float',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'line_height',
			array(
				'type'        => 'number',
				'label'       => __( 'Line Height', 'xerx' ),
				'description' => __( 'Line height for body text.', 'xerx' ),
				'section'     => 'spacing',
				'settings'    => 'line_height',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 2.5,
					'step' => 0.1,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'font_size_base',
		array(
			'default'           => '16',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'font_size_base',
			array(
				'type'        => 'number',
				'label'       => __( 'Base Font Size (px)', 'xerx' ),
				'description' => __( 'Base font size for body text.', 'xerx' ),
				'section'     => 'spacing',
				'settings'    => 'font_size_base',
				'input_attrs' => array(
					'min'  => 14,
					'max'  => 24,
					'step' => 1,
				),
			)
		)
	);

	$wp_customize->add_section(
		'typography',
		array(
			'title'    => __( 'Typography', 'xerx' ),
			'priority' => 90,
		)
	);

	$wp_customize->add_setting(
		'load_remote_fonts',
		array(
			'default'           => '1',
			'sanitize_callback' => 'xerx_sanitize_checkbox',
		)
	);

	$wp_customize->add_setting(
		'google_font_display',
		array(
			'default'           => 'swap',
			'sanitize_callback' => 'xerx_sanitize_font_display',
		)
	);

	$wp_customize->add_control(
		'google_font_display',
		array(
			'type'        => 'select',
			'section'     => 'typography',
			'label'       => __( 'Google Fonts display strategy', 'xerx' ),
			'description' => __( 'Choose how remote fonts are rendered while loading. Optional is often best for performance.', 'xerx' ),
			'priority'    => 6,
			'choices'     => array(
				'swap'     => __( 'Swap', 'xerx' ),
				'optional' => __( 'Optional', 'xerx' ),
				'fallback' => __( 'Fallback', 'xerx' ),
				'block'    => __( 'Block', 'xerx' ),
			),
		)
	);

	$wp_customize->add_setting(
		'font_preconnect',
		array(
			'default'           => '1',
			'sanitize_callback' => 'xerx_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'font_preconnect',
		array(
			'type'        => 'checkbox',
			'section'     => 'typography',
			'label'       => __( 'Enable font preconnect hints', 'xerx' ),
			'description' => __( 'Adds preconnect hints for Google Fonts hosts to improve loading speed.', 'xerx' ),
			'priority'    => 7,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'load_remote_fonts',
			array(
				'label'       => __( 'Load remote Google Fonts', 'xerx' ),
				'description' => __( 'Disable this to use only local/system fallback fonts.', 'xerx' ),
				'section'     => 'typography',
				'settings'    => 'load_remote_fonts',
				'type'        => 'checkbox',
				'priority'    => 5,
			)
		)
	);

	$wp_customize->add_setting(
		'mono_font',
		array(
			'default'           => 'IBM Plex Mono',
			'transport'         => 'refresh',
			'sanitize_callback' => 'xerx_sanitize_font',
		)
	);

	$font_options = xerx_get_fonts();

	$font_controls = array(
		'mono_font'     => array(
			'label'   => __( 'Site title font (Mono)', 'xerx' ),
			'default' => 'IBM Plex Mono',
		),
		'heading_font'  => array(
			'label'   => __( 'Heading font (Condensed)', 'xerx' ),
			'default' => 'IBM Plex Sans Condensed',
		),
		'body_font'     => array(
			'label'   => __( 'Body font (Serif)', 'xerx' ),
			'default' => 'IBM Plex Serif',
		),
		'body_alt_font' => array(
			'label'   => __( 'Body font alternative (Sans-serif)', 'xerx' ),
			'default' => 'IBM Plex Sans',
		),
	);

	foreach ( $font_controls as $id => $meta ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $meta['default'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'xerx_sanitize_font',
			)
		);

		$choices_flat = array_combine( $font_options[ $id ], $font_options[ $id ] );

		$wp_customize->add_control(
			$id,
			array(
				'type'    => 'select',
				'section' => 'typography',
				'label'   => $meta['label'],
				'choices' => $choices_flat,
			)
		);
	}

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.banner__title a',
				'render_callback' => 'xerx_customize_partial_blogname',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.banner__tagline',
				'render_callback' => 'xerx_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'xerx_customize_register' );

function xerx_customize_partial_blogname() {
	bloginfo( 'name' );
}

function xerx_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function xerx_customize_preview_js() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_script( 'xerx-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), $theme_version, true );
}
add_action( 'customize_preview_init', 'xerx_customize_preview_js' );

function xerx_get_fonts() {
	return array(
		'mono_font'     => array( 'IBM Plex Mono', 'Space Mono', 'Source Code Pro', 'Fira Mono' ),
		'heading_font'  => array( 'IBM Plex Sans Condensed', 'Archivo Narrow', 'Barlow Condensed', 'Roboto Condensed' ),
		'body_font'     => array( 'IBM Plex Serif', 'Source Serif Pro', 'Merriweather', 'Lora' ),
		'body_alt_font' => array( 'IBM Plex Sans', 'Source Sans Pro', 'Poppins', 'Rubik' ),
	);
}

function xerx_shift_color( $hex, $steps ) {
	$steps = max( -255, min( 255, $steps ) );
	$hex   = str_replace( '#', '', $hex );

	if ( strlen( $hex ) === 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) .
				str_repeat( substr( $hex, 1, 1 ), 2 ) .
				str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	$parts = str_split( $hex, 2 );
	$color = array_map( 'hexdec', $parts );

	foreach ( $color as &$c ) {
		$c = max( 0, min( 255, $c + $steps ) );
	}

	return '#' . sprintf( '%02x%02x%02x', $color[0], $color[1], $color[2] );
}

function xerx_sanitize_checkbox( $input ) {
	if ( true === $input || '1' === $input ) {
		return '1';
	}
	return '';
}

function xerx_sanitize_float( $input ) {
	$value = filter_var( $input, FILTER_VALIDATE_FLOAT );

	if ( false === $value ) {
		return '1.7';
	}

	$value = max( 1, min( 2.5, $value ) );
	return (string) $value;
}

function xerx_sanitize_font_display( $input ) {
	$allowed = array( 'swap', 'optional', 'fallback', 'block' );
	if ( in_array( $input, $allowed, true ) ) {
		return $input;
	}
	return 'swap';
}

function xerx_sanitize_font( $input, $setting = null ) {
	$choices    = xerx_get_fonts();
	$setting_id = isset( $setting->id ) ? $setting->id : '';

	if ( isset( $choices[ $setting_id ] ) && in_array( $input, $choices[ $setting_id ], true ) ) {
		return $input;
	}

	return isset( $choices[ $setting_id ][0] ) ? $choices[ $setting_id ][0] : sanitize_text_field( $input );
}

function xerx_output_customizer_css() {
	$header_bg      = sanitize_hex_color( get_theme_mod( 'header_bgcolor', '#f8f9fb' ) ) ?: '#f8f9fb';
	$fg_color       = sanitize_hex_color( get_theme_mod( 'fgcolor', '#1a1a2e' ) ) ?: '#1a1a2e';
	$button_color   = sanitize_hex_color( get_theme_mod( 'button_color', '#6366f1' ) ) ?: '#6366f1';
	$link_color     = sanitize_hex_color( get_theme_mod( 'link_color', '#6366f1' ) ) ?: '#6366f1';
	$content_width  = min( 1200, max( 400, absint( get_theme_mod( 'content_width', 720 ) ) ) );
	$line_height    = xerx_sanitize_float( get_theme_mod( 'line_height', 1.7 ) );
	$font_size_base = min( 24, max( 14, absint( get_theme_mod( 'font_size_base', 16 ) ) ) );
	$mono_font      = xerx_sanitize_font( get_theme_mod( 'mono_font',     'IBM Plex Mono' ),             (object) array( 'id' => 'mono_font' ) );
	$heading_font   = xerx_sanitize_font( get_theme_mod( 'heading_font',  'IBM Plex Sans Condensed' ),   (object) array( 'id' => 'heading_font' ) );
	$body_font      = xerx_sanitize_font( get_theme_mod( 'body_font',     'IBM Plex Serif' ),            (object) array( 'id' => 'body_font' ) );
	$body_alt_font  = xerx_sanitize_font( get_theme_mod( 'body_alt_font', 'IBM Plex Sans' ),             (object) array( 'id' => 'body_alt_font' ) );
	?>
	<meta name="theme-color" content="<?php echo esc_attr( $header_bg ); ?>">
	<style media="screen">
		:root {
			--surface: <?php echo esc_attr( $header_bg ); ?>;
			--ink: <?php echo esc_attr( $fg_color ); ?>;
			--accent: <?php echo esc_attr( $link_color ); ?>;
			--btn-bg: <?php echo esc_attr( $button_color ); ?>;
			--measure: <?php echo esc_attr( $content_width ); ?>px;
			--measure-lg: <?php echo esc_attr( min( 1440, $content_width + 440 ) ); ?>px;
			--leading: <?php echo esc_attr( $line_height ); ?>;
			--type-size: <?php echo esc_attr( $font_size_base ); ?>px;
			--type-mono: "<?php echo esc_attr( $mono_font ); ?>", "JetBrains Mono", "Fira Code", "Consolas", monospace;
			--type-heading: "Inter", "<?php echo esc_attr( $heading_font ); ?>", -apple-system, sans-serif;
			--type-body: "Inter", "<?php echo esc_attr( $body_font ); ?>", -apple-system, sans-serif;
			--type-sans: "Inter", "<?php echo esc_attr( $body_alt_font ); ?>", -apple-system, sans-serif;
		}
		body { line-height: var(--leading); font-size: var(--type-size); }
		<?php if ( get_theme_mod( 'enable_darkmode' ) === '1' ) : ?>
		<?php
		$dark_bg   = sanitize_hex_color( get_theme_mod( 'dark_mode_background', '#0f172a' ) ) ?: '#0f172a';
		$dark_text = sanitize_hex_color( get_theme_mod( 'dark_mode_text', '#e2e8f0' ) ) ?: '#e2e8f0';
		?>
		:root.dark-mode {
			--surface: <?php echo esc_attr( $dark_bg ); ?>;
			--ink: <?php echo esc_attr( $dark_text ); ?>;
		}
		:root.dark-mode body.custom-background { background-color: var(--surface) !important; }
		@media (prefers-color-scheme: dark) {
			:root:not(.light-mode) {
				--surface: <?php echo esc_attr( $dark_bg ); ?>;
				--ink: <?php echo esc_attr( $dark_text ); ?>;
			}
			:root:not(.light-mode) body.custom-background { background-color: var(--surface) !important; }
		}
		<?php endif; ?>
	</style>
	<?php
}
add_action( 'wp_head', 'xerx_output_customizer_css' );

function xerx_output_editor_css() {
	$mono_font      = xerx_sanitize_font( get_theme_mod( 'mono_font', 'IBM Plex Mono' ), (object) array( 'id' => 'mono_font' ) );
	$heading_font   = xerx_sanitize_font( get_theme_mod( 'heading_font', 'IBM Plex Sans Condensed' ), (object) array( 'id' => 'heading_font' ) );
	$body_font      = xerx_sanitize_font( get_theme_mod( 'body_font', 'IBM Plex Serif' ), (object) array( 'id' => 'body_font' ) );
	$body_alt_font  = xerx_sanitize_font( get_theme_mod( 'body_alt_font', 'IBM Plex Sans' ), (object) array( 'id' => 'body_alt_font' ) );
	$header_bg      = sanitize_hex_color( get_theme_mod( 'header_bgcolor', '#fcfbf9' ) );
	$fg_color       = sanitize_hex_color( get_theme_mod( 'fgcolor', '#1d1d1b' ) );
	$content_width  = min( 1200, max( 400, absint( get_theme_mod( 'content_width', 680 ) ) ) );
	$line_height    = xerx_sanitize_float( get_theme_mod( 'line_height', 1.72 ) );
	$font_size_base = min( 24, max( 14, absint( get_theme_mod( 'font_size_base', 18 ) ) ) );
	$css            = '';
	$google_fonts   = xerx_get_font_url();

	if ( ! $header_bg ) {
		$header_bg = '#eaeaea';
	}

	if ( ! $fg_color ) {
		$fg_color = '#000000';
	}

	if ( $google_fonts ) {
		$theme_version = wp_get_theme()->get( 'Version' );
		wp_enqueue_style( 'xerx-editor-google-fonts', $google_fonts, array(), $theme_version );
	}

	$css .= ':root{' .
		'--surface:' . $header_bg . ';' .
		'--ink:' . $fg_color . ';' .
		'--measure:' . $content_width . 'px;' .
		'--measure-lg:' . min( 1440, $content_width + 440 ) . 'px;' .
		'--leading:' . esc_attr( $line_height ) . ';' .
		'--type-size:' . $font_size_base . 'px;' .
		'--type-mono:"' . esc_attr( $mono_font ) . '","Monaco","Consolas",monospace;' .
		'--type-heading:"' . esc_attr( $heading_font ) . '","Roboto Condensed","HelveticaNeue-CondensedBold","Tahoma",sans-serif;' .
		'--type-body:"' . esc_attr( $body_font ) . '","Garamond","Georgia",serif;' .
		'--type-sans:"' . esc_attr( $body_alt_font ) . '","Helvetica Neue","Helvetica","Nimbus Sans L","Arial",sans-serif;' .
		'}';

	$css .= '.editor-styles-wrapper{' .
		'color:var(--ink);' .
		'background:var(--surface);' .
		'font-family:var(--type-body);' .
		'font-size:var(--type-size);' .
		'line-height:var(--leading);' .
		'}';

	$css .= '.editor-styles-wrapper .editor-post-title__input,.editor-styles-wrapper h1,.editor-styles-wrapper h2,.editor-styles-wrapper h3,.editor-styles-wrapper h4,.editor-styles-wrapper h5,.editor-styles-wrapper h6{' .
		'font-family:var(--type-heading);' .
		'}';

	$css .= '.editor-styles-wrapper .wp-block{max-width:var(--measure);}';

	wp_add_inline_style( 'wp-edit-blocks', $css );
}
add_action( 'enqueue_block_editor_assets', 'xerx_output_editor_css' );
