<?php
/**
 * CPT 'documents' template
 * 
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$ID = get_the_ID();
$slug = $post->post_name . '-' . $ID;
$thumbnail = get_the_post_thumbnail( $ID, 'medium' );
$title = get_the_title();
$excerpt = get_the_excerpt();
$document = get_field( 'document' );
$alt = $title;

if ( $document ) {
    if ( is_string( $document ) ) { // WPML compatibility
        $document_id = $document;
        $url = wp_get_attachment_url( $document_id );
        $thumbnail_preview = wp_get_attachment_image_src( $document_id, 'medium', true );
        $alt = get_post_meta( $document_id, '_wp_attachment_image_alt', true ) ?: $title;
    } else {
        $document_id = $document['id'];
        $url = $document['url'];
        $thumbnail_preview = wp_get_attachment_image_src( $document_id, 'medium', true );
        $alt = $document['alt'] ?: $title;
    }
}

?>

<article 
    <?php post_class( 'wow animate__animated animate__fadeInUp' ); ?> 
    id="document-<?php the_ID(); ?>"
    data-wow-delay="<?= $delay ?>s">

    <a href="#<?= $slug ?>" class="button-overlay" data-bs-toggle="modal" title="<?= sprintf( __( "Veure més detalls sobre %s", 'tmb-latempesta' ), $title ) ?>">

        <div class="bg-image position-absolute">
            
            <?php if ( $thumbnail ) : ?>
                <?= $thumbnail ?>
            <?php elseif ( !empty($thumbnail_preview) ) : ?>
                <img src="<?= esc_url( $thumbnail_preview[0] ) ?>" alt="<?= esc_attr( $alt ) ?>" class="img-fluid">
            <?php else: ?>
                <img src="https://source.unsplash.com/random/500x500/?nature&sig=<?= $ID ?>">
            <?php endif; ?>

        </div>

        <div class="mosaic-icon d-flex position-absolute end-0 gap-1 mt-2 me-2">

            <span><?= __( 'Document', 'tmb-latempesta' ) ?></span>
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            
        </div>

        <div class="article-wrapper">

            <header class="entry-header">
        
                <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
        
            </header>
        
            <div class="entry-content">
        
                <span><?= $excerpt ?></span>
        
            </div>

        </div>

    </a>

</article>
