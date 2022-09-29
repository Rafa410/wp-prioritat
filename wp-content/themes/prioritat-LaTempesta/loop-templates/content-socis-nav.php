<?php
/**
 * Single 'socis' nav partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$prev_char = $args['prev_char'];
$current_char = mb_strtoupper( mb_substr( get_the_title(), 0, 1 ) );

?>

<?php if ( $prev_char === '' ) : ?>
	
	<div class="socis-nav-item">
		<h3><?= $current_char ?></h3>
	
<?php elseif ( $prev_char !== $current_char ) : ?>
		
	</div>

	<div class="socis-nav-item">
		<h3><?= $current_char ?></h3>

<?php endif; ?>
