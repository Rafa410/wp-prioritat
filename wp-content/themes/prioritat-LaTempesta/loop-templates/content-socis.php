<?php
/**
 * Single 'socis' partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$prev_char = $args['prev_char'];
$current_char = mb_strtoupper( mb_substr( get_the_title(), 0, 1 ) );

?>

<?php if ( $prev_char === '' ) : ?>
	
	<ul class="socis-list-group">
	
<?php elseif ( $prev_char !== $current_char ) : ?>
		
	</ul>

	<ul class="socis-list-group">

<?php endif; ?>

<li class="soci" id="soci-<?php the_ID(); ?>">
	<span class="soci__name"><?= get_the_title() ?></span>
</li>
