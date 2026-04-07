<?php
/**
 * @package xerx
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() . '/site.webmanifest' ); ?>">

	<?php if ( get_theme_mod( 'enable_darkmode' ) === '1' ) : ?>
	<script>
	(function(){try{var t=localStorage.getItem('xerx-pref'),p=window.matchMedia&&window.matchMedia('(prefers-color-scheme:dark)').matches;if(t==='dark'||(t===null&&p)){document.documentElement.classList.add('dark-mode');}else if(t==='light'){document.documentElement.classList.add('light-mode');}}catch(e){}}());
	</script>
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="page-shell">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'xerx' ); ?></a>

	<?php
	$banner_img = get_header_image();

	if ( is_front_page() && is_home() ) :
	?>
	<header
		role="banner"
		class="banner"
		<?php if ( $banner_img ) : ?>
			style="background-image: url('<?php echo esc_url( $banner_img ); ?>')"
		<?php endif; ?>
	>
		<div class="banner__inner">
			<div class="banner__identity">
				<?php the_custom_logo(); ?>
				<h1 class="banner__title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
			</div>

			<?php
			$site_tagline = get_bloginfo( 'description', 'display' );
			if ( $site_tagline || is_customize_preview() ) :
			?>
				<p class="banner__tagline"><?php echo esc_html( $site_tagline ); ?></p>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-intro' ) ) : ?>
				<div class="banner__intro">
					<?php dynamic_sidebar( 'sidebar-intro' ); ?>
				</div>
			<?php endif; ?>

			<button
				class="nav-switch"
				id="menu-toggle"
				aria-controls="site-navigation"
				aria-expanded="false"
				aria-label="<?php esc_attr_e( 'Toggle menu', 'xerx' ); ?>"
				type="button"
			>
				<span class="nav-switch__bars" aria-hidden="true">
					<span></span><span></span><span></span>
				</span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'xerx' ); ?></span>
			</button>

			<nav id="site-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'xerx' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header-menu',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'nav-menu',
						'depth'          => 2,
					)
				);
				?>
			</nav>
		</div>
	</header>

	<?php else : ?>

	<header class="navbar" role="banner">
		<h1 class="navbar__title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<?php
			$site_tagline = get_bloginfo( 'description', 'display' );
			if ( $site_tagline || is_customize_preview() ) :
			?>
				<span class="navbar__tagline">&mdash; <?php echo esc_html( $site_tagline ); ?></span>
			<?php endif; ?>
		</h1>

		<button
			class="nav-switch"
			id="menu-toggle"
			aria-controls="site-navigation"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Toggle menu', 'xerx' ); ?>"
			type="button"
		>
			<span class="nav-switch__bars" aria-hidden="true">
				<span></span><span></span><span></span>
			</span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'xerx' ); ?></span>
		</button>

		<nav id="site-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'xerx' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'header-menu',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'nav-menu nav-menu--inline',
					'depth'          => 2,
				)
			);
			?>
		</nav>
	</header>

	<?php endif; ?>

	<div id="content" class="main-wrap" role="main">
