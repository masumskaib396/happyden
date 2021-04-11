<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 * @wordpress-plugin
 * Plugin Name:       Happyden Theme Helper
 * Plugin URI:        
 * Description:       This is the helper plugin of Happyden WordPress theme which helps the theme to run smoothly.
 * Version:           1.0.0
 * Author:            finestdevs
 * Author URI:        https://finestdevs.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       happyden
 * Domain Path:       /languages
 */


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/*
Constants
------------------------------------------ */

/* Set plugin version constant. */
define( 'HAPPYDEN_VERSION', '0.1');

/* Set constant path to the plugin directory. */
define( 'HAPPYDEN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

// Plugin Addons Folder Path
define( 'HAPPYDEN_ADDONS_DIR', plugin_dir_path( __FILE__ ) . 'widget/' );

// Assets Folder URL
define( 'HAPPYDEN_ASSETS', plugins_url( 'assets/', __FILE__ ) );
define( 'HAPPYDEN_ASSETS_ADMIN',  plugins_url( 'assets/admin/', __FILE__ ) );
define( 'HAPPYDEN_ASSETS_VENDOR', plugins_url( 'assets/vendor/', __FILE__ ) );


require_once(HAPPYDEN_PATH. 'base.php' );
require_once(HAPPYDEN_PATH. '/inc/helper-functions.php' );
require_once(HAPPYDEN_PATH. '/inc/elementor-helper.php' );
require_once(HAPPYDEN_PATH. '/inc/Classes/breadcrumb-class.php' );
require_once(HAPPYDEN_PATH. '/inc/acf.php' );
require_once(HAPPYDEN_PATH. '/inc/cpt.php' );