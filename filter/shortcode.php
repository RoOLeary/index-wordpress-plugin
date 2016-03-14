<?php
add_shortcode('index', function( $attr, $content = null ) {
    if (array_key_exists('company', $attr)) {
        $company = urlencode($attr['company']);
        return "<a href='https://index.co/company/$company' data-index='' target='_blank' class='idc-hasIcon'></a>";
    }
    return "";
});
