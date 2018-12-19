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

}