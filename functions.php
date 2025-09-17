<?php

add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name' => 'news-slider',
            'title' => __('News Slider'),
            'description' => __('Show latest posts in a slider (thumbnail + title).'),
            'render_template' => get_stylesheet_directory() . '/template-parts/blocks/news-slider/news-slider.php',
            'category' => 'formatting',
            'icon' => 'slides',
            'keywords' => array('news', 'slider', 'posts'),
            'enqueue_assets' => function () {
                $theme_uri = get_stylesheet_directory_uri();

                wp_enqueue_style('splide-css', $theme_uri . '/assets/splide/splide.min.css', array(), '4.1.4');
                wp_enqueue_script('splide-js', $theme_uri . '/assets/splide/splide.min.js', array(), '4.1.4', true);

                wp_enqueue_style('news-slider-css', $theme_uri . '/assets/css/news-slider.css', array('splide-css'), '1.0');
                wp_enqueue_script('news-slider-init', $theme_uri . '/assets/js/news-slider.js', array('splide-js'), '1.0', true);
            },
            'supports' => array(
                'align' => array('wide', 'full'),
            ),
        ));
    }
});

function get_gmaps_api_key()
{
    if (defined('GMAPS_API_KEY') && GMAPS_API_KEY) {
        return GMAPS_API_KEY;
    }
}

add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type([
            'name' => 'google-map',
            'title' => __('Google Map'),
            'description' => __('Custom Google Map block with coordinates.'),
            'render_template' => get_stylesheet_directory() . '/template-parts/blocks/google-map/google-map.php',
            'category' => 'widgets',
            'icon' => 'location',
            'keywords' => ['map', 'google', 'coordinates'],
            'enqueue_assets' => function () {
                $api_key = get_gmaps_api_key();
                wp_enqueue_script(
                    'google-maps-api',
                    "https://maps.googleapis.com/maps/api/js?key={$api_key}&libraries=marker",
                    [],
                    null,
                    true
                );

                wp_enqueue_script(
                    'google-map-block',
                    get_stylesheet_directory_uri() . '/template-parts/blocks/google-map/google-map.js',
                    ['google-maps-api'],
                    '1.0',
                    true
                );
            },
            'supports' => [
                'align' => true,
                'anchor' => true,
            ],
        ]);
    }
});

