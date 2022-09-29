<?php
/**
 * Single event partial template
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$ID = get_the_ID();
$event_description = get_field( 'event_description' );
$slug = 'event-' . get_the_title() . '-' . $ID;
$event_date = get_field( 'event_date' );
?>

<div class="event-group position-relative ps-4 pt-3">

    <div class="event-item" id="event-<?= $ID ?>">
        
        <h3 class="event-year"><?= $event_date ?></h3>
        <div class="event-description"><?= $event_description ?></div>
        
    </div>

</div>
