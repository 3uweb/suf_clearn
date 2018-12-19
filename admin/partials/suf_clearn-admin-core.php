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
class suf_clearn_admin_core{



	public function __construct(){
		
		$this->init();

	}

	private function init()
    {
    	/**
    	 *  Visual Composer 组件加载
    	 */

        $this->start();

    }

	public function start(){

        if (class_exists('WPBakeryShortCode')) {
            add_action('vc_before_init', array($this,'vc_before_init_actions'));
        }

	}

	public function vc_before_init_actions()
    {
        
        $vc_addons_files = array(
            'homepage-newslist-table.php',
            'company-outline.php',
        );

        foreach ($vc_addons_files as $filesname) {
            if (file_exists(__SUFPLUGINPATH__ . '/admin/vc_addons/vc-elements/'.$filesname)) {
                require_once(__SUFPLUGINPATH__ . '/admin/vc_addons/vc-elements/'.$filesname);
            }
        }
    }

}
