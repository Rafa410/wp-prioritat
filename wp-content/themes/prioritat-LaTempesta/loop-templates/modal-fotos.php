<?php
/**
 * CPT 'fotos' modal template
 *
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

            <div class="modal-header p-0">
                <h3 class="visually-hidden" id="modal-<?= $ID ?>-label">
                    <?php the_title(); ?>
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <figure>
                    <div class="modal-image zoom loader">
                        <?php if ( $thumbnail ): ?>
                            <?= $thumbnail ?>
                        <?php else: ?>
                            <img src="https://source.unsplash.com/random/?nature&sig=<?= $ID ?>">
                        <?php endif; ?>
                    </div>
                    <figcaption class="entry-title text-center p-3">
                        <?= get_the_post_thumbnail_caption() ?>
                    </figcaption>
                </figure>
            </div>

        </div>
    </div>
</div>
