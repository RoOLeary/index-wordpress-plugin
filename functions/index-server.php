<?php


/**
 * @param $content
 * @param $post_id
 * @return string
 */
function indexco_server_request($content, $post_id)
{


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://index.co/api/tnw/insert-index-links");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        "content=" . urlencode($content));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);

    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $server_output = curl_exec($ch);
    curl_close($ch);
    $positions = json_decode($server_output, true);


    update_post_meta($post_id, 'indexco_positions', $positions);

}

/**
 * @param $post_id
 */
function indexco_add_icon($post_id)
{
    // Send data to the Index.co server
    $content_post = get_post($post_id);
    $content = $content_post->post_content;
    indexco_server_request($content, $post_id);
}

add_action('save_post', 'indexco_add_icon');
?>
