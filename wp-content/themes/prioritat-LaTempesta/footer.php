<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<hr>

			<div class="col-md-12">

				<footer class="row site-footer" id="colophon">

					<div class="col-sm my-3 my-sm-0 logo-wrapper d-flex flex-column justify-content-center align-items-start">
						
						<?= get_custom_logo() ?>
						
						<a href="mailto:xarxa@prioritat.org" class="mailto text-dark link-primary text-decoration-none fw-dark my-2 py-2">xarxa@prioritat.org</a>

						<?php $social_networks = get_field( 'social_networks', 'option' ); ?>

						<?php if ( $social_networks ) : ?>

							<ul class="social-icons d-inline-flex list-unstyled mb-0 gap-2">

								<?php foreach( $social_networks as $social_network ) : ?>

									<li>
										<a class="icon icon-<?= $social_network['name']['value'] ?> p-2 rounded-circle" href="<?= esc_url( $social_network['social_link'] ) ?>" title="<?= $social_network['name']['label'] ?>" target="_blank" rel="noopener noreferrer">
											<span class="visually-hidden"><?= sprintf( __('%s de Prioritat (Obre en una finestra nova)', 'prioritat'), $social_network['name']['label'] ) ?></span>
											<img class="inline-svg bi" src="<?= get_stylesheet_directory_uri() . '/images/social/' . $social_network['name']['value'] . '.svg' ?>" aria-hidden="true">
										</a>
									</li>

								<?php endforeach; ?>

							</ul>

						<?php endif;?>

					</div>

					<div class="col-sm my-3 my-sm-0 actions-wrapper d-flex flex-sm-column gap-2 justify-content-center align-items-center">
						<a href="https://cloud.prioritat.local" class="btn btn-dark py-1 fw-bold small">
							<span><?= __( 'Àrea soci', 'prioritat' ) ?></span>
						</a>
						<a href="<?= site_url( '/participa/fes-ten-soci' ) ?>" class="btn btn-outline-dark py-1 px-2 fw-bold small">
							<span><?= __( 'Fes-te soci', 'prioritat' ) ?></span>
						</a>
					</div>

					<div class="col-sm my-3 my-sm-0 menu-wrapper d-flex align-items-center">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
					</div>

					<div class="col-lg-4 my-3 my-sm-0 partners-wrapper d-flex flex-column justify-content-center">
						<p class="small"><?= __( 'Amb el suport de: ', 'prioritat' ) ?></p>
						<p class="disclaimer">
							<?= __( 'Per la realització d\'aquest web, s\'ha rebut un ajut de 15.365,70 € (43% PDR, 57% DACC) a l\'empara de la RESOLUCIÓ ACC/2603/2021, de 4 d\'agost, de convocatòria anticipada per a l\'any 2022 de subvencions als espais naturals de Catalunya, als hàbitats i les espècies, en el marc del Programa de desenvolupament rural de Catalunya 2014-2020 (operació 07.01.01)', 'prioritat' ) ?>
						</p>
						<div class="row partner-list align-items-center gap-3">
							<div class="partner eu-rural">
								<img id="eu-rural" src="<?= get_stylesheet_directory_uri() ?>/images/partners/eu-rural.png" class="img-fluid" alt="<?= __( 'Fons Europeu Agrícola de Desenvolupament Rural', 'prioritat' ) ?>">
							</div>
							<div class="partner gencat-accioclimatica">
								<?= wp_get_attachment_image( 3033, 'medium', false, array( 'id' => 'gencat-accioclimatica' ) ) ?>
							</div>
							<div class="partner serra-montsant">
								<?= wp_get_attachment_image( 3034, 'medium', false, array( 'id' => 'serra-montsant' ) ) ?>
							</div>
						</div>
					</div>

				</footer><!-- #colophon -->

			</div><!--col end -->

			<hr class="mt-3">

			<div class="row">
				<div class="col-lg-6">
					<p class="disclaimer mb-lg-0">
						<?= __( 'Aquesta actuació està impulsada i subvencionada pel Servei Públic d\'Ocupació de Catalunya i finançada al 100% pel Fons Social Europeu com a part de la resposta de la Unió Europea a la pandèmia de COVID-19.', 'prioritat' ) ?>
					</p>
				</div>
				<div class="col-lg-6 d-flex align-items-center">
					<img src="<?= get_stylesheet_directory_uri() ?>/images/partners/logos-UE_SOC_NGC_Gencat-1080px.png" class="img-fluid" alt="">
				</div>
			</div>

			<hr class="mt-3">

			<div class="row align-items-center" id="diputacio-tarragona">
				<div class="col-md-7">
					<p class="disclaimer mb-md-0">
						<?= __( 'Els continguts de les càpsules de la informació digital han estat finançats per la Diputació de Tarragona.', 'prioritat' ) ?>
					</p>
				</div>
				<div class="col-md-5 d-flex align-items-center">
					<img class="inline-svg" src="<?= get_stylesheet_directory_uri() ?>/images/partners/diputacio-tarragona.svg" class="img-fluid" alt="<?= __( 'Diputació de Tarragona', 'prioritat' ) ?>">
				</div>
			</div>

			<hr class="mt-3">

			<div class="col-md-12">
				<div class="copyright text-md-center">
					<span><b><?= __( 'Fotografia', 'prioritat' ) ?> /</b> &copy; de les imatges Arxiu PNMontsant / &copy;Jordi Blay / &copy;Rafael Lòpez-Monné / &copy;Susanne Schmelzer / &copy;Xavier Vaqué / &copy;Júlia Viejobueno</span>
					<br>
					<span><b><?= __( 'Disseny Identitat', 'prioritat' ) ?> /</b> <a href="https://carolvanwaart.com/" target="_blank" class="text-decoration-none link-dark">Carol van Waart</a> <b><?= __( 'Disseny i desenvolupament web', 'prioritat' ) ?> /</b> <a href="https://latempesta.cc/" target="_blank" class="text-decoration-none link-dark">La Tempesta</a></span>
				</div>
			</div>

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

