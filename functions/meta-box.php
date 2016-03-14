<?php

add_action('add_meta_boxes', 'indexplugin_meta');
add_action('save_post', 'save_index_setting');


function indexplugin_meta()
{
    add_meta_box('prfx_meta', __('Index.co settings <img src="https://index.tnwcdn.com/favicon.png" height="14"; width="14";>', 'prfx-textdomain'), 'indexplugin_meta_callback', 'post');
}


/**
 * @param $post
 */
function indexplugin_meta_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'prfx_nonce');
    $prfx_stored_meta = get_post_meta($post->ID);
    ?>
    <p>
        <label for="show_index_icon"
               class="prfx-row-title"><?php _e('Show Index.co link on this page? ', 'prfx-textdomain') ?></label>
        <select name="show_index_icon">
            <option value="true" <?php if (isset($prfx_stored_meta['show_index_icon']) && $prfx_stored_meta['show_index_icon'][0] == 'true') {
                echo 'selected';
            } ?>>Yes
            </option>
            <option value="false" <?php if (isset($prfx_stored_meta['show_index_icon']) && $prfx_stored_meta['show_index_icon'][0] == 'false') {
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
    if (isset($_POST['show_index_icon'])) {
        update_post_meta($post_id, 'show_index_icon', sanitize_text_field($_POST['show_index_icon']));
    }
}


