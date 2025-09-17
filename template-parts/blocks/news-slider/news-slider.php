<?php

/**
 * Template for News Slider ACF block
 */

if (!defined('ABSPATH')) {
  exit;
}

$block_id = 'news-slider-' . (isset($block['id']) ? esc_attr($block['id']) : uniqid());
$align_class = isset($block['align']) ? 'align' . esc_attr($block['align']) : '';

$posts_count = intval(get_field('posts_count'));
if ($posts_count <= 0) {
  $posts_count = 5;
}

$transient_key = 'news_slider_posts_' . $posts_count;
$posts = get_transient($transient_key);

if (false === $posts) {
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_count,
    'post_status' => 'publish',
    'ignore_sticky_posts' => true,
  );
  $posts = get_posts($args);
  set_transient($transient_key, $posts, 5 * MINUTE_IN_SECONDS);
}

if (empty($posts)) {
  echo '<div>' . esc_html__('No posts found', 'twentytwentyfour-child') . '</div>';
  return;
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="news-slider splide <?php echo esc_attr($align_class); ?>"
  aria-label="<?php esc_attr_e('Latest news slider', 'twentytwentyfour-child'); ?>">
  <div class="splide__track">
    <ul class="splide__list">
      <?php foreach ($posts as $post):
        setup_postdata($post); ?>
        <li class="splide__slide">
          <article id="post-<?php the_ID(); ?>" <?php post_class('news-slide'); ?>>
            <?php if (has_post_thumbnail($post->ID)): ?>
              <div class="slide-thumb">
                <?php
                echo wp_get_attachment_image(
                  get_post_thumbnail_id($post->ID),
                  'medium',
                  false,
                  array(
                    'loading' => 'lazy',
                    'decoding' => 'async',
                    'alt' => get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) ?: get_the_title($post->ID),
                  )
                );
                ?>
              </div>
            <?php endif; ?>

            <h3 class="slide-title">
              <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo esc_html(get_the_title($post->ID)); ?></a>
            </h3>
          </article>
        </li>
      <?php endforeach;
      wp_reset_postdata(); ?>
    </ul>
  </div>
</div>