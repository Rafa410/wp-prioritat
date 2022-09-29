<?php
/**
 * Single 'Organization item' partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$accordion_id = $args['accordion_id'];
$slug = get_post_field( 'post_name', get_post() );

?>

<div class="accordion-item">
	<h3 class="accordion-header" id="<?= $slug . '-heading' ?>">
		<button class="accordion-button fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $slug ?>" aria-expanded="false" aria-controls="<?= $slug ?>">
			<?= get_the_title() ?>
		</button>
	</h3>
	<div id="<?= $slug ?>" class="accordion-collapse collapse" aria-labelledby="<?= $slug . '-heading' ?>" data-bs-parent="#<?= $accordion_id ?>">
		<div class="accordion-body">
			<?= get_the_content() ?>
		</div>
	</div>
</div>