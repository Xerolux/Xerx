<?php
/**
 * @package xerx
 */

get_header( 'wide' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/entry', 'showcase' );
			get_template_part( 'template-parts/custom-colors' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			the_post_navigation();
		endwhile;
		?>

		</main>
	</div>

<?php
get_footer();
