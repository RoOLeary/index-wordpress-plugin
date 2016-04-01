<?php
global $post;
/**
 * @param $content
 * @return mixed
 */
function indexco_add($content) {
    global $post;
    $post_id = $post->ID;
    if (get_post_meta($post->ID, 'show_index_icon', true) == 'true' || get_post_meta($post->ID, 'show_index_icon', true) == null) {
        $positions = get_post_meta($post_id, 'indexco_positions');
        if ($positions == null) {
            indexco_add_icon($post_id);
        } else if( isset($positions[0]) && !empty($positions[0]) ) {
            foreach ($positions[0] as $position) {
                $haystack = $content;
                $needle = $position['original'];
                $replace = $position['replaced'];
                $pos = strpos($haystack, $needle);
                if ($pos !== false) {
                    $content = substr_replace($haystack, $replace, $pos, strlen($needle));
                }
            }
        }  return $content;
    } else {
        return $content;
    }
}

add_filter('the_content', 'indexco_add');