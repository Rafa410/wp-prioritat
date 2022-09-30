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

									<?php
										$args = array(
											'post_type' => 'how_to_support',
											'posts_per_page' => -1,
											'orderby' => 'date',
											'order' => 'ASC'
										);

										$how_to_support = new WP_Query( $args );
									?>

									<?php if ( $how_to_support->have_posts() ) : ?>

										<div class="how-to-support-list">
											<?php
											while ( $how_to_support->have_posts() ) {
												$how_to_support->the_post();
												get_template_part( 'loop-templates/content', get_post_type() );
											}
											?>
										</div>

									<?php endif; wp_reset_postdata(); ?>

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
								<div><?= get_field( 'forums_summary' ) ?></div>
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
