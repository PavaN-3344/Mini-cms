<?php
// Shortcode to display Articles/Reviews
function mini_cms_list_shortcode($atts) {
    $atts = shortcode_atts(['type' => 'article'], $atts);

    $query = new WP_Query([
        'post_type'      => $atts['type'],
        'posts_per_page' => 10,
    ]);

    ob_start();

    if ($query->have_posts()) {
        echo '<div class="mini-cms-list">';
        while ($query->have_posts()) {
            $query->the_post();

            $custom_author = get_post_meta(get_the_ID(), 'mini_cms_author', true);
            $rating        = get_post_meta(get_the_ID(), 'mini_cms_rating', true);

            echo '<div class="mini-cms-item">';
            echo '<h2>' . get_the_title() . '</h2>';
            echo '<div>' . apply_filters('the_content', get_the_content()) . '</div>';

            // Author display
            if ($custom_author) {
                echo '<p><em>Written by ' . esc_html($custom_author) . '</em></p>';
            } else {
                echo '<p><em>Written by ' . esc_html(get_the_author()) . '</em></p>';
            }

            // Rating display (only for reviews)
            if ($atts['type'] === 'review' && $rating) {
                echo '<p>Rating: ';
                for ($i = 1; $i <= 5; $i++) {
                    echo ($i <= $rating) ? '⭐' : '☆';
                }
                echo ' (' . esc_html($rating) . '/5)</p>';
            }

            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No ' . esc_html($atts['type']) . 's found.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('mini_cms_list', 'mini_cms_list_shortcode');
