<?php
/**
 * Template part for displaying chat post format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xerx
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--chat h-entry' ); ?>>
	<?php the_title( '<h2 class="entry__title p-name"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry__meta">
			<?php xerx_post_date(); ?>
			<?php xerx_read_time(); ?>
			<?php xerx_post_footer(); ?>
		</div>
	<?php endif; ?>

	<div class="entry__body entry__body--chat e-content">
		<?php
		$chat_raw   = get_the_content();
		$chat_lines = preg_split( '/\r\n|\r|\n/', strip_tags( $chat_raw ) );
		$last_author = '';

		foreach ( $chat_lines as $line ) {
			$line = trim( $line );
			if ( '' === $line ) continue;

			if ( preg_match( '/^([^:]+):\s*(.+)$/', $line, $matches ) ) {
				$author  = esc_html( $matches[1] );
				$message = esc_html( $matches[2] );
				$mod     = ( $author !== $last_author ) ? ' dialog__line--new-speaker' : '';
				?>
				<div class="dialog__line<?php echo $mod; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
					<?php if ( $author !== $last_author ) : ?>
						<span class="dialog__speaker"><?php echo $author; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<?php endif; ?>
					<span class="dialog__text"><?php echo $message; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</div>
				<?php
				$last_author = $author;
			} else {
				echo '<p class="dialog__aside">' . esc_html( $line ) . '</p>';
			}
		}
		?>
	</div>
</article>
