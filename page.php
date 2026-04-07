<?php
/**
 * @package xerx
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			xerx_trail();

			get_template_part( 'template-parts/entry', 'page' );
			get_template_part( 'template-parts/custom-colors' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

		</main>
	</div>

<?php
get_footer();
