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
						<a href="<?= site_url( '/fes-te-soci' ) ?>" class="btn btn-outline-dark py-1 px-2 fw-bold small">
							<span><?= __( 'Fes-te soci', 'prioritat' ) ?></span>
						</a>
					</div>

					<div class="col-sm my-3 my-sm-0 menu-wrapper">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
					</div>

					<div class="col-lg-4 my-3 my-sm-0 partners-wrapper d-flex flex-column justify-content-center">
						<p class="small"><?= __( 'Amb el suport de: ', 'prioritat' ) ?></p>
						<div class="row partner-list align-items-center gap-3">
							<div class="partner diputacio-tarragona me-3">
								<img class="inline-svg" id="diputacio-tarragona" src="<?= get_stylesheet_directory_uri() ?>/images/partners/diputacio-tarragona.svg" alt="<?= __( 'Diputació de Tarragona', 'prioritat' ) ?>">
							</div>
							<div class="partner fundacio-caixa">
								<img class="inline-svg" id="fundacio-caixa" src="<?= get_stylesheet_directory_uri() ?>/images/partners/fundacio-caixa.png" alt="<?= __( 'Fundació la caixa', 'prioritat' ) ?>">
							</div>
							<div class="partner gencat-cultura">
								<img class="inline-svg" id="gencat-cultura" src="<?= get_stylesheet_directory_uri() ?>/images/partners/gencat-cultura.svg" alt="<?= __( 'Generalitat de Catalunya: Departament de Cultura', 'prioritat' ) ?>">
							</div>
							<div class="partner serra-montsant">
								<img class="inline-svg" id="serra-montsant" src="<?= get_stylesheet_directory_uri() ?>/images/partners/serra-montsant.png" alt="<?= __( 'Parc Natural de la Serra del Montsant', 'prioritat' ) ?>">
							</div>
						</div>
					</div>

				</footer><!-- #colophon -->

			</div><!--col end -->

			<hr>

			<div class="col-md-12">
				<div class="copyright text-md-center">
					<span><b>Fotografia /</b> &copy; de les imatges Arxiu PNMontsant / &copy;Jordi Blay / &copy;Rafael Lòpez-Monné / &copy;Susanne Schmelzer / &copy;Xavier Vaqué / &copy;Júlia Viejobueno</span>
					<br>
					<span><b>Disseny Identitat /</b> Carol van Waart <b>Desenvolupament web /</b> <a href="https://latempesta.cc/" target="_blank" class="text-decoration-none link-dark">La Tempesta</a></span>
				</div>
			</div>

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

