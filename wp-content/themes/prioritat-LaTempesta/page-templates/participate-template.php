<?php
/**
 * Template Name: Participa
 *
 * Template for displaying the participate page.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

if ( is_front_page() ) {
	get_template_part( 'global-templates/hero' );
}
?>

<div id="participate-page-wrapper">

	<div class="container-fluid p-0" id="content">

		<div class="row g-3">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<header class="page-header py-4 <?php if ( ! has_post_thumbnail() ): ?>no-img<?php endif; ?>">

						<div class="page-image">
							<?= get_the_post_thumbnail( $post->ID, 'full' ); ?>
						</div>

						<div class="container">
							<h1 class="page-title"><?php the_title(); ?></h1>
						</div>

						<div class="dot-pattern p-2 pt-5">
							<img class="inline-svg" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
						</div>

					</header>

					<div class="container py-5">

						<div class="row">

							<div class="col-md-12">

								<section id="support">

									<div class="row lh-sm">

										<div class="col-md-12 col-lg-4">
											<div class="d-flex flex-column align-items-start bg-primary h-100 p-4">
												<h3 class="h5 fw-bold mb-3">
													<?= __( 'Forma part de Prioritat', 'prioritat' ) ?>
												</h3>
												<p>
													<?= __( 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr.', 'prioritat' ) ?>
												</p>
												<a href="<?= site_url( '/fes-te-soci' ) ?>" class="read-more btn btn-outline-dark fw-semibold mt-auto mb-3">
													<?= __( 'Fes-te\'n soci', 'prioritat' ) ?>
												</a>
											</div>
										</div>

										<div class="col-md-6 col-lg-4">
											<div class="d-flex flex-column align-items-start bg-secondary h-100 p-4">
												<h3 class="h5 fw-bold mb-3">
													<?= __( 'Apadrina una pàgina del dossier de la Candidatura', 'prioritat' ) ?>
												</h3>
												<p>
													<?= __( 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr.', 'prioritat' ) ?>
												</p>
												<a href="<?= site_url( '/apadrina-pagina-dossier' ) ?>" class="read-more btn btn-outline-dark fw-semibold mt-auto mb-3">
													<?= __( 'Apadrina una pàgina', 'prioritat' ) ?>
												</a>
											</div>
										</div>

										<div class="col-md-6 col-lg-4">
											<div class="d-flex flex-column align-items-start bg-tertiary h-100 p-4">
												<h3 class="h5 fw-bold mb-3">
													<?= __( 'Fes-te mecenes del projecte', 'prioritat' ) ?>
												</h3>
												<p>
													<?= __( 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur.', 'prioritat' ) ?>
												</p>
												<a href="<?= site_url( '/fes-te-mecenes' ) ?>" class="read-more btn btn-outline-dark fw-semibold mt-auto mb-3">
													<?= __( 'Fes-te mecenes', 'prioritat' ) ?>
												</a>
											</div>
										</div>

									</div>

								</section>

								<section id="activities" class="my-5 py-3">

								</section>

							</div><!-- .col -->

						</div><!-- .row -->

					</div><!-- .container -->

					<div class="container-fluid p-0">
						
						<section id="forums" class="bg-secondary my-5 p-5">
	
							<header>
								<h2 class="fw-extrabold mb-3">
									<?= __( 'Els fòrums', 'prioritat' ) ?>
								</h2>
							</header>
	
							<div class="col-lg-11 col-xl-10 lh-sm">
								<p>Els Fòrums són espais de participació i debat oberts a totes les persones i entitats que hi vulguin participar. Són part indispensable del Sistema de Gestió del Paisatge Cultural Priorat-Montsant-Siurana que neix amb la candidatura UNESCO. Prioritat n'està sent un dels principals impulsors.</p>
							</div>
	
							<div class="forums-list d-flex flex-wrap gap-3 justify-content-center">

								<?php
								$args = array(
									'post_type' => 'forums',
									'posts_per_page' => -1,
									'orderby' => 'date',
									'order' => 'ASC'
								);

								$forums = new WP_Query( $args );

								if ( $forums->have_posts() ) {

									while ( $forums->have_posts() ) {
										$forums->the_post();
										get_template_part( 'loop-templates/content', get_post_type() );
									}
								}

								wp_reset_postdata();

								?>

							</div>
	
						</section>

					</div>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
