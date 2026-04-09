<?php
/**
 * Custom block style registrations.
 *
 * @package xerx
 */

function xerx_register_block_styles() {
	register_block_style(
		'core/group',
		array(
			'name'  => 'card-soft',
			'label' => __( 'Card Soft', 'xerx' ),
		)
	);

	register_block_style(
		'core/group',
		array(
			'name'  => 'card-outline',
			'label' => __( 'Card Outline', 'xerx' ),
		)
	);

	register_block_style(
		'core/quote',
		array(
			'name'  => 'quote-emphasis',
			'label' => __( 'Quote Emphasis', 'xerx' ),
		)
	);

	register_block_style(
		'core/separator',
		array(
			'name'  => 'separator-fade',
			'label' => __( 'Separator Fade', 'xerx' ),
		)
	);

	register_block_style(
		'core/list',
		array(
			'name'  => 'list-check',
			'label' => __( 'List Check', 'xerx' ),
		)
	);
}
add_action( 'init', 'xerx_register_block_styles' );
