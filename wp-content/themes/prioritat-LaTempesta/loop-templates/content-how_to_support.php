<?php
/**
 * Partial template for how_to_support CPT
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$button = get_field('button');

?>

<div class="how-to-support-item bg-<?= get_field('color') ?> p-4">
	<h3 class="how-to-support-item__title fs-5 fw-bold mb-3">
		<?= get_the_title() ?>
	</h3>
	<div class="how-to-support-item__summary lh-sm">
		<?= get_field('summary') ?>
	</div>
	<a href="<?= esc_url( $button['linked_form'] ) ?>" class="how-to-support-item__link read-more btn btn-outline-dark fw-semibold mt-auto">
		<?= $button['btn_text'] ?>
	</a>
</div>
