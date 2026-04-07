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

			get_template_part( 'template-parts/entry', xerx_detect_format() );
			get_template_part( 'template-parts/custom-colors' );

			xerx_author_box();

			xerx_more_posts();

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
