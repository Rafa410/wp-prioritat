<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="error-404-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main">

					<section class="error-404 not-found">

						<header class="page-header d-flex flex-column justify-content-end mb-5">

							<div class="header-content">
								<h1 class="page-title"><?php esc_html_e( 'Vaja! Aquesta pàgina no s\'ha pogut trobar.', 'prioritat' ); ?></h1>
							</div>

							<div class="dot-pattern p-2 pt-5">
								<img class="inline-svg text-muted" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
							</div>

						</header><!-- .page-header -->

						<div class="page-content">

							<p><?php esc_html_e( 'Sembla que no s\'ha trobat res en aquest lloc. Pots provar amb una cerca.', 'prioritat' ); ?></p>

							<?php get_search_form(); ?>

							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

							<?php if ( understrap_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>

								<div class="widget widget_categories">

									<h2 class="widget-title"><?php esc_html_e( 'Categories més populars', 'prioritat' ); ?></h2>

									<ul>
										<?php
										wp_list_categories(
											array(
												'orderby'  => 'count',
												'order'    => 'DESC',
												'show_count' => 1,
												'title_li' => '',
												'number'   => 10,
											)
										);
										?>
									</ul>

								</div><!-- .widget -->

							<?php endif; ?>

							<?php

							/* translators: %1$s: smiley */
							$archive_content = '<p>' . sprintf( esc_html__( 'També pots cercar als arxius mensuals. %1$s', 'prioritat' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

							the_widget( 'WP_Widget_Tag_Cloud' );
							?>

						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php
get_footer();
