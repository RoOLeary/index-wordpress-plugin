<?php

add_action('add_meta_boxes', 'indexplugin_meta');
add_action('save_post', 'save_index_setting');
function indexplugin_meta()
{

    add_meta_box('prfx_meta', __('Index.co settings <img src="https://index.tnwcdn.com/favicon.png" height="14"; width="14";>', 'prfx-textdomain'), 'indexplugin_meta_callback', 'post');
}



function indexplugin_meta_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'prfx_nonce');
    $prfx_stored_meta = get_post_meta($post->ID);
    ?>
    <p>
        <label for="show_index_icon"
               class="prfx-row-title"><?php _e('Show Index.co link on this page? ', 'prfx-textdomain') ?></label>
        <select name="show_index_icon">
            <option value="true" <?php if ($prfx_stored_meta['show_index_icon'][0] == 'true') {
                echo 'selected';
            } ?>>Yes
            </option>
            <option value="false" <?php if ($prfx_stored_meta['show_index_icon'][0] == 'false') {
                echo 'selected';
            } ?>>No
            </option>
        </select>
    </p>
    <?php
}

/**
 * Saves the custom meta input
 */
function save_index_setting($post_id)
{

    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['prfx_nonce']) && wp_verify_nonce($_POST['prfx_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if (isset($_POST['show_index_icon'])) {
        update_post_meta($post_id, 'show_index_icon', sanitize_text_field($_POST['show_index_icon']));
    }

}


