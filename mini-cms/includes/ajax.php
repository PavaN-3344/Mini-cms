<?php
// Handle AJAX save
function mini_cms_save_content() {
    check_ajax_referer('mini_cms_nonce', 'security');

    $title       = sanitize_text_field($_POST['title']);
    $content     = wp_kses_post($_POST['content']);
    $type        = sanitize_text_field($_POST['type']); // article or review
    $author_name = sanitize_text_field($_POST['author_name']); // custom author
    $rating      = isset($_POST['rating']) ? intval($_POST['rating']) : 0; // rating for reviews

    $post_id = wp_insert_post([
        'post_title'   => $title,
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_type'    => $type,
    ]);

    if ($post_id) {
        if (!empty($author_name)) {
            update_post_meta($post_id, 'mini_cms_author', $author_name);
        }
        if ($type === 'review' && $rating > 0 && $rating <= 5) {
            update_post_meta($post_id, 'mini_cms_rating', $rating);
        }
        wp_send_json_success("Saved successfully as $type (ID: $post_id).");
    } else {
        wp_send_json_error("Failed to save $type.");
    }
}
add_action('wp_ajax_mini_cms_save_content', 'mini_cms_save_content');
