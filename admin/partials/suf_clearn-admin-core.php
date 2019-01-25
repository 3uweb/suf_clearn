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

        }

        private function init()
        {
            if (class_exists('WPBakeryShortCode')) {
                add_action('vc_before_init', array($this, 'vc_before_init_actions'));
            }
            $this->suf_add_widgets();
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
                'vcpluginforwidget.php',
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