<?php
/**
 * Template Name: Contact Page
 *
 * Template for displaying the contact page.
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

<div id="contact-page-wrapper">

	<div class="container-fluid p-0" id="content">

		<div class="row g-0">

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

								<section id="contact-info">

									<div class="contact-info-list">

										<?php 
										$contact_items = get_field( 'contact_items' );

										foreach ( $contact_items as $contact_item ) : ?>

											<div class="contact-block bg-<?= $contact_item['color'] ?> p-4 py-lg-5">
												
												<?= wp_get_attachment_image( $contact_item['icon_id'], 'medium', true, array( 'class' => 'contact-block__icon' ) ); ?>

												<h2 class="contact-block__title">
													<?= $contact_item['title'] ?>
												</h2>

												<div class="contact-block__text">
													<?= $contact_item['description'] ?>
												</div>

											</div>

										<?php endforeach; ?>

									</div>

									<!-- <div class="row gy-4">

										<div class="col-sm-4">

											<div class="contact-block bg-primary p-4 py-lg-5">

												<svg class="contact-block__icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
													<path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
												</svg>
	
												<h2 class="contact-block__title fw-bold"><?= __( 'Adreça', 'prioritat' ) ?></h2>
	
												<a class="contact-block__text link-dark" href="https://www.google.com/maps/place/Apartat+de+Correus+98+43730+Falset,+Tarragona" target="_blank" rel="noopener noreferrer">
													Apartat de Correus 98<br>
													43730 Falset, Tarragona
												</a>

											</div>

										</div>

										<div class="col-sm-4">

											<div class="contact-block bg-tertiary p-4 py-lg-5">

												<svg class="contact-block__icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
													<path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
												</svg>
	
												<h2 class="contact-block__title fw-bold"><?= __( 'Correu electrònic', 'prioritat' ) ?></h2>
	
												<a class="contact-block__text link-dark" href="mailto:xarxa@prioritat.cat">
													xarxa@prioritat.cat
												</a>

											</div>

										</div>

										<div class="col-sm-4">

											<div class="contact-block bg-secondary p-4 py-lg-5">
												
												<svg class="contact-block__icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
													<path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
												</svg>
	
												<h2 class="contact-block__title fw-bold"><?= __( 'Telèfon', 'prioritat' ) ?></h2>
	
												<a class="contact-block__text link-dark" href="tel:+34600900900">
													+34 600 900 900
												</a>

											</div>

										</div>

									</div>		 -->
			
								</section>

								<section id="contact-form" class="mt-5 pt-5">

									<header>
										<h2 class="section-title title-underline fw-extrabold"><?= __( 'Escriu-nos', 'prioritat' ) ?></h2>
									</header>

									<div class="section-description mt-4 mb-5">
										<p class="fw-semibold">
											<?= __( 'Si tens qualsevol dubte sobre Prioritat o vols fer-nos algun comentari, no dubtis a escriure-nos.', 'prioritat' ) ?>
										</p>
									</div>

									<?= do_shortcode( '[contact-form-7 id="159" title="Formulari de contacte"]' ) ?>

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
