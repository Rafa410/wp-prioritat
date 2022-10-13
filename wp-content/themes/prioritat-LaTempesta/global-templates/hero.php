<div class="homepage-hero min-vh-100 d-flex">
    
    <div class="homepage-hero__image">
        <?php the_post_thumbnail(); ?>
    </div>
    
    <div class="container homepage-hero__content d-flex flex-column align-items-start text-light">
        <h2 class="homepage-hero__title fw-extrabold">
            <?= __( 'Persones per al desenvolupament del Paisatge Cultural del Priorat', 'prioritat' ) ?>
        </h2>
        <a 
            href="<?= site_url( '/participa' ) ?>" 
            class="btn btn-lg btn-secondary animate__animated animate__fadeInUp animate__delay-2s py-1 px-2 px-sm-3 my-3 fw-medium"
            data-delay="1s">
            <span><?= __( 'Vols formar-ne part?', 'prioritat' ) ?></span>
        </a>
    </div>

    <div class="homepage-hero__pattern dot-pattern p-2 pt-5">
        <img class="inline-svg" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
    </div>

</div>
