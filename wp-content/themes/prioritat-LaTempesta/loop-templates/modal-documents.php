<?php
/**
 * CPT 'documents' modal template
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$ID = get_the_ID();
$slug = $post->post_name . '-' . $ID;
$title = get_the_title();
$document = get_field( 'document' );
$thumbnail = get_the_post_thumbnail( $ID, 'full' );
$alt = $title;
$doc_viewer_url = 'https://docs.google.com/viewer?embedded=true&url=';
$url = 'https://source.unsplash.com/random/?nature&sig=' . $ID;

if ( $document ) {
    if ( is_string( $document ) ) { // WPML compatibility
        $document_id = $document;
        $url = wp_get_attachment_url( $document_id );
        $embed_url = $doc_viewer_url . urlencode( $url );
        $thumbnail_preview = wp_get_attachment_image_src( $document_id, 'full', true );
        $alt = get_post_meta( $document_id, '_wp_attachment_image_alt', true ) ?: $title;
    } else {
        $document_id = $document['id'];
        $url = $document['url'];
        $embed_url = $doc_viewer_url . urlencode( $url );
        $thumbnail_preview = wp_get_attachment_image_src( $document_id, 'full', true );
        $alt = $document['alt'] ?: $title;
    }
}

?>

<div class="modal fade" id="<?= $slug ?>" tabindex="-1" aria-labelledby="modal-<?= $ID ?>-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-document loader">
                    
                    <?php if ( isset( $embed_url ) ) : ?>

                        <iframe src="<?= esc_url( $embed_url ) ?>" width="100%" title="<?= esc_attr( $alt ) ?>" allowfullscreen role="document"></iframe>

                    <?php elseif ( $thumbnail ) : ?>

                        <?= $thumbnail ?>

                    <?php elseif ( !empty( $thumbnail_preview ) ) : ?>

                        <img src="<?= esc_url( $thumbnail_preview[0] ) ?>" alt="<?= esc_attr( $alt ) ?>">

                    <?php else : ?>

                        <img src="<?= esc_url( $url ) ?>">                        

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

                <div class="small fw-light text-light">
                    <?php the_content(); ?>
                </div>

                <div class="d-flex justify-content-center gap-3 my-3">

                    <a 
                        href="<?= $doc_viewer_url . urlencode( $url ) ?>" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="btn btn-outline-secondary">
                        <svg class="me-1" width="24" height="24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M16.125 7.313V6.188A.188.188 0 0 0 15.937 6h-9a.188.188 0 0 0-.187.188v1.125c0 .103.084.187.188.187h9a.188.188 0 0 0 .187-.188ZM6.937 9.374a.188.188 0 0 0-.187.188v1.124c0 .104.084.188.188.188h4.312a.188.188 0 0 0 .188-.188V9.563a.188.188 0 0 0-.188-.188H6.937Zm3.375 10.594H4.875v-16.5H18v8.062c0 .103.084.188.188.188H19.5a.188.188 0 0 0 .188-.188v-9a.75.75 0 0 0-.75-.75h-15a.75.75 0 0 0-.75.75v18.375c0 .415.335.75.75.75h6.374a.188.188 0 0 0 .188-.187v-1.313a.188.188 0 0 0-.188-.187Zm10.447 1.207-2.187-2.187a4.125 4.125 0 1 0-1.022.956l2.22 2.22a.188.188 0 0 0 .262 0l.727-.727a.186.186 0 0 0 0-.262Zm-5.478-2.051a2.624 2.624 0 0 1-2.625-2.625 2.624 2.624 0 0 1 2.625-2.625 2.624 2.624 0 0 1 2.625 2.625 2.624 2.624 0 0 1-2.625 2.625Z" fill="currentColor"/>
                        </svg> <?= __( 'Previsualitza', 'prioritat' ) ?>
                    </a>

                    <a 
                        href="<?= esc_url( $url ) ?>" 
                        class="btn btn-outline-tertiary" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        download>
                        <svg class="me-1 ms-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.469 16.281a.751.751 0 0 0 1.062 0l3-3a.749.749 0 0 0-.244-1.225.752.752 0 0 0-.818.163l-1.719 1.72V8.25a.75.75 0 1 0-1.5 0v5.69l-1.719-1.721a.751.751 0 0 0-1.062 1.062l3 3Z" fill="currentColor"/><path d="M6.609 5.013A8.295 8.295 0 0 1 12 3c4.035 0 7.384 3 7.749 6.868C22.137 10.206 24 12.206 24 14.66c0 2.694-2.247 4.841-4.97 4.841H5.671C2.563 19.5 0 17.049 0 13.977c0-2.645 1.899-4.835 4.413-5.39.215-1.294 1.047-2.584 2.196-3.574Zm.98 1.136c-1.136.979-1.73 2.16-1.73 3.083v.673l-.668.073c-2.095.23-3.691 1.95-3.691 3.999C1.5 16.177 3.345 18 5.671 18h13.36c1.939 0 3.469-1.518 3.469-3.34 0-1.825-1.53-3.342-3.47-3.342h-.75v-.75C18.282 7.238 15.492 4.5 12 4.5a6.795 6.795 0 0 0-4.412 1.65v-.002Z" fill="currentColor"/>
                        </svg> <?= __( 'Descarrega', 'prioritat' ) ?>
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>
