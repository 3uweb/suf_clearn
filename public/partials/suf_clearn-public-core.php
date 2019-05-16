<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       none
 * @since      1.0.0
 *
 * @package    Suf_clearn
 * @subpackage Suf_clearn/public/partials
 */

/**
 * suf清理插件核心
 */
class suf_clearn_public_core
{

    protected $clearnfiles;

    public function __construct()
    {

        $this->init();
        add_action('init', array($this, 'sufclear_disable_emojis'));

    }

    private function init()
    {

        $this->clearnfiles = array(
            'clear_up.php',
            'removeversion.php',
            'disabletrackbacks.php',
            'navclearn.php',
            'nicesearch.php',
        );

        $this->suf_clearn_files();
    }


    private function suf_clearn_files()
    {
        $clearnfilesnone = array();
        foreach ($this->clearnfiles as $filesname) {
            if (file_exists(__SUFPLUGINPATH__ . '/public/modules/' . $filesname)) {
                require_once(__SUFPLUGINPATH__ . '/public/modules/' . $filesname);
            } else {
                array_push($clearnfilesnone, $filesname);
            }
        }
        $this->clearnfiles = array_diff($this->clearnfiles, $clearnfilesnone);
    }

    private function sufclear_disable_emojis()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        add_filter('tiny_mce_plugins', array($this, 'sufclear_disable_emojis_tinymce'));
        add_filter('wp_resource_hints', array($this, 'sufclear_disable_emojis_remove_dns_prefetch', 10, 2));
    }

    private function sufclear_disable_emojis_tinymce($plugins)
    {
        if (is_array($plugins)) {
            return array_diff($plugins, array('wpemoji'));
        } else {
            return array();
        }
    }

    private function sufclear_disable_emojis_remove_dns_prefetch($urls, $relation_type)
    {
        if ('dns-prefetch' == $relation_type) {
            /** This filter is documented in wp-includes/formatting.php */
            $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

            $urls = array_diff($urls, array($emoji_svg_url));
        }

        return $urls;
    }

}