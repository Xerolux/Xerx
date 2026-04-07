<?php
/**
 * @package xerx
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="section-intro">
				<h1 class="page-title section-intro__heading">
					<span class="section-intro__label">
						<?php esc_html_e( 'Search Results for', 'xerx' ); ?>
					</span>
					<?php echo esc_html( get_search_query() ); ?>
				</h1>
			</header>

			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/entry', xerx_detect_format() );
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/entry', 'none' );

		endif;
		?>

		</main>
	</section>

<?php
get_footer();
