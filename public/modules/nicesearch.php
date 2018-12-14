<?php


add_action('template_redirect', 'suf_redirect');
add_filter('wpseo_json_ld_search_url', 'suf_rewrite');


function suf_redirect() {
    global $wp_rewrite;
    if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->get_search_permastruct()) {
        return;
    }

    $search_base = $wp_rewrite->search_base;
    if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false && strpos($_SERVER['REQUEST_URI'], '&') === false) {
        wp_redirect(get_search_link());
        exit();
    }

}


function suf_rewrite($url) {
    return str_replace('/?s=', '/search/', $url);
}
