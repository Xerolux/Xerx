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

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="page-shell">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'xerx' ); ?></a>

	<header class="navbar--showcase" role="banner">
		<h1 class="navbar__title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<?php
			$site_tagline = get_bloginfo( 'description', 'display' );
			if ( $site_tagline || is_customize_preview() ) :
			?>
				<span class="navbar__tagline">&mdash; <?php echo esc_html( $site_tagline ); ?></span>
			<?php endif; ?>
		</h1>
		<nav role="navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'header-menu',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'nav-menu nav-menu--inline nav-menu--showcase',
					'depth'          => 2,
				)
			);
			?>
		</nav>
	</header>

	<div id="content" class="main-wrap" role="main">
