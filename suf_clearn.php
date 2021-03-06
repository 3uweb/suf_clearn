<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              none
 * @since             1.0.0
 * @package           Suf_clearn
 *
 * @wordpress-plugin
 * Plugin Name:       suf_clearn
 * Plugin URI:        https://github.com/sufproject
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Ryan soong
 * Author URI:        none
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       suf_clearn
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * 创建常量
 */
$masterfolder = basename(__DIR__);
define('SUF_ADDONS_VERSION', '1.0');
define('__SUFPLUGINPATH__', __DIR__);
define('__SUFTHEMEPATH__', get_template_directory());
define('__SUFPLUGINURI__', plugins_url().'/'.$masterfolder);



/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-suf_clearn-activator.php
 */
function activate_suf_clearn() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-suf_clearn-activator.php';
	Suf_clearn_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-suf_clearn-deactivator.php
 */
function deactivate_suf_clearn() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-suf_clearn-deactivator.php';
	Suf_clearn_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_suf_clearn' );
register_deactivation_hook( __FILE__, 'deactivate_suf_clearn' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-suf_clearn.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_suf_clearn() {

	$plugin = new Suf_clearn();
	$plugin->run();

}
run_suf_clearn();
