<?php
/**
 * @package xerx
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="section-intro">
				<?php
				the_archive_title( '<h1 class="page-title section-intro__heading">', '</h1>' );
				the_archive_description( '<div class="section-intro__desc">', '</div>' );
				?>
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
	</div>

<?php
get_footer();
