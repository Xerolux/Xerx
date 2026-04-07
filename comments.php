<?php
/**
 * @package xerx
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="discussion">

	<?php
	if ( have_comments() ) :
		$avatar_size = get_theme_mod( 'show_comment_avatars', '1' ) === '1' ? 48 : 0;
	?>
		<ol class="discussion__list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => $avatar_size,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
		?>
			<p class="discussion-closed"><?php esc_html_e( 'Comments are closed.', 'xerx' ); ?></p>
		<?php
		endif;

	endif;

	comment_form();
	?>

</div>
