<?php
/**
 * CPT 'fotos' template
 * 
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$delay = $args['index'] / 8;
$ID = get_the_ID();
$slug = $post->post_name . '-' . $ID;
$thumbnail = get_the_post_thumbnail( $ID, 'medium' );
$title = get_the_title();
$excerpt = get_the_excerpt();

?>

<article
    <?php post_class( 'wow animate__animated animate__fadeInUp' ); ?> 
    id="foto-<?php the_ID(); ?>"
    data-wow-delay="<?= $delay ?>s">

    <a href="#<?= $slug ?>" class="button-overlay" data-bs-toggle="modal" title="<?= sprintf( __( "Veure més detalls sobre %s", 'tmb-latempesta' ), $title ) ?>">

        <?php if ( $thumbnail ) : ?>

            <div class="bg-image position-absolute">
                <?= $thumbnail ?>
            </div>

        <?php else: ?>

            <div class="bg-image position-absolute">
                <img src="https://source.unsplash.com/random/500x500/?nature&sig=<?= $ID ?>">
            </div>

        <?php endif; ?>

        <div class="mosaic-icon d-flex position-absolute end-0 gap-1 mt-2 me-2">

            <span><?= __( 'Fotografia', 'tmb-latempesta' ) ?></span>
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
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
