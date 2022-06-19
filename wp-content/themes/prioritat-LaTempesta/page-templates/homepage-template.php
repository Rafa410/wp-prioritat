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

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<section id="values">

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
									get_template_part( 'loop-templates/content-valors' );
								}
							}

							wp_reset_postdata();

							?>

						</div>

					</section>

					<section id="agenda" class="my-5">

						<header>
							<h2 class="bg-title bg-title-tertiary"><?= __( 'Agenda', 'prioritat' ) ?></h2>
						</header>

						<div class="row g-0 align-items-center">

							<div class="col-md-5 p-3">
								<?= do_shortcode( '[agenda view="monthly"]' ) ?>
							</div>

							<div class="col-md-7 ps-0 ps-sm-4">
								<?= do_shortcode( '[agenda view="list" limit="3"]' ) ?>
							</div>

						</div>

					</section>

					<section id="latest-news" class="my-5">

						<header>
							<h2 class="bg-title bg-title-tertiary mb-4"><?= __( 'Últimes notícies', 'prioritat' ) ?></h2>
						</header>

						<div class="row g-0">

							<div class="post-list col-lg-8 d-flex flex-wrap align-items-start justify-content-between py-3 pe-2 pe-md-3">

								<?php
								$args = array(
									'post_type' => 'post',
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

							</div>

							<div class="noticeboard col-lg-4 d-flex flex-column ps-3">
								<h3><?= __( 'Taulell d\'anuncis', 'prioritat' ) ?></h3>
								<?= do_shortcode( '[latest_announcements source="wp"]' ) ?>
							</div>

						</div>

					</section>

					<section id="projects" class="my-5">

						<header>
							<h2 class="bg-title bg-title-tertiary mb-4"><?= __( 'Projectes', 'prioritat' ) ?></h2>
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

							<div class="<?= $list_type ?> d-flex flex-wrap gap-2 justify-content-center align-items-center">
								
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

					<section id="forums" class="my-5">

						<header>
							<h2 class="bg-title bg-title-tertiary mb-4"><?= __( 'Coneix els fòrums', 'prioritat' ) ?></h2>
						</header>

						<div class="forums-list d-flex flex-wrap gap-3 justify-content-center">

							<div class="forum p-3" id="agrarian">
								
								<header>
									<h3>Fòrum agrari</h3>
								</header>
								<p class="description lh-sm">
									Breu explicació del forum. Lorem ipsum dolor sit amet, consetetur sadipscing elits, sed diam nonumy eirmod tempor invidunt et labore et dolore magna aliquyam erat, sed diam voluptua.
								</p>
								<a href="#" class="read-more">Més informació</a>

							</div>

							<div class="forum p-3" id="turism">
								
								<header>
									<h3>Fòrum turisme</h3>
								</header>
								<p class="description lh-sm">
									Breu explicació del forum. Lorem ipsum dolor sit amet, consetetur sadipscing elits, sed diam nonumy eirmod tempor invidunt et labore et dolore magna aliquyam erat, sed diam voluptua.
								</p>
								<a href="#" class="read-more">Més informació</a>

							</div>

							<div class="forum p-3" id="teaching">
								
								<header>
									<h3>Fòrum ensenyament</h3>
								</header>
								<p class="description lh-sm">
									Breu explicació del forum. Lorem ipsum dolor sit amet, consetetur sadipscing elits, sed diam nonumy eirmod tempor invidunt et labore et dolore magna aliquyam erat, sed diam voluptua.
								</p>
								<a href="#" class="read-more">Més informació</a>

							</div>

							<div class="forum p-3" id="culture">
								
								<header>
									<h3>Fòrum cultura</h3>
								</header>
								<p class="description lh-sm">
									Breu explicació del forum. Lorem ipsum dolor sit amet, consetetur sadipscing elits, sed diam nonumy eirmod tempor invidunt et labore et dolore magna aliquyam erat, sed diam voluptua.
								</p>
								<a href="#" class="read-more">Més informació</a>

							</div>

							<div class="forum p-3" id="social">
								
								<header>
									<h3>Fòrum social</h3>
								</header>
								<p class="description lh-sm">
									Breu explicació del forum. Lorem ipsum dolor sit amet, consetetur sadipscing elits, sed diam nonumy eirmod tempor invidunt et labore et dolore magna aliquyam erat, sed diam voluptua.
								</p>
								<a href="#" class="read-more">Més informació</a>

							</div>

						</div>

					</section>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
