<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$ID = get_the_ID();
$slug = $post->post_name . '-' . $ID;
$thumbnail = get_the_post_thumbnail( $ID, 'full' );

?>

<div class="modal fade" id="<?= $slug ?>" tabindex="-1" aria-labelledby="modal-<?= $ID ?>-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-image zoom loader">
                    <?php if ( $thumbnail ): ?>
                        <?= $thumbnail ?>
                    <?php else: ?>
                        <img src="https://source.unsplash.com/random/?nature&sig=<?= $ID ?>">
                    <?php endif; ?>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex align-items-center mb-2">
                    <h2 class="entry-title mb-0" id="modal-<?= $ID ?>-label">
                        <?php the_title(); ?>
                    </h2>
                </div>
            </div>

        </div>
    </div>
</div>
