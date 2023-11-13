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

								<section id="contact-form" class="mt-5">

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
