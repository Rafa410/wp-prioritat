<?php
/**
 * Template Name: Formulari participa
 *
 * Template for displaying the participate form.
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

<div id="participate-form-page-wrapper">

	<div class="container-fluid p-0" id="content">

		<div class="row g-0">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<header class="page-header d-flex py-4 bg-<?= get_field( 'color', $post->ID ) ?> <?php if ( ! has_post_thumbnail() ): ?>no-img<?php endif; ?>">

						<div class="page-image">
							<?= get_the_post_thumbnail( $post->ID, 'full' ); ?>
						</div>

						<div class="container mt-auto">
							<a href="<?= get_permalink( $post->post_parent ); ?>" class="text-decoration-none fw-bold text-uppercase link-dark title-underline title-underline-dark mb-2">
								<?= get_the_title( $post->post_parent ); ?>
							</a>
							<h1 class="page-title text-dark"><?php the_title(); ?></h1>
						</div>

						<div class="dot-pattern p-2 pt-5">
							<img class="inline-svg" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
						</div>

					</header>

					<div class="container py-5">

						<div class="row">

							<div class="col-md-12">

								<?php the_content(); ?>

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
