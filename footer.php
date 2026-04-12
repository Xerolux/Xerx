<?php
/**
 * @package xerx
 */
?>
	</div>

	<footer id="colophon" class="colophon" role="contentinfo">

		<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
			<nav class="colophon__links" aria-label="<?php esc_attr_e( 'Footer navigation', 'xerx' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu',
						'menu_id'        => 'footer-menu',
						'menu_class'     => 'nav-menu',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
			<div class="colophon__block">
				<?php dynamic_sidebar( 'sidebar-footer' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'show_colophon', '1' ) === '1' ) : ?>
			<div class="colophon__block colophon__credit">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				&mdash;
				<?php
				printf(
					esc_html__( 'Powered by %1$s', 'xerx' ),
					'<a href="https://wordpress.org" rel="nofollow noopener">WordPress</a>'
				);
				?>
			</div>
		<?php endif; ?>

	</footer>

	<button
		class="scroll-top"
		id="back-to-top"
		aria-label="<?php esc_attr_e( 'Back to top', 'xerx' ); ?>"
		type="button"
		hidden
	>
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false">
			<path d="M18 15l-6-6-6 6"/>
		</svg>
	</button>

</div>

<?php wp_footer(); ?>

</body>
</html>
