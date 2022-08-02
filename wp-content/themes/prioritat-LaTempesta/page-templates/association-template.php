<?php
/**
 * Template Name: Association Page
 *
 * Template for displaying the association page.
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

<div id="association-page-wrapper">

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

								<section id="association-summary" class="my-5 py-3">

									<div class="row">

										<div class="col-lg-10 col-xl-9 lh-sm">
											<?php the_content(); ?>
										</div>

									</div>

								</section>

								<section id="objectives" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Objectius', 'prioritat' ) ?>
										</h2>
									</header>

									<p><?= __( 'Segons els estatuts fundacionals els objectius de l\'entitat son:', 'prioritat' ) ?></p>

									<div class="objectives-list py-3">

										<div class="objective">
											<p><?= __( 'Impulsar, coordinar i gestionar les actuacions necessàries per presentar, a la UNESCO, la candidatura de la comarca del Priorat com a paisatge cultural patrimoni de la humanitat.', 'prioritat' ) ?></p>
										</div>

										<div class="objective">
											<p><?= __( 'Donar suport a totes les actuacions encaminades al reconeixement del valor patrimonial del paisatge cultural de la comarca del Priorat.', 'prioritat' ) ?></p>
										</div>

										<div class="objective">
											<p><?= __( 'Vetllar per la preservació d\'aquest valor patrimonial i per la gestió respectuosa d\'aquest patrimoni. Promoure i donar suport a activitats que ajudin a consolidar un model de desenvolupament que garanteixi aquests valors, en col·laboració amb totes les persones, entitats i institucions d\'àmbit comarcal i d\'altres àmbits.', 'prioritat' ) ?></p>
										</div>

										<div class="objective">
											<p><?= __( 'Treballar en col·laboració amb totes les persones, entitats i institucions d\'àmbit comarcal i d\'altres àmbits, per fer possible viure dignament al Priorat mantenint els valors tradicionals que l\'identifiquen: la pagesia, la petita escala, la diversitat, les relacions de proximitat i el paisatge.', 'prioritat' ) ?></p>
										</div>

									</div>

								</section>

								<section id="strategic-lines" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Línies estratègiques', 'prioritat' ) ?>
										</h2>
									</header>

									<div class="strategic-lines row">

										<div class="col-md-12 col-lg-4">
											<div class="strategic-line bg-gray-400 p-4">
												<p class="strategic-line__title h1 mb-3">1</p>
												<p>
													<?= __( 'Aprofundir en el coneixement conscient i dinàmic de la forta identitat territorial, a partir de la identificació, l\'estudi i el reconeixement dels valors i atributs que la configuren.', 'prioritat' ) ?>
												</p>
											</div>
										</div>

										<div class="col-md-6 col-lg-4">
											<div class="strategic-line bg-secondary p-4">
												<p class="strategic-line__title h1 mb-3">2</p>
												<p>
													<?= __( 'Fomentar l\'autoorganització, la coordinació i la cooperació per garantir una governança participativa i eficient, tant a l\'àmbit social com en el polític, així com en la seva interrelació.', 'prioritat' ) ?>
												</p>
											</div>
										</div>

										<div class="col-md-6 col-lg-4">
											<div class="strategic-line bg-primary p-4">
												<p class="strategic-line__title h1 mb-3">3</p>
												<p>
													<?= __( 'Consolidar i implementar un model territorial integral propi i transversal.', 'prioritat' ) ?>
												</p>
											</div>
										</div>

									</div>

								</section>

								<section id="past" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Antecedents', 'prioritat' ) ?>
										</h2>
									</header>

									<div class="row">

										<div class="col-md-7">
											<p>
												<?= __( 'Prioritat neix de la voluntat d\'una part de la societat prioratina de treballar de manera propositiva (en positiu) per la preservació del paisatge i la seua gestió enraonada.', 'prioritat' ) ?>
											</p>
											<p>
												<?= __( 'Els primers anys del s. XXI a la comarca es va generar un debat, que s\'originà a partir dels projectes de centrals eòliques que omplien les nostres serres d\'aerogeneradors. Aquest debat posava al centre la consideració del valor del nostre paisatge i com aquest valor podia ajudar-nos a proposar un model territori de futur.', 'prioritat' ) ?>
											</p>
											<p>
												<?= __( 'El manteniment del debat, més enllà d\'haver aturat aquests projectes i altres també agressius (Tèrmica ENRON), va provocar, en certa manera, que es passés d\'una actitud reactiva, de reacció en front de les agressions, a una proposta d\'actuació més propositiva, en positiu, que es materialitza i s\'articula al voltant de Prioritat.', 'prioritat' ) ?>
											</p>
										</div>

										<div class="col-md-5">

										</div>

									</div>

								</section>

							</div>

						</div>

					</div>

					<div class="container-fluid p-0">
						
						<section id="timeline" class="bg-gray-200 my-5 p-5">
	
							<header>
								<h2 class="mb-3">
									<?= __( 'Cronologia', 'prioritat' ) ?>
								</h2>
							</header>
	
							<p>Lorem ipsum dolor sit amet, consetetur sadipscing elits, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, seed diam voluptua.</p>
	
						</section>

					</div>

					<div class="container">

						<div class="row">
							
							<div class="col-md-12">

								<section id="organization" class="my-5 py-3">
			
										<header>
											<h2 class="mb-3"><?= __( 'Organització', 'prioritat' ) ?></h2>
										</header>

										<div class="accordion accordion-flush" id="accordionOrganization">

											<div class="accordion-item">
												<h2 class="accordion-header" id="flush-headingOne">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
													Assemblea
												</button>
												</h2>
												<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionOrganization">
													<div class="accordion-body">
														Lorem ipsum dolor sit amet, consetetur sadipscing elits, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.
													</div>
												</div>
											</div>

											<div class="accordion-item">
												<h2 class="accordion-header" id="flush-headingTwo">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
													Junta
												</button>
												</h2>
												<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionOrganization">
													<div class="accordion-body">
														Lorem ipsum dolor sit amet, consetetur sadipscing elits, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.
													</div>
												</div>
											</div>

											<div class="accordion-item">
												<h2 class="accordion-header" id="flush-headingThree">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
													Comissions de treball
												</button>
												</h2>
												<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionOrganization">
													<div class="accordion-body">
														Lorem ipsum dolor sit amet, consetetur sadipscing elits, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.
													</div>
												</div>
											</div>

										</div>
			
								</section>

							</div>

						</div>

					</div>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
