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
if (!class_exists('suf_clearn_admin_core')) {
    /**
     * suf清理插件核心
     */
    class suf_clearn_admin_core
    {


        public function __construct()
        {

            $this->init();
            add_action( 'admin_init', array($this,'custom_admin_menu' ));

        }

        private function init()
        {
            if (class_exists('WPBakeryShortCode')) {
                add_action('vc_before_init', array($this, 'vc_before_init_actions'));
            }
            $this->suf_add_widgets();
        }


        public function custom_admin_menu(){
            $current_user = wp_get_current_user();
            global $menu,$submenu;
            // var_dump($menu);
            if ($current_user->user_login=='3uweb') :
                foreach ($menu as $mkey => $mval) {
                    if (in_array($mval[2], [
                                  'edit.php?post_type=project',
                                  'edit-comments.php',
                                  'tools.php',
                                  'options-general.php',
                                  'et_divi_options',
                                  'vc-general',
                                  'about-ultimate',
                        ])) {
                      unset($menu[$mkey]);
                    }
                }
            endif;
            // if ($current_user->user_login=='3uweb') {
            //    remove_menu_page( 'edit-comments.php' );
            //    remove_menu_page( 'edit.php?post_type=project' );
            //    remove_menu_page( 'vc-general' );
            //    remove_menu_page( 'about-ultimate' );
            //    remove_menu_page( 'et_divi_options' );
            // }

        }

        public function vc_before_init_actions()
        {

            $vc_addons_files = array(
                'homepage-newslist-table.php',
                'company-outline.php',
            );

            foreach ($vc_addons_files as $filesname) {
                if (file_exists(__SUFPLUGINPATH__ . '/admin/addons/vc-elements/' . $filesname)) {
                    require_once(__SUFPLUGINPATH__ . '/admin/addons/vc-elements/' . $filesname);
                }
            }
        }

        public function suf_add_widgets()
        {

            $suf_add_widgets = array(
                'sharebuttonforwidget.php',
            );
            foreach ($suf_add_widgets as $filesname) {
                if (file_exists(__SUFPLUGINPATH__ . '/admin/addons/widgets/' . $filesname)) {
                    require_once(__SUFPLUGINPATH__ . '/admin/addons/widgets/' . $filesname);
                }
            }
        }

    }

    new suf_clearn_admin_core();

}