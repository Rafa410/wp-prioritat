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

<div class="wrapper bg-dark text-light" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="row site-footer" id="colophon">

					<div class="col-sm my-3 my-sm-0 logo-wrapper d-flex justify-content-center align-items-center">
						<?= wp_get_attachment_image( 125, 'medium', false, array( 'class' => 'img-fluid' ) ); ?>
					</div>

					<div class="col-sm my-3 my-sm-0 actions-wrapper d-flex flex-sm-column gap-2 justify-content-center align-items-center">
						<a href="https://cloud.prioritat.local" class="btn btn-tertiary py-1 fw-bold">
							<span><?= __( 'Àrea soci', 'prioritat' ) ?></span>
						</a>
						<a href="<?= site_url( '/fes-te-soci' ) ?>" class="btn btn-outline-tertiary py-1 fw-bold">
							<span><?= __( 'Fes-te soci', 'prioritat' ) ?></span>
						</a>
					</div>

					<div class="col-sm my-3 my-sm-0 menu-wrapper">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
					</div>

					<div class="col-lg-4 my-3 my-sm-0 partners-wrapper">
						<p class="small"><?= __( 'Amb el suport de: ', 'prioritat' ) ?></p>
						<div class="row partner-list align-items-center gap-3">
							<div class="partner">
								<img class="inline-svg" id="diputacio-tarragona" src="<?= get_stylesheet_directory_uri() ?>/images/partners/diputacio-tarragona.svg" alt="<?= __( 'Diputació de Tarragona', 'prioritat' ) ?>">
							</div>
							<div class="partner small">
								<img class="inline-svg" id="fundacio-caixa" src="<?= get_stylesheet_directory_uri() ?>/images/partners/fundacio-caixa.svg" alt="<?= __( 'Fundació la caixa', 'prioritat' ) ?>">
							</div>
							<div class="partner">
								<img class="inline-svg" id="gencat-cultura" src="<?= get_stylesheet_directory_uri() ?>/images/partners/gencat-cultura.svg" alt="<?= __( 'Generalitat de Catalunya: Departament de Cultura', 'prioritat' ) ?>">
							</div>
							<div class="partner small">
								<img class="inline-svg" id="serra-montsant" src="<?= get_stylesheet_directory_uri() ?>/images/partners/serra-montsant.svg" alt="<?= __( 'Parc Natural de la Serra del Montsant', 'prioritat' ) ?>">
							</div>
						</div>
					</div>

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

