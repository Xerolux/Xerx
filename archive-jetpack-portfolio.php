<?php
/**
 * @package xerx
 */

get_header( 'wide' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>
			<header class="section-intro--showcase">
				<?php
				the_archive_title( '<h1 class="page-title section-intro__heading">', '</h1>' );
				the_archive_description( '<div class="section-intro__desc">', '</div>' );
				?>
			</header>

			<div class="showcase-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/entry', 'showcase-grid' );
				endwhile;
				?>
			</div>
			<?php
			the_posts_navigation();
		else :
			get_template_part( 'template-parts/entry', 'none' );
		endif;
		?>

		</main>
	</div>

<?php
get_footer();
