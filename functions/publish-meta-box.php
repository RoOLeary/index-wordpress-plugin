<?php

add_action('post_submitbox_misc_actions', 'article_or_box');
function article_or_box()
{
    global $post;
    if (get_post_type($post) == 'post') { ?>
        <div class="misc-pub-section"><img
                src="https://index.tnwcdn.com/favicon.png" height="14" width="14"
                style="padding-left: 4px; padding-right: 7px;"><label>Index:</label>
				<span id="post-status-display">
					<?php if (get_post_meta($post->ID, 'show_index_icon', true) !== 'false') {
                        echo 'On';
                    } else {
                        echo 'Off';
                    } ?>
				</span>
        </div>
    <?php }
}