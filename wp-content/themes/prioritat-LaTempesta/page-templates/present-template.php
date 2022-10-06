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

									<?php
									$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
									$args = array(
										'post_type' => 'noticies',
										'posts_per_page' => 6,
										'orderby' => 'date',
										'order' => 'DESC',
										'paged' => $paged,
									);
									
									// Check if there is a search query
									if ( '' !== get_query_var( 'search' ) ) {
										$args['s'] = get_query_var( 'search' );
									}

									// Check if there is a category query and convert it to a custom taxonomy query
									if ( isset( $_GET['category_name'] ) ) {
										$args['tax_query'] = array(
											array(
												'taxonomy' => 'categoria_noticies',
												'field' => 'slug',
												'terms' => $_GET['category_name'],
											),
										);
									}

									// Check if there is a sort by query
									if ( isset( $_GET['orderby'] ) ) {
										$args['orderby'] = $_GET['orderby'];
									}
									if ( isset( $_GET['order'] ) ) {
										$args['order'] = $_GET['order'];
									}
									
									global $custom_query;
									$custom_query = new WP_Query( $args );
									?>

									<div class="searchform-wrapper searchform-noticies d-flex flex-wrap align-items-center my-3">
										<?php get_search_form( array(
											'echo' => true,
											'aria_label' => __( 'Notícies', 'prioritat' ),
										) ); ?>
									</div>

									<div class="row justify-content-between">
										<!-- Categories -->
										<div class="col-md-8 category-filters">
											<ul class="list-unstyled d-flex flex-wrap">
												<?php
													$categories = get_terms( array(
														'taxonomy' => 'categoria_noticies',
														'orderby' => 'name',
														'order'   => 'ASC',
														'hide_empty' => true,
													) );

													// Get current URL args	
													$current_args = [];
													if ( isset( $_GET['search'] ) && '' !== $_GET['search'] ) {
														$current_args['search'] = $_GET['search'];
													}
													if ( '' !== get_query_var( 'orderby' ) ) {
														$current_args['orderby'] = get_query_var( 'orderby' );
													}
													if ( isset( $_GET['order'] ) ) {
														$current_args['order'] = get_query_var( 'order' );
													}
												
													
													if ( get_query_var( 'category_name' ) !== '' ) {
														?>
															<li>
																<a href="<?= add_query_arg( $current_args, home_url( $wp->request ) ) ?>#noticies"><?= __( 'Totes', 'prioritat' ) ?></a>
															</li>
														<?php
													}
	
													foreach( $categories as $category ) {
	
														// Don't include the uncategorized categories
														$uncategorized_categories = array( 'sense-categoria', 'uncategorized', 'sin-categoria' );
														if ( ! in_array( $category->slug, $uncategorized_categories ) ) {
															$category_args = array( 
																'category_name' => $category->slug,
															);
															$category_url = add_query_arg( 
																array_merge( $current_args, $category_args ),
																get_pagenum_link( 1, false )
															) . '#noticies';
															$category_link = sprintf( 
																'<a href="%1$s" title="%2$s">%3$s</a>',
																esc_url( $category_url ),
																esc_attr( sprintf( __( 'Veure tots els articles de la categoria %s', 'prioritat' ), $category->name ) ),
																esc_html( $category->name )
															);
	
															$is_current_category = $category->slug === get_query_var( 'category_name' );
															?>
	
															<li <?php if ( $is_current_category ) : ?>class="current-cat"<? endif; ?>>
																<?= sprintf( esc_html__( '%s', 'prioritat' ), $category_link ) ?>
															</li>
															
															<?php
														}
	
													}
												?>
											</ul>
										</div>
		
										<!-- Sort by -->
										<div class="col-md-4 text-end mb-3 mb-md-0">
											<div class="dropdown">
												<?php
													$sort_by_options = array(
														[
															'label' => __( 'Títol (A-Z)', 'prioritat' ),
															'args' => array(
																'orderby' => 'title',
																'order' => 'ASC',
															),
														],
														[
															'label' => __( 'Títol (Z-A)', 'prioritat' ),
															'args' => array(
																'orderby' => 'title',
																'order' => 'DESC',
															),
														],
														[
															'label' => __( 'Data (més nous)', 'prioritat' ),
															'args' => array(
																'orderby' => 'date',
																'order' => 'DESC',
															),
														],
														[
															'label' => __( 'Data (més antics)', 'prioritat' ),
															'args' => array(
																'orderby' => 'date',
																'order' => 'ASC',
															),
														],
													);
												?>
												<button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownSortBy" data-bs-toggle="dropdown" aria-expanded="false">
													<?php 
													echo __( 'Ordenar per', 'prioritat' );
													if ( isset( $_GET['orderby'] ) ) {
														foreach( $sort_by_options as $option ) {
															if ( $option['args']['orderby'] === $_GET['orderby'] && $option['args']['order'] === $_GET['order'] ) {
																echo ': <small>' . $option['label'] . '</small>';
															}
														}
													} ?>
												</button>
												<ul class="dropdown-menu" aria-labelledby="dropdownSortBy">
	
													<?php foreach ( $sort_by_options as $option ) : ?>
														<!-- Add current URL args  -->
														<?php
															$option_args = [];
															if ( isset( $_GET['post_type'] ) ) {
																$option_args['post_type'] = $_GET['post_type'];
															}
															if ( isset( $_GET['search'] ) ) {
																$option_args['search'] = $_GET['search'];
															}
															if ( isset( $_GET['category_name'] ) ) {
																$option_args['category_name'] = $_GET['category_name'];
															}
															$option_args = array_merge( $option_args, $option['args'] );
															$sortby_link = add_query_arg( $option_args, home_url( $wp->request ) );
															$is_current_sortby = $option_args['orderby'] === $_GET['orderby'] && $option_args['order'] === $_GET['order'];
														?>
														<li>
															<a 
																class="dropdown-item <?php if ( $is_current_sortby ) : ?>disabled<?php endif; ?>"
																href="<?= $sortby_link ?>#noticies">
																<?= $option['label'] ?>
															</a>
														</li>
													<?php endforeach; ?>
	
												</ul>
											</div>
										</div>
									</div>

									<div class="post-list post-noticies-list py-3">

										<?php
										if ( $custom_query->have_posts() ) {
											while ( $custom_query->have_posts() ) {
												$custom_query->the_post();
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
										'total'        => $custom_query->max_num_pages,
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
