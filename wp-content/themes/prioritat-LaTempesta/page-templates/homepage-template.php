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

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<section id="values">

						<div class="values-list d-flex flex-wrap gap-3 justify-content-center">

							<div class="value p-3" id="mermership">
								
								<header>
									<h3>Pertinença</h3>
								</header>
								<p class="description lh-sm">
									Sense persones no hi ha paisatge. El paisatge del Priorat és un mosaic divers i ric, ple de contrastos derivats de la interacció dels seus habitants amb el territori. La disposició del paisatge ens mostra el transcurs de la història humana, diferenciant espais forestals, urbans i agrícoles.
								</p>
								<a href="#" class="read-more">Més informació</a>

							</div>

							<div class="value p-3" id="harmony">
								
								<header>
									<h3>Harmonia del paisatge</h3>
								</header>
								<p class="description lh-sm">
									L'harmonia és una característica del mosaic paisatgístic del Priorat. Els pobles s'integren plenament a l'orografia del territori, connectats per una xarxa de camins densa, rica i ben conservada. El paisatge engloba els espais naturals, cultius tradicionals, patrimoni històric i arquitectònic.
								</p>
								<a href="#" class="read-more">Més informació</a>

							</div>

							<div class="value p-3" id="culture">
								
								<header>
									<h3>Cultura natural</h3>
								</header>
								<p class="description lh-sm">
									La vida socioeconòmica es troba plenament integrada a l'entorn, ric i divers en flora i fauna, donant lloc a una particular cultura indissociable del medi. Tot plegat estableix un lligam de gran trascendència històrica entre cultura i natura, donant lloc a un equilibri natural, humà i social que conforma la nostra identitat.
								</p>
								<a href="#" class="read-more">Més informació</a>

							</div>

							<div class="value p-3" id="heritage">
								
								<header>
									<h3>Patrimoni immaterial</h3>
								</header>
								<p class="description lh-sm">
									Sense persones no hi ha paisatge. El paisatge del Priorat és un mosaic divers i ric, ple de contrastos derivats de la interacció dels seus habitants amb el territori. La disposició del paisatge ens mostra el transcurs de la història humana, diferenciant espais forestals, urbans i agrícoles.
								</p>
								<a href="#" class="read-more">Més informació</a>

							</div>

						</div>

					</section>

					<section id="agenda" class="my-5">

						<header>
							<h2 class="bg-title bg-title-tertiary">Agenda</h2>
						</header>

						<div class="row g-0 align-items-center">

							<div class="col-md-5 p-3">
								<div class="calendar-monthly-view"></div>
							</div>

							<div class="col-md-7 ps-0 ps-sm-4">
								<div class="calendar-list-view">
									<div class="calendar-event d-flex my-3">
										<div class="event-date p-3 bg-primary">
											<span class="day">06</span>
											<span class="month">abril</span>
										</div>
										<div class="event-content p-2">
											<h3 class="title">Títol de l'activitat, lorem ipsum dolor sit amet, consetetur sadipscing</h3>
											<p class="description">Informació sobre l'activitat, super breu lorem ipsum dolor sit amet, consetetur sadipscing</p>
										</div>
									</div>
									<div class="calendar-event d-flex my-3">
										<div class="event-date p-3 bg-primary">
											<span class="day">15</span>
											<span class="month">abril</span>
										</div>
										<div class="event-content p-2">
											<h3 class="title">Títol de l'activitat, lorem ipsum dolor sit amet, consetetur sadipscing</h3>
											<p class="description">Informació sobre l'activitat, super breu lorem ipsum dolor sit amet, consetetur sadipscing</p>
										</div>
									</div>
									<div class="calendar-event d-flex my-3">
										<div class="event-date p-3 bg-secondary">
											<span class="day">23</span>
											<span class="month">abril</span>
										</div>
										<div class="event-content p-2">
											<h3 class="title">Títol de l'activitat, lorem ipsum dolor sit amet, consetetur sadipscing</h3>
											<p class="description">Informació sobre l'activitat, super breu lorem ipsum dolor sit amet, consetetur sadipscing</p>
										</div>
									</div>
								</div>
							</div>

						</div>

					</section>

					<section id="latest-news" class="my-5">

						<header>
							<h2 class="bg-title bg-title-tertiary mb-4">Últimes notícies</h2>
						</header>

						<div class="row g-0">

							<div class="post-list col-lg-8 d-flex flex-wrap align-items-start justify-content-between py-3 pe-2 pe-md-3">

								<?php
								$args = array(
									'post_type' => 'post',
									'posts_per_page' => 4,
								);
								$query = new WP_Query( $args );
								
								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) {
										$query->the_post();
										get_template_part( 'loop-templates/content', get_post_type() );
									}
								} else {
									echo '<p>No s\'han trobat notícies recents.</p>';
								}
								
								wp_reset_postdata();
								?>

							</div>

							<div class="noticeboard col-lg-4 d-flex flex-column ps-3">
								<h3>Taulell d'anuncis</h3>
								<?= do_shortcode( '[latest_announcements]' ) ?>
							</div>

						</div>

					</section>

					<section id="forums" class="my-5">

						<header>
							<h2 class="bg-title bg-title-tertiary mb-4">Coneix els fòrums</h2>
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
