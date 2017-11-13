<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 *
 * @wordpress-plugin
 * Plugin Name:       Social
 * Plugin URI:
 * Description:       A plugin to Socials
 * Version:           1.0.0
 * Author:            Athena Team
 * Author URI:        http://weareathena.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       athena-social
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'PLUGIN_NAME_VERSION', '1.0.0' );
define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define( 'TEXT_DOMAIN', 'athena-social');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ff-plug-activator.php
 */
function activate_plug() {
	echo PLUGIN_DIR . 'includes/athena-social-activator.php';
	require_once PLUGIN_DIR . 'includes/athena-social-activator.php';
	Athena_Social_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ff-plug-deactivator.php
 */
function deactivate_plug() {
	require_once PLUGIN_DIR . 'includes/athena-social-deactivator.php';
	Athena_Social_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plug' );
register_deactivation_hook( __FILE__, 'deactivate_plug' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require PLUGIN_DIR . 'includes/athena-social.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_athena_social() {
	$plugin = new Athena_Social();
}

run_athena_social();
