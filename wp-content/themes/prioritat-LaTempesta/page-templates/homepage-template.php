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

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
