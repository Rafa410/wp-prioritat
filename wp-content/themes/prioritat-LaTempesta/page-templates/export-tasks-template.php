<?php
/**
 * Template Name: Export tasks Page
 *
 * Template for displaying the export tasks page.
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/ical.js/1.5.0/ical.min.js" integrity="sha512-0izBc1upGYnrS1u1MX7QR+sjFIxZWxLVdNI7cUoHHCutDr5ENjuQRZuS+v+3NFNGfwHSrPoHzBzED0rV651tGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div id="export-tasks-wrapper">

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

								<section id="reasons" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Exportar tasques de la Extranet', 'prioritat' ) ?>
										</h2>
									</header>

									<p>
										<?= __( 'Des d\'aquest formulari podràs exportar toda la informació relacionada amb les tasques, subtasques i projectes definits a l\'aplicació <b>Tasks</b> de la extranet.', 'prioritat' ) ?>
									</p>

									<?php
										$user_id = get_current_user_id();
										$extranet_username = get_user_meta( $user_id, 'extranet_username', true );
									?>
									<form action="<?= admin_url( 'admin-ajax.php' ) ?>" method="post" id="export-tasks-form" class="ajax-form">
										<input type="hidden" name="action" value="export_extranet_tasks">
										
										<div class="form-group my-3">
											<label for="username" class="fw-medium">
												<?= __( 'Nom d\'usuari', 'prioritat' ) ?>
											</label>
											<input
												type="text"
												class="form-control"
												id="username"
												name="username"
												placeholder="<?= __( 'Introdueix el teu nom d\'usuari o email d\'accés a la extranet', 'prioritat' ) ?>"
												value="<?= esc_attr( $extranet_username ) ?>"
												required>
										</div>
										
										<div class="form-group my-3">
											<label for="password" class="fw-medium">
												<?= __( 'Contrasenya', 'prioritat' ) ?>
											</label>
											<input
												type="password"
												class="form-control"
												id="password"
												name="password"
												placeholder="<?= __( 'Introdueix la teva contrasenya d\'accés a la extranet', 'prioritat' ) ?>"
												required>
										</div>
										
										<div class="form-group my-3">
											<label for="url" class="fw-medium d-flex align-items-center gap-2">
												<?= __( 'Enllaç de la Extranet', 'prioritat' ) ?>
												<button type="button" class="btn btn-icon btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#extranet_url_screenshot">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
														<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
														<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
													</svg>
												</button>
											</label>
											<input
												type="text"
												class="form-control"
												id="url"
												name="url"
												placeholder="<?= __( 'https://', 'prioritat' ) ?>"
												required>
										</div>

										<div class="form-group my-3">
											<label for="format" class="fw-medium">
												<?= __( 'Format', 'prioritat' ) ?>
											</label>
											<select class="form-select" id="format" name="format" required>
												<option value="html">HTML</option>
												<option value="csv">CSV</option>
												<option value="pdf">PDF</option>
											</select>
										</div>
										
										<button type="submit" class="btn btn-primary fw-medium">
											<?= __( 'Exportar', 'prioritat' ) ?>
										</button>

										<hr>

										<pre class="form-success"></pre>
										<div class="form-error text-danger"></div>
									</form>
									
									<div class="modal fade" id="extranet_url_screenshot" tabindex="-1" aria-labelledby="extranet_url_screenshot_Label" aria-hidden="true">
										<div class="modal-dialog modal-lg modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-header">
													<h1 class="modal-title visually-hidden" id="extranet_url_screenshot_Label">
														<?= __( 'Captura de pantalla de la Extranet', 'prioritat' ) ?>
													</h1>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body text-center">
													<?= wp_get_attachment_image( 283, 'full' ) ?>
												</div>
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
