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
	<link rel="preconnect" href="https://rsms.me/">
	<link rel="stylesheet" href="https://rsms.me/inter/inter.css">

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

	<?php if ( has_nav_menu( 'top-bar-menu' ) ) : ?>
		<div class="site-top-bar" role="navigation" aria-label="<?php esc_attr_e( 'Top Bar Navigation', 'xerx' ); ?>">
			<div class="site-top-bar__inner">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'top-bar-menu',
						'menu_id'        => 'top-bar-menu',
						'menu_class'     => 'top-bar-nav',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</div>
		</div>
	<?php endif; ?>

	<header class="site-header" role="banner">
		<div class="site-header__inner">
			<a class="site-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				}
				?>
				<span><?php bloginfo( 'name' ); ?></span>
				<?php
				$site_tagline = get_bloginfo( 'description', 'display' );
				if ( $site_tagline || is_customize_preview() ) :
				?>
					<span class="site-header__tagline">&mdash; <?php echo esc_html( $site_tagline ); ?></span>
				<?php endif; ?>
			</a>

			<nav class="site-header__nav" id="site-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'xerx' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header-menu',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'nav-menu',
						'depth'          => 2,
						'fallback_cb'    => false,
					)
				);
				?>

				<?php do_action( 'xerx_header_actions' ); ?>

				<button
					class="header-search-toggle"
					id="search-toggle"
					aria-label="<?php esc_attr_e( 'Search', 'xerx' ); ?>"
					type="button"
				>
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<circle cx="11" cy="11" r="8"/>
						<line x1="21" y1="21" x2="16.65" y2="16.65"/>
					</svg>
				</button>
			</nav>

			<button
				class="nav-switch"
				id="menu-toggle"
				aria-controls="mobile-drawer"
				aria-expanded="false"
				aria-label="<?php esc_attr_e( 'Toggle menu', 'xerx' ); ?>"
				type="button"
			>
				<span class="nav-switch__bars" aria-hidden="true">
					<span></span><span></span><span></span>
				</span>
			</button>
		</div>
	</header>

	<!-- Search overlay (Cmd/Ctrl + K) -->
	<div class="search-overlay" id="search-overlay" role="dialog" aria-label="<?php esc_attr_e( 'Search', 'xerx' ); ?>">
		<form class="search-overlay__box" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input
				class="search-overlay__input"
				type="search"
				name="s"
				placeholder="<?php esc_attr_e( 'Search articles, topics, tags\u2026', 'xerx' ); ?>"
				autocomplete="off"
				value="<?php echo get_search_query(); ?>"
			>
			<div class="search-overlay__hint">
				<kbd class="search-overlay__kbd">Esc</kbd>
				<span><?php esc_html_e( 'to close', 'xerx' ); ?></span>
				<span style="margin-left: auto;"></span>
				<kbd class="search-overlay__kbd"><?php echo esc_html( 'Ctrl' ); ?>+K</kbd>
				<span><?php esc_html_e( 'to search', 'xerx' ); ?></span>
			</div>
		</form>
	</div>

	<!-- Mobile drawer -->
	<div class="mobile-drawer-backdrop" id="mobile-backdrop"></div>
	<aside class="mobile-drawer" id="mobile-drawer" aria-label="<?php esc_attr_e( 'Mobile menu', 'xerx' ); ?>">
		<div class="mobile-drawer__header">
			<strong><?php bloginfo( 'name' ); ?></strong>
			<button class="mobile-drawer__close" id="mobile-close" aria-label="<?php esc_attr_e( 'Close menu', 'xerx' ); ?>" type="button">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
					<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
				</svg>
			</button>
		</div>
		<div class="mobile-drawer__search">
			<?php get_search_form(); ?>
		</div>
		<div class="mobile-drawer__body">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'header-menu',
					'menu_class'     => 'nav-menu',
					'depth'          => 2,
					'fallback_cb'    => false,
				)
			);
			?>
		</div>
	</aside>

	<?php if ( is_front_page() && is_home() ) : ?>
	<?php
	$banner_img = get_header_image();
	?>
	<div
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
			$site_tagline_banner = get_bloginfo( 'description', 'display' );
			if ( $site_tagline_banner || is_customize_preview() ) :
			?>
				<p class="banner__tagline"><?php echo esc_html( $site_tagline_banner ); ?></p>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-intro' ) ) : ?>
				<div class="banner__intro">
					<?php dynamic_sidebar( 'sidebar-intro' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>

	<div id="content" class="main-wrap" role="main">
