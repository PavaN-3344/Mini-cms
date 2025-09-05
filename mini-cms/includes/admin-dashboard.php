<?php
// Create custom dashboard page
function mini_cms_dashboard_page() {
    ?>
    <div class="wrap">
        <h1>Mini CMS Dashboard</h1>
        <form id="mini-cms-form">
            <?php wp_nonce_field('mini_cms_nonce', 'security'); ?>

            <p>
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required>
            </p>

            <p>
                <label for="content">Content:</label><br>
                <textarea id="content" name="content" rows="5" required></textarea>
            </p>

            <p>
                <label for="author_name">Author Name:</label><br>
                <input type="text" id="author_name" name="author_name" placeholder="e.g. Sam Altman">
            </p>

            <p>
                <label for="type">Content Type:</label><br>
                <select id="type" name="type">
                    <option value="article">Article</option>
                    <option value="review">Review</option>
                </select>
            </p>

            <!-- Rating field (only for reviews) -->
            <p id="rating-field" style="display:none;">
                <label for="rating">Rating (out of 5):</label><br>
                <select id="rating" name="rating">
                    <option value="">-- Select Rating --</option>
                    <option value="1">⭐ 1</option>
                    <option value="2">⭐ 2</option>
                    <option value="3">⭐ 3</option>
                    <option value="4">⭐ 4</option>
                    <option value="5">⭐ 5</option>
                </select>
            </p>

            <p>
                <button type="submit" class="button button-primary">Save</button>
            </p>
        </form>

        <div id="mini-cms-message"></div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Show rating only for reviews
        $('#type').on('change', function() {
            if ($(this).val() === 'review') {
                $('#rating-field').show();
            } else {
                $('#rating-field').hide();
            }
        });

        // Handle form submit
        $('#mini-cms-form').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.post(ajaxurl, formData + '&action=mini_cms_save_content', function(response) {
                if (response.success) {
                    $('#mini-cms-message').html('<div class="updated"><p>' + response.data + '</p></div>');
                    $('#mini-cms-form')[0].reset();
                    $('#rating-field').hide();
                } else {
                    $('#mini-cms-message').html('<div class="error"><p>' + response.data + '</p></div>');
                }
            });
        });
    });
    </script>
    <?php
}

function mini_cms_register_dashboard_page() {
    add_menu_page(
        'Mini CMS',
        'Mini CMS',
        'manage_options',
        'mini-cms-dashboard',
        'mini_cms_dashboard_page',
        'dashicons-welcome-write-blog',
        20
    );
}
add_action('admin_menu', 'mini_cms_register_dashboard_page');
