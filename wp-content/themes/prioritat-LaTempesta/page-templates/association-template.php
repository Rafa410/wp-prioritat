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

										<div class="col-12">
											<?php the_content(); ?>
										</div>

									</div>

								</section>

								<section id="goals" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Objectius', 'prioritat' ) ?>
										</h2>
									</header>

									<?php $goals = get_field( 'goals' ); ?>

									<p><?= __( 'Segons els estatuts fundacionals els objectius de l\'entitat son:', 'prioritat' ) ?></p>

									<div class="goals-list py-3">

										<?php foreach ( $goals as $goal ): ?>
											<div class="goal">
												<?= $goal['goal_description'] ?>
											</div>
										<?php endforeach; ?>

									</div>

								</section>

								<section id="strategic-lines" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Línies estratègiques', 'prioritat' ) ?>
										</h2>
									</header>

									<?php $strategic_lines = get_field( 'strategic_lines' ); ?>

									<div class="strategic-lines-list">

										<?php foreach ( $strategic_lines as $index => $strategic_line ): ?>
											<div class="strategic-line p-4 bg-<?= $strategic_line['color'] ?>">
												<p class="strategic-line__title h1 mb-3"><?= $index + 1 ?></p>
												<div>
													<?= $strategic_line['description'] ?>
												</div>
											</div>
										<?php endforeach; ?>

									</div>

								</section>

								<section id="past" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Antecedents', 'prioritat' ) ?>
										</h2>
									</header>

									<?php $antecedents = get_field( 'antecedents' ); ?>

									<?php if ( $antecedents['image'] ) : ?>

										<div class="row">
	
											<div class="col-md-7">
												<?= $antecedents['description'] ?>
											</div>
	
											<div class="col-md-5">
												<?= wp_get_attachment_image( $antecedents['image'], 'large' ) ?>
											</div>
	
										</div>

									<?php else : ?>

										<div class="antecedents__description">
											<?= $antecedents['description'] ?>
										</div>

									<?php endif; ?>

								</section>

							</div>

						</div>

					</div>

					<div class="container-fluid p-0">
						
						<section id="timeline-wrapper" class="bg-gray-200 my-5 p-5">
	
							<div class="container">
								<div class="row">
									<div class="col-12">

										<header>
											<h2 class="mb-3">
												<?= __( 'Cronologia', 'prioritat' ) ?>
											</h2>
										</header>
				
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

									</div>
								</div>
							</div>
	
						</section>

					</div>

					<div class="container">

						<div class="row">
							
							<div class="col-md-12">

								<section id="organization" class="my-5 py-3">
			
									<header>
										<h2 class="title-underline mb-3"><?= __( 'Organització', 'prioritat' ) ?></h2>
									</header>

									<?php
									$args = array(
										'post_type' => 'organization_items',
										'posts_per_page' => -1,
										'orderby' => 'date',
										'order' => 'ASC'
									);
									$query = new WP_Query( $args );
									?>

									<?php if ( $query->have_posts() ) : ?>

										<div class="accordion accordion-flush" id="accordionOrganization">

											<?php 
												while ( $query->have_posts() ) {
													$query->the_post();
													get_template_part( 
														'loop-templates/content', 
														get_post_type(),
														array(
															'accordion_id' => 'accordionOrganization',
														)
													);
												}
												wp_reset_postdata(); 
											?>

										</div>

									<?php endif; ?>

								</section>
													
								<section id="partners-wrapper" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3">
											<?= __( 'Socis i col·laboradors', 'prioritat' ) ?>
										</h2>
									</header>

									<?php
									$args = array(
										'post_type' => 'socis',
										'posts_per_page' => -1,
										'orderby' => 'title',
										'order' => 'ASC'
									);
									$query = new WP_Query( $args );
									?>

									<?php if ( $query->have_posts() ) : ?>

										<div class="socis-list__nav">

											<?php
												$prev_char = '';
												while ( $query->have_posts() ) {
													$query->the_post();
													get_template_part( 
														'loop-templates/content', 
														get_post_type() . '-nav',
														array(
															'prev_char' => $prev_char,
														)
													);
													$prev_char = mb_strtoupper( mb_substr( get_the_title(), 0, 1 ) );
												}

												// Rewind the query for future use
												rewind_posts();
											?>

											</div> <!-- .socis-nav-item -->

										</div>

										<div class="socis-list">

											<?php 
												$prev_char = '';
												while ( $query->have_posts() ) {
													$query->the_post();
													get_template_part( 
														'loop-templates/content', 
														get_post_type(),
														array(
															'prev_char' => $prev_char,
														)
													);
													$prev_char = mb_strtoupper( mb_substr( get_the_title(), 0, 1 ) );
												}
												wp_reset_postdata(); 
											?>

											</ul> <!-- .socis-list-group -->

										</div>

									<?php endif; ?>

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
