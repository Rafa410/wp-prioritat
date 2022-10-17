<?php
/**
 * Template Name: Candidacy Page
 *
 * Template for displaying the candidacy page.
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

								<section id="candidature-summary" class="mb-5 py-3">

									<div class="row justify-content-center">

										<div class="col-12 lh-sm">
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

									<div class="reasons-list lh-sm">

										<?php $reasons = get_field( 'reasons_why' ); ?>

										<?php foreach ( $reasons as $reason ): ?>

											<div class="reason bg-secondary p-4">
												<h3 class="reason__title fs-5 fw-bold mb-2">
													<?= $reason['reason_title'] ?>
												</h3>
												<div class="reason__description">
													<?= $reason['reason_description'] ?>
												</div>
											</div>
										
										<?php endforeach; ?>

									</div>

								</section>

								<section id="current-state" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Estat actual de la candidatura', 'prioritat' ) ?>
										</h2>
									</header>

									<div class="current-state__content">
										<?= get_field( 'current_state' ) ?>
									</div>

								</section>

								<section id="antecedents-candidacy" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Antecedents', 'prioritat' ) ?>
										</h2>
									</header>

									<div class="antecedents-candidacy__content">
										<?= get_field( 'antecedents' ) ?>
									</div>

									<h3 class="fw-bold title-underline title-underline-tertiary"><?= __( 'Cronologia', 'prioritat' ) ?></h3>

									<div id="timeline">

											<span id="timeline-tracker"></span>

											<?php
											$cronology_id = get_field( 'cronologia' );
											$args = array(
												'post_type' => 'timeline_events',
												'posts_per_page' => -1,
												// 'meta_key' => 'event_date',
												// 'orderby' => 'meta_value',
												'orderby' => 'date',
												'order' => 'ASC',
												'tax_query' => array(
													array(
														'taxonomy' => 'cronologia',
														'field' => 'term_id',
														'terms' => $cronology_id
													)
												),
											);
											$query = new WP_Query( $args );
											?>

											<div class="timeline-events">

												<?php 
													while ( $query->have_posts() ) {
														$query->the_post();
														get_template_part( 'loop-templates/content', get_post_type() );
													}
													wp_reset_postdata(); 
												?>

											</div>

										</div>

								</section>

								<section id="support" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Com donar suport a la candidatura', 'prioritat' ) ?>
										</h2>
									</header>

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
