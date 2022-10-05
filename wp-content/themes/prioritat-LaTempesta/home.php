<?php
/**
 * The post archive template file
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

$blog_ID = get_option( 'page_for_posts' );

global $wp;

?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div id="home-wrapper">

	<div class="container-fluid p-0" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<header class="page-header py-4 <?php if ( ! has_post_thumbnail( $blog_ID ) ): ?>no-img<?php endif; ?>">

						<div class="page-image">
							<?= get_the_post_thumbnail( $blog_ID, 'full' ); ?>
						</div>

						<div class="container">
							<h1 class="page-title"><?= __( 'El blog', 'prioritat' ) ?></h1>
						</div>

						<div class="dot-pattern p-2 pt-5">
							<img class="inline-svg" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
						</div>

					</header>

					<div class="wrapper">

						<div class="<?php echo esc_attr( $container ); ?>">
		
							<div class="row" id="resultats-cerca">

								<div class="col-12">

									<div class="searchform-wrapper searchform-post d-flex flex-wrap align-items-center my-3">
										<?php get_search_form( array(
											'echo' => true,
											'aria_label' => __( 'Articles', 'prioritat' ),
										) ); ?>
									</div>
	
									<div class="row justify-content-between">
										<!-- Categories -->
										<div class="col-md-8 category-filters">
											<ul class="list-unstyled d-flex flex-wrap">
												<?php
													$categories = get_categories( array(
														'orderby' => 'name',
														'order'   => 'ASC',
														'hide_empty' => true,
													) );

													// Get current URL args	
													$current_args = [];
													if ( '' !== get_query_var( 'post_type' ) ) {
														$current_args['post_type'] = get_query_var( 'post_type' );
													}
													if ( '' !== get_query_var( 's' ) ) {
														$current_args['s'] = get_query_var( 's' );
													}
													if ( '' !== get_query_var( 'orderby' ) ) {
														$current_args['orderby'] = get_query_var( 'orderby' );
													}
													if ( '' !== get_query_var( 'order' ) ) {
														$current_args['order'] = get_query_var( 'order' );
													}
												
													
													if ( get_query_var( 'category_name' ) !== '' ) {
														?>
															<li>
																<a href="<?= add_query_arg( $current_args, home_url( $wp->request ) ) ?>"><?= __( 'Totes', 'prioritat' ) ?></a>
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
																home_url( $wp->request ) 
															);
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
															if ( isset( $_GET['s'] ) ) {
																$option_args['s'] = $_GET['s'];
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
																href="<?= $sortby_link ?>">
																<?= $option['label'] ?>
															</a>
														</li>
													<?php endforeach; ?>
	
												</ul>
											</div>
										</div>
									</div>
			
									<div class="post-list post-archive">
					
										<?php
										if ( have_posts() ) {
											// Start the Loop.
											while ( have_posts() ) {
												the_post();
					
												/*
												* Include the Post-Format-specific template for the content.
												* If you want to override this in a child theme, then include a file
												* called content-___.php (where ___ is the Post Format name) and that will be used instead.
												*/
												get_template_part( 'loop-templates/content', get_post_type() );
											}
										} else {
											get_template_part( 'loop-templates/content-none', 'simplified' );
										}
										?>
					
									</div>

								</div>

		
							</div>
		
						</div>

					</div>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
