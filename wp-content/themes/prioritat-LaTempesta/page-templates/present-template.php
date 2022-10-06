<?php
/**
 * Template Name: Pàgina Actualitat
 *
 * Template for displaying the present page.
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

<div id="present-page-wrapper">

	<div class="container-fluid p-0" id="content">

		<div class="row g-3">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<header class="page-header py-4 px-4 <?php if ( ! has_post_thumbnail() ): ?>no-img<?php endif; ?>">

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

								<section id="agenda" class="my-5 py-3">

									<header>
										<h2 class="title-underline"><?= __( 'Agenda', 'prioritat' ) ?></h2>
									</header>

									<div class="row g-0 align-items-center">

										<div class="col-md-5 p-lg-3">
											<?= do_shortcode( '[agenda view="monthly"]' ) ?>
										</div>

										<div class="col-md-7 ps-0 ps-sm-4">
											<?= do_shortcode( '[agenda view="list" limit="3"]' ) ?>
										</div>

									</div>

								</section>

								<section id="noticies" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3"><?= __( 'Notícies', 'prioritat' ) ?></h2>
									</header>

									<div class="post-list post-noticies-list py-3">

										<?php
										$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
										$args = array(
											'post_type' => 'noticies',
											'posts_per_page' => 6,
											'orderby' => 'date',
											'order' => 'DESC',
											'paged' => $paged,
										);
										$query = new WP_Query( $args );
										
										if ( $query->have_posts() ) {
											while ( $query->have_posts() ) {
												$query->the_post();
												get_template_part( 'loop-templates/content', get_post_type() );
											}
										} else {
											echo '<p class="fw-light text-muted fs-5">' . __( 'No s\'han trobat notícies recents.', 'prioritat' ) . '</p>';
										}
										
										?>

									</div>

									<!-- The pagination component -->
									<?php understrap_pagination(array(
										'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
										'total'        => $query->max_num_pages,
										'format'       => '?paged=%#%',
										'add_fragment' => '#noticies',
									)); ?>

									<?php wp_reset_postdata(); ?>

								</section>

								<section id="prioritat-media" class="my-5 py-3">

									<header>
										<h2 class="title-underline mb-3"><?= __( 'Prioritat als mitjans', 'prioritat' ) ?></h2>
									</header>

									<div class="row mitjans-list py-3" data-masonry='{"percentPosition": true }'>

										<?php
										$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
										$args = array(
											'post_type' => 'mitjans',
											'posts_per_page' => 12,
											'orderby' => 'date',
											'order' => 'DESC',
											'paged' => $paged,
										);
										$query = new WP_Query( $args );
										
										if ( $query->have_posts() ) {
											while ( $query->have_posts() ) {
												$query->the_post();
												echo '<div class="col-sm-6 col-lg-4">';
												get_template_part( 'loop-templates/content', get_post_type() );
												echo '</div>';
											}
										} else {
											echo '<p class="fw-light text-muted fs-5">' . __( 'No s\'han trobat notícies recents.', 'prioritat' ) . '</p>';
										}
										
										?>

									</div>

									<!-- The pagination component -->
									<?php understrap_pagination(array(
										'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
										'total'        => $query->max_num_pages,
										'format'       => '?paged=%#%',
									)); ?>

									<?php wp_reset_postdata(); ?>

								</section>

							</div>

						</div>

					</div>

					<div class="container-fluid p-0">
						
						<section id="newsletter" class="bg-secondary my-5 p-5">

							<div class="container">
								
								<header>
									<h2 class="mb-3">
										<?= __( 'Subscriu-te al bulletí', 'prioritat' ) ?>
									</h2>
								</header>
		
								<div>
									<?= get_field( 'newsletter_content' ) ?>
								</div>
		
								<a href="#subscribe" class="btn btn-outline-dark fw-bold">
									<?= __( 'Subscriu-te', 'prioritat' ) ?>
								</a>
								
							</div>
	
						</section>

					</div>

					<div class="container">

						<div class="row">
							
							<div class="col-md-12">

								<section id="prioritat-network" class="my-5 py-3">
			
									<header>
										<h2 class="mb-3"><?= __( 'Prioritat a les xarxes', 'prioritat' ) ?></h2>
									</header>

									<div>
										<?= get_field( 'prioritat_network' ); ?>
									</div>
			
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
