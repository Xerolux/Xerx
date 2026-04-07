<?php
/**
 * @package xerx
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header section-intro">
					<h1 class="page-title section-intro__heading">
						<span class="section-intro__label">404</span>
						<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'xerx' ); ?>
					</h1>
					<p>
						<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'xerx' ); ?>
					</p>
				</header>

				<div class="page-content page-404">

					<?php
					get_search_form();
					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'xerx' ); ?></h2>
						<ul>
							<?php
							wp_list_categories(
								array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								)
							);
							?>
						</ul>
					</div>

					<?php
					$archive_blurb = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'xerx' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_blurb" );
					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div>
			</section>

		</main>
	</div>

<?php
get_footer();
