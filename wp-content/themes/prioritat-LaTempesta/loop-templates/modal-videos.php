<?php
/**
 * CPT 'videos' modal template
 * 
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$lang = apply_filters( 'wpml_current_language', null );

$ID = get_the_ID();
$slug = $post->post_name . '-' . $ID;

$youtube_iframe = get_field( 'youtube_url' );
$video = get_field( 'video' );

if ( $youtube_iframe && substr($youtube_iframe, 0, 7) !== '<iframe' ) { // WPML compatibility
    $youtube_id = get_youtube_id_from_url( $youtube_iframe );
    $youtube_iframe = '<iframe title="' . get_the_title() . '" src="https://www.youtube.com/embed/' . $youtube_id . '?feature=oembed" width="640" height="360" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

$domain = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'];

$additional_yt_params = array(
    'feature' => 'oembed',
    'enablejsapi' => 1,
    'origin' => $domain,
    'hl' => $lang,
    'cc_lang_pref' => $lang,
    'rel' => 0,
    'showinfo' => 0,
    'modestbranding' => 1,
    'playsinline' => 1,
    'cc_load_policy' => 1,
);
$additional_yt_params = http_build_query( $additional_yt_params );

?>

<div class="modal fade" id="<?= $slug ?>" tabindex="-1" aria-labelledby="modal-<?= $ID ?>-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-video loader">
                    <?php if ( $youtube_iframe ): ?>
                        <?= str_replace( '?feature=oembed', '?' . $additional_yt_params, $youtube_iframe ); ?>
                    <?php elseif ( $video ): ?>
                        <video src="<?= esc_url( $video['url'] ) ?>" controls>
                            <?= __( 'El teu navegador no admet la reproducció de videos', 'prioritat' ) ?>
                        </video>
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
            </div>

        </div>
    </div>
</div>
