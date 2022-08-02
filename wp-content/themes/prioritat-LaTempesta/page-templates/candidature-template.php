<?php
/**
 * Template Name: Candidature Page
 *
 * Template for displaying the candidature page.
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

<div id="candidature-page-wrapper">

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

								<section id="candidature-summary" class="my-5 py-3">

									<div class="row justify-content-center">

										<div class="col-lg-11 col-xl-10 lh-sm">
											<?php the_content(); ?>
										</div>

									</div>

								</section>

								<section id="reasons" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Per què el Priorat', 'prioritat' ) ?>
										</h2>
									</header>

									<div class="reasons-list row lh-sm">

										<div class="col-md-12 col-lg-4">
											<div class="reason bg-secondary p-4">
												<h3 class="reason__title h5 fw-bold mb-3">
													<?= __( 'El paisatge', 'prioritat' ) ?>
												</h3>
												<p>
													<?= __( 'El nostre paisatge representa de manera excepcional aquesta interacció en un espai mediterrani de terra endins. I  té una diversitat, una complexitat, una nitidesa i una dimensió immaterial, mantingudes al llarg de la història i vives encara avui, que el fan mereixedor del reconeixement de la UNESCO.', 'prioritat' ) ?>
												</p>
											</div>
										</div>

										<div class="col-md-6 col-lg-4">
											<div class="reason bg-secondary p-4">
												<h3 class="reason__title h5 fw-bold mb-3">
													<?= __( 'La posada en valor', 'prioritat' ) ?>
												</h3>
												<p>
													<?= __( 'El paisatge de la comarca és, alhora, un capital i un recurs fràgil que cal posar en valor i gestionar de manera integral i sostenible per contribuir a l\'obtenció de beneficis socials, culturals i econòmics.', 'prioritat' ) ?>
												</p>
											</div>
										</div>

										<div class="col-md-6 col-lg-4">
											<div class="reason bg-secondary p-4">
												<h3 class="reason__title h5 fw-bold mb-3">
													<?= __( 'L\'equilibri', 'prioritat' ) ?>
												</h3>
												<p>
													<?= __( 'L\'objectiu és garantir la qualitat de vida dels seus habitants i la preservació de l\'entorn, a partir de l\'equilibri entre la necessària utilització del territori i la salvaguarda de la seva autenticitat. ', 'prioritat' ) ?>
												</p>
											</div>
										</div>

									</div>

								</section>

								<section id="current-state" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Estat actual de la candidatura', 'prioritat' ) ?>
										</h2>
									</header>

									<div class="row">

										<div class="col-md-7 lh-sm">
											<p>
												<?= __( 'El procés per a preparar la candidatura per a esdevenir Patrimoni Mundial per la UNESCO començà l\'any 2011, quan es constituí l\'equip de redacció del dossier de candidatura. El dossier és el document que ha de contenir tot el que la UNESCO reclama per tal que quedi justificada la seua inscripció a la Llista del Patrimoni Mundial.', 'prioritat' ) ?>
											</p>
											<p>
												<?= __( 'Després de la moció de suport de la DIPTA, al 2012 es feu la declaració del Parlament de suport a la candidatura, rebent també l\'aprovació de la Generalitat. Del 2012 al 2014 es posaren les bases del plantejament del dossier i s\'establiren les relacions institucionals imprescindibles en tot projecte de candidatura, per dur a terme tots els protocols requerits. Des del 2015 fins al 2018 s\'elaboraren els continguts del dossier i es materialitzà, presentant-se a l\'òrgan competent que tramita les candidatures, depenent del Ministerio de Cultura.', 'prioritat' ) ?>
											</p>
											<p>
												<?= __( 'Tot just presentar el dossier, s\'optà per una retirada estratègica al 2019, la qual es faria per tornar amb més força el 2022, una vegada reorganitzada l\'entitat després de l\'aturada causada per la pandèmia de COVID.', 'prioritat' ) ?>
											</p>
										</div>

										<div class="col-md-5">
											<!-- Image -->
										</div>

									</div>

								</section>

								<!-- <section id="the-process" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?php // __( 'El procés de la candidatura', 'prioritat' ) ?>
										</h2>
									</header>

								</section> -->

								<section id="support" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Què pots fer per donar suport a la candidatura?', 'prioritat' ) ?>
										</h2>
									</header>

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

							</div>

						</div><!-- .row -->

					</div><!-- .container -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
