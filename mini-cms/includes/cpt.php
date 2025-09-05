<?php
// Register "Articles" Custom Post Type
function mini_cms_register_articles() {
    $args = [
        'labels' => [
            'name' => __('Articles'),
            'singular_name' => __('Article'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-media-document',
        'supports' => ['title', 'editor'],
        'show_in_rest' => true,
    ];
    register_post_type('article', $args);
}

// Register "Reviews" Custom Post Type
function mini_cms_register_reviews() {
    $args = [
        'labels' => [
            'name' => __('Reviews'),
            'singular_name' => __('Review'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-star-filled',
        'supports' => ['title', 'editor'],
        'show_in_rest' => true,
    ];
    register_post_type('review', $args);
}

add_action('init', 'mini_cms_register_articles');
add_action('init', 'mini_cms_register_reviews');
