<?php
/**
 * CPT 'videos' template
 * 
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$ID = get_the_ID();
$slug = $post->post_name . '-' . $ID;
$thumbnail = get_the_post_thumbnail( $ID, 'medium' );
$title = get_the_title();

if ( !$thumbnail ) {
    $youtube_iframe = get_field( 'youtube_url' );
    $youtube_thumbnail_url = '';

    if ( preg_match( '/src="([^"]+)"/', $youtube_iframe, $match ) ) {
        $youtube_url = $match[1];
        $youtube_id = get_youtube_id_from_url( $youtube_url );
        $youtube_thumbnail_url = 'https://img.youtube.com/vi/' . $youtube_id . '/hqdefault.jpg';
    }

    if ( $youtube_iframe && substr($youtube_iframe, 0, 7) !== '<iframe' ) { // WPML compatibility
        $youtube_id = get_youtube_id_from_url( $youtube_iframe );
        $youtube_thumbnail_url = 'https://img.youtube.com/vi/' . $youtube_id . '/hqdefault.jpg';
    }

}

?>

<article 
    <?php post_class( 'wow animate__animated animate__fadeInUp' ); ?> 
    id="video-<?php the_ID(); ?>"
    data-wow-delay="<?= $delay ?>s">

    <a href="#<?= $slug ?>" class="button-overlay" data-bs-toggle="modal" title="<?= sprintf( __( "Veure més detalls sobre %s", 'tmb-latempesta' ), $title ) ?>">

        <div class="bg-image position-absolute">
            
            <?php if ( $thumbnail ) : ?>
                <?= $thumbnail ?>
            <?php elseif ( $youtube_thumbnail_url ) : ?>
                <img src="<?= $youtube_thumbnail_url ?>" alt="<?= $title ?>" />
            <?php else: ?>
                <img src="https://source.unsplash.com/random/500x500/?nature&sig=<?= $ID ?>">
            <?php endif; ?>

        </div>

        <div class="mosaic-icon d-flex position-absolute end-0 gap-1 mt-2 me-2">

            <span><?= __( 'Vídeo', 'tmb-latempesta' ) ?></span>
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            
        </div>

        <div class="article-wrapper">

            <header class="entry-header">
        
                <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
        
            </header>

        </div>

    </a>

</article>
