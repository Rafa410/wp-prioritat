<?php
/**
 * Template Name: Home page
 *
 * Template for displaying the home page.
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

<div class="wrapper py-5" id="full-width-page-wrapper">

	<main class="site-main" id="main" role="main">

		<div id="content">

			<div class="<?php echo esc_attr( $container ); ?>">
		
				<div class="row">
		
					<div class="col-md-12 content-area" id="primary">

						<section id="presentation" class="mb-4 py-3">
							<?php the_content(); ?>
						</section>

						<section id="values">

							<header>
								<h2 class="title-underline fw-extrabold mb-4"><?= __( 'Valors', 'prioritat' ) ?></h2>
							</header>

							<div class="summary col-lg-11 col-xl-10 lh-sm">
								<p>Els valors són el conjunt de qualitats que posseeix un bé. Qualitats i característiques que li venen donades per la seua naturalesa primera (la geologia, l’orografia, el clima, la flora i la fauna) i pel resultat produït al llarg dels segles en aquesta naturalesa, per l’acció de les persones que l’han habitat, l’han transformat per viure-hi i n’han construït la identitat. <b>És el que diem un paisatge cultural.</b></p>
							</div>

							<div class="values-list d-flex flex-wrap gap-3 justify-content-center">

								<?php
								
								$args = array(
									'post_type' => 'valors',
									'posts_per_page' => -1,
									'orderby' => 'date',
									'order' => 'ASC'
								);

								$values = new WP_Query( $args );

								if ( $values->have_posts() ) {

									while ( $values->have_posts() ) {
										$values->the_post();
										get_template_part( 'loop-templates/content', get_post_type(), array(
											'index' => $values->current_post + 1,
										) );
									}
								}

								wp_reset_postdata();

								?>

							</div>

						</section>

						<section id="agenda" class="my-5 py-3">

							<header>
								<h2 class="title-underline fw-extrabold"><?= __( 'Agenda d\'activitats', 'prioritat' ) ?></h2>
							</header>

							<div class="row g-0 align-items-center justify-content-between">

								<div class="col-lg-5 p-lg-3">
									<?= do_shortcode( '[agenda view="monthly"]' ) ?>
								</div>

								<div class="col-lg-7 col-xxl-6 ps-0 ps-sm-4">
									<?= do_shortcode( '[agenda view="list" limit="3"]' ) ?>
								</div>

							</div>

						</section>

						<section id="latest-news" class="my-5 py-3">

							<header>
								<h2 class="title-underline fw-extrabold mb-3"><?= __( 'Últimes notícies', 'prioritat' ) ?></h2>
							</header>

							<div class="row g-0">

								<div class="post-list col-lg-8 d-flex flex-wrap gap-4 align-items-start justify-content-between py-3 pe-2 pe-md-4">

									<?php
									$args = array(
										'post_type' => 'noticies',
										'posts_per_page' => 4,
										'orderby' => 'date',
										'order' => 'DESC',
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
									
									wp_reset_postdata();
									?>

									<a href="<?= site_url( '/actualitat/#news' ) ?>" class="read-more btn btn-sm btn-outline-dark fw-semibold my-3">
										<?= __( 'Veure totes', 'prioritat' ) ?>
									</a>

								</div>


								<div class="noticeboard col-lg-4 d-flex flex-column ps-4">
									<h3 class="fw-extrabold"><?= __( 'Taulell d\'anuncis', 'prioritat' ) ?></h3>
									<?= do_shortcode( '[latest_announcements source="wp"]' ) ?>
								</div>

							</div>

						</section>

						<section id="projects" class="my-5 py-3">

							<header>
								<h2 class="title-underline fw-extrabold mb-4">
									<?= __( 'Què fem?', 'prioritat' ) ?>
								</h2>
							</header>

							<?php
							$args = array(
								'post_type' => 'projectes',
								'posts_per_page' => -1,
								'orderby' => 'date',
								'order' => 'ASC'
							);

							$projects = new WP_Query( $args );
							?>

							<?php if ( $projects->have_posts() ) : ?>
								
								<?php $list_type = $projects->found_posts > 3 ? 'projects-carousel' : 'projects-list'; ?>

								<div class="<?= $list_type ?> d-flex flex-wrap gap-4 justify-content-center align-items-start">
									
									<?php
									while ( $projects->have_posts() ) {
										$projects->the_post();
										get_template_part( 
											'loop-templates/content',
											get_post_type(),
											array(
												'list_type' => $list_type,
											),
										);
									}
									?>
		
								</div>

							<?php endif; ?>

							<?php wp_reset_postdata(); ?>

						</section>			
						
					</div><!-- #primary -->
					
				</div><!-- .row end -->
				
			</div><!-- .container end -->
			
			<div class="container-fluid bg-secondary">

				<section id="facts" class="container my-5 py-4">
	
					<header>
						<h2 class="fw-extrabold my-4"><?= __( 'Sabies què...?', 'prioritat' ) ?></h2>
					</header>
	
					<?php
					$args = array(
						'post_type' => 'facts',
						'posts_per_page' => -1,
						'orderby' => 'date',
						'order' => 'DESC'
					);
	
					$facts = new WP_Query( $args );
					?>
	
					<?php if ( $facts->have_posts() ) : ?>

						<?php $list_type = $facts->found_posts > 1 ? 'facts-carousel' : 'facts-single'; ?>
	
						<div class="<?= $list_type ?> d-flex flex-wrap gap-2 justify-content-center align-items-center">
							
							<?php
							while ( $facts->have_posts() ) {
								$facts->the_post();
								get_template_part(  'loop-templates/content', get_post_type() ); 
							}
							?>
	
						</div>
	
					<?php endif; ?>
	
					<?php wp_reset_postdata(); ?>
	
				</section>

			</div>

			<div class="<?php echo esc_attr( $container ); ?>">
		
				<div class="row">
		
					<div class="col-md-12 content-area">

						<section id="mosaic" class="my-5 py-3">

							<header>
								<h2 class="title-underline fw-extrabold mb-4"><?= __( 'Mosaic', 'prioritat' ) ?></h2>
							</header>

							<?php
								$args = array(
									'post_type' => array( 'fotos', 'videos', 'documents' ),
									'posts_per_page' => -1,
									'orderby' => 'date',
									'order' => 'ASC',
								);
								$query = new WP_Query( $args );
							?>

							<div class="mosaic-gallery">

								<?php if ( $query->have_posts() ) : ?>

									<?php while ( $query->have_posts() ) : $query->the_post(); ?>

										<?php get_template_part( 
											'loop-templates/content', 
											get_post_type(),
											array(
												'index' => $query->current_post,	
											) ); ?>

									<?php endwhile; ?>

								<?php endif; ?>

							</div>

							<?php $query->rewind_posts(); ?>

							<div class="mosaic-gallery-modal">

								<?php if ( $query->have_posts() ) : ?>

									<?php while ( $query->have_posts() ) : $query->the_post(); ?>

										<?php get_template_part( 'loop-templates/modal', get_post_type() ); ?>

									<?php endwhile; ?>

								<?php endif; wp_reset_postdata(); ?>

							</div>

						</section>

						<section id="miradors" class="my-5 py-3">

							<header>
								<h2 class="title-underline fw-extrabold mb-4"><?= __( 'Miradors', 'prioritat' ) ?></h2>
							</header>

							<div>
								<?= get_field( 'lookout_content' ) ?>
							</div>

						</section>

					</div><!-- .content-area -->
					
				</div><!-- .row end -->
				
			</div><!-- .container end -->

		</div><!-- #content -->
			
	</main><!-- #main -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
