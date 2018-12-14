<?php

add_action('wp_enqueue_scripts', 'suf_js_to_footer');


function suf_js_to_footer() {
    remove_action('wp_head', 'wp_print_scripts');
//    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
}
