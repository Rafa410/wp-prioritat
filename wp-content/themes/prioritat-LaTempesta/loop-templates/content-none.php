<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<section class="no-results not-found">

	<header class="page-header">

		<h1 class="page-title"><?php esc_html_e( 'No s\'ha trobat res.', 'prioritat' ); ?></h1>

	</header><!-- .page-header -->

	<div class="page-content">

		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p class="fw-light fs-5 text-muted">%s<p>',
				esc_html__( 'No hem trobat cap entrada. Si us plau, torna a provar amb una altra cerca o categoria.', 'prioritat' )
			);
			
			$kses = array( 'a' => array( 'href' => array() ) );
			printf(
				/* translators: 1: Link to WP admin new post page. */
				'<p class="fw-light fs-5 text-muted">' . wp_kses( __( 'Vols crear una entrada? <a href="%1$s">Fes click aquí</a>.', 'prioritat' ), $kses ) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_home() && ! current_user_can( 'publish_posts' ) ) :

			printf(
				'<p class="fw-light fs-5 text-muted">%s<p>',
				esc_html__( 'No hem trobat cap entrada. Si us plau, torna a provar amb una altra cerca o categoria.', 'prioritat' )
			);

		elseif ( is_search() ) :

			printf(
				'<p class="fw-light fs-5 text-muted">%s<p>',
				esc_html__( 'No s\'han trobat resultats, si us plau, torna a provar amb una altra cerca.', 'prioritat' )
			);
			get_search_form();

		else :

			printf(
				'<p class="fw-light fs-5 text-muted">%s<p>',
				esc_html__( 'No podem trobar el que estàs buscant. Potser la recerca pot ajudar.', 'prioritat' )
			);
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->

</section><!-- .no-results -->
