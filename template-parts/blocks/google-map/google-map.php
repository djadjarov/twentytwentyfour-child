<?php

/**
 * Template for Google Maps ACF block
 */

$lat = get_field('latitude');
$lng = get_field('longitude');

$map_id = 'map-' . uniqid();
?>
<div class="google-map-block" style="width: 100%; height: 400px;">
    <div id="<?php echo esc_attr($map_id); ?>" class="google-map" data-lat="<?php echo esc_attr($lat); ?>"
        data-lng="<?php echo esc_attr($lng); ?>" style="width: 100%; height: 100%;">
    </div>
</div>