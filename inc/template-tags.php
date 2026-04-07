<?php
/**
 * Custom template tags for this theme
 *
 * @package xerx
 */

if ( ! function_exists( 'xerx_post_date' ) ) :
	function xerx_post_date() {
		$modified = get_the_time( 'U' ) !== get_the_modified_time( 'U' );

		if ( $modified ) {
			$time_string = '<time class="entry-date published dt-published" datetime="%1$s">%2$s</time>'
				. '<time class="updated dt-updated" datetime="%3$s">%4$s</time>';
		} else {
			$time_string = '<time class="entry-date published updated dt-published dt-updated" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$link = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="u-url">' . $time_string . '</a>';

		echo '<span class="meta-date">' . $link . '</span>';
	}
endif;

if ( ! function_exists( 'xerx_post_author' ) ) :
	function xerx_post_author() {
		$author = '<span class="author vcard"><a class="url fn n" href="'
			. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
			. '">' . esc_html( get_the_author() ) . '</a></span>';

		echo '<span class="meta-author"> ' . $author . '</span>';
	}
endif;

if ( ! function_exists( 'xerx_read_time' ) ) :
	function xerx_read_time() {
		$text    = get_post_field( 'post_content', get_the_ID() );
		$count   = str_word_count( wp_strip_all_tags( $text ) );
		$minutes = max( 1, (int) ceil( $count / 200 ) );

		printf(
			'<span class="meta-duration" aria-label="%s">%s</span>',
			esc_attr( sprintf( _n( '%d minute read', '%d minute read', $minutes, 'xerx' ), $minutes ) ),
			esc_html( sprintf( _n( '%d min read', '%d min read', $minutes, 'xerx' ), $minutes ) )
		);
	}
endif;

if ( ! function_exists( 'xerx_post_footer' ) ) :
	function xerx_post_footer() {
		if ( 'post' === get_post_type() ) {
			echo '<span class="entry__meta__tags">';
			$tags = get_the_tags();
			if ( $tags ) {
				foreach ( $tags as $tag ) {
					printf(
						'<a rel="tag" class="p-category" href="%s">%s</a>',
						esc_url( get_tag_link( $tag->term_id ) ),
						esc_html( $tag->name )
					);
				}
			}
			echo '</span>';
		}

		if ( function_exists( 'get_syndication_links' ) ) {
			echo get_syndication_links( null, array( 'show_text_before' => null ) );
		}

		edit_post_link(
			sprintf(
				wp_kses(
					__( 'Edit <span class="screen-reader-text">%s</span>', 'xerx' ),
					array( 'span' => array( 'class' => array() ) )
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'xerx_featured_image' ) ) :
	function xerx_featured_image() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>
			<div class="entry__image">
				<?php
				the_post_thumbnail(
					'large',
					array(
						'class'         => 'u-photo',
						'loading'       => 'eager',
						'fetchpriority' => 'high',
						'decoding'      => 'async',
					)
				);
				?>
			</div>
		<?php else : ?>
			<a class="entry__image" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'large',
					array(
						'class'    => 'u-photo',
						'loading'  => 'lazy',
						'decoding' => 'async',
						'alt'      => the_title_attribute( array( 'echo' => false ) ),
					)
				);
				?>
			</a>
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'xerx_trail' ) ) :
	function xerx_trail() {
		if ( ! is_singular() || is_front_page() ) {
			return;
		}

		$steps   = array();
		$steps[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';

		if ( 'post' === get_post_type() ) {
			$cats = get_the_category();
			if ( ! empty( $cats ) ) {
				$first   = $cats[0];
				$steps[] = '<a href="' . esc_url( get_category_link( $first->term_id ) ) . '">' . esc_html( $first->name ) . '</a>';
			}
		}

		if ( 'page' === get_post_type() ) {
			$parents = array_reverse( get_post_ancestors( get_the_ID() ) );
			foreach ( $parents as $pid ) {
				$steps[] = '<a href="' . esc_url( get_permalink( $pid ) ) . '">' . esc_html( get_the_title( $pid ) ) . '</a>';
			}
		}

		$steps[] = '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';

		echo '<nav class="trail" aria-label="' . esc_attr__( 'Breadcrumb', 'xerx' ) . '">';
		echo '<ol class="trail__steps">';
		foreach ( $steps as $s ) {
			echo '<li class="trail__step">' . $s . '</li>';
		}
		echo '</ol>';
		echo '</nav>';
	}
endif;

if ( ! function_exists( 'xerx_author_box' ) ) :
	function xerx_author_box() {
		if ( ! is_single() ) {
			return;
		}

		$bio = get_the_author_meta( 'description' );
		if ( ! $bio ) {
			return;
		}

		$uid  = (int) get_the_author_meta( 'ID' );
		$url  = get_author_posts_url( $uid );
		$name = get_the_author();
		?>
		<div class="about-author">
			<div class="about-author__photo">
				<?php echo get_avatar( $uid, 80, '', esc_attr( $name ), array( 'class' => 'about-author__img' ) ); ?>
			</div>
			<div class="about-author__info">
				<p class="about-author__name">
					<a href="<?php echo esc_url( $url ); ?>">
						<?php echo esc_html( $name ); ?>
					</a>
				</p>
				<p class="about-author__bio"><?php echo esc_html( $bio ); ?></p>
				<a class="about-author__url" href="<?php echo esc_url( $url ); ?>">
					<?php printf( esc_html__( 'More posts by %s', 'xerx' ), esc_html( $name ) ); ?>
				</a>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'xerx_share_links' ) ) :
	function xerx_share_links() {
		if ( ! is_singular() ) {
			return;
		}

		$href  = rawurlencode( get_permalink() );
		$label = rawurlencode( get_the_title() );
		?>
		<div class="share-bar">
			<span class="share-bar__label"><?php esc_html_e( 'Share:', 'xerx' ); ?></span>

			<a class="share-bar__btn"
				href="https://twitter.com/intent/tweet?url=<?php echo $href; ?>&text=<?php echo $label; ?>"
				target="_blank"
				rel="noopener noreferrer"
				aria-label="<?php esc_attr_e( 'Share on X / Twitter', 'xerx' ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.259 5.63 5.905-5.63Zm-1.161 17.52h1.833L7.084 4.126H5.117Z"/></svg>
				<span class="screen-reader-text"><?php esc_html_e( 'X / Twitter', 'xerx' ); ?></span>
			</a>

			<a class="share-bar__btn"
				href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $href; ?>"
				target="_blank"
				rel="noopener noreferrer"
				aria-label="<?php esc_attr_e( 'Share on Facebook', 'xerx' ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
				<span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'xerx' ); ?></span>
			</a>

			<a class="share-bar__btn"
				href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $href; ?>&title=<?php echo $label; ?>"
				target="_blank"
				rel="noopener noreferrer"
				aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'xerx' ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
				<span class="screen-reader-text"><?php esc_html_e( 'LinkedIn', 'xerx' ); ?></span>
			</a>

			<button class="share-bar__btn share-bar__clipboard"
				data-url="<?php echo esc_attr( get_permalink() ); ?>"
				aria-label="<?php esc_attr_e( 'Copy link to clipboard', 'xerx' ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
				<span class="screen-reader-text"><?php esc_html_e( 'Copy link', 'xerx' ); ?></span>
			</button>
		</div>
		<?php
	}
endif;
