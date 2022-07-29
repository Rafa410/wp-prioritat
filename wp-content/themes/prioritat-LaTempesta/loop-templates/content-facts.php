<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<article <?php post_class( 'fact p-2' ); ?> id="fact-<?php the_ID(); ?>">

	<div class="row">

		<div class="col-lg-7">

			<?php the_title('<h3 class="h4 fact__title title-underline entry-title fw-bold mb-0">', '</h3>' ); ?>
		
			<div class="fact__content lh-sm"><?= get_the_content() ?></div>

		</div>

		<div class="col-lg-5 d-flex align-items-center justify-content-center">

			<?= get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'no-lazy fact__image w-100' ) ) ?>

			<!-- image caption -->

		</div>

	</div>

</article><!-- #post-## -->
