<div class="homepage-hero d-flex align-items-center">
    <div class="bg-image position-absolute">
        <?php the_post_thumbnail(); ?>
    </div>
    <div class="hero-content d-flex flex-column align-items-start text-light">
        <h1 class="bg-title pe-2"><?= __( 'Priorat', 'prioritat' ) ?></h1>
        <h2 class="bg-title pe-3"><?= __( 'Paisatge cultural patrimoni mundial', 'prioritat' ) ?></h2>
        <p class="description my-3 p-3">Super breu explicació de què és l'asociació, què pretén i pq algú s'hauria d'unir. Lorem ipsum dolor sit amet, consetetur sadipscing elits, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
        <a href="<?= site_url( '/fes-te-soci' ) ?>" class="btn btn-lg btn-secondary btn-animated position-relative py-1 text-light fw-bold">
            <span><?= __( 'Fes-te soci', 'prioritat' ) ?></span>
        </a>
    </div>
</div>
