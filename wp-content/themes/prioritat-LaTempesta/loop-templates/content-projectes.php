<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<article <?php post_class( 'project p-2' ); ?> id="project-<?php the_ID(); ?>">

	<!-- <a href="<?= esc_url( get_permalink() ) ?>" class="project__link link-dark text-decoration-none"> -->
	<a class="project__link link-dark text-decoration-none">

		<div class="ratio ratio-16x9">
			<?= get_the_post_thumbnail( $post->ID, 'medium', array( 'class' => 'no-lazy project__image' ) ) ?>
		</div>
		
		<?php the_title('<h3 class="project__title entry-title fw-semibold mt-3 mb-2">', '</h3>' ); ?>
	
	</a>

	<span class="project__subtitle"><?= get_field('subtitle') ?></span>

	<!-- <a href="<?= esc_url( get_permalink() ) ?>" class="read-more btn btn-sm btn-outline-dark fw-semibold my-3">
		<?= __( 'Més info', 'prioritat' ) ?>
	</a> -->

</article><!-- #post-## -->
