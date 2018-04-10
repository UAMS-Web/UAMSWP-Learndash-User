<?php
/*
Plugin Name: UAMSWP Custom Editor for Learndash
Plugin URI: https://www.uams.edu
Description: UAMSWP Add Capabilites to Editor for Learndash
Author: Todd McKee, MEd
Version: 0.1
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
// This plugin uses namespaces and requires PHP 5.3 or greater.
if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {
	add_action( 'admin_notices', create_function( '', // phpcs:ignore WordPress.PHP.RestrictedPHPFunctions.create_function_create_function
	"echo '<div class=\"error\"><p>" . __( 'WSUWP Plugin Skeleton requires PHP 5.3 to function properly. Please upgrade PHP or deactivate the plugin.', 'wsuwp-plugin-skeleton' ) . "</p></div>';" ) );
	return;
} else {
	require dirname( __FILE__ ) . '/includes/uamswp-learndash-user.php';

	register_activation_hook( __FILE__, array( 'UAMSWP_Learndash_Custom_Capabilities', 'uamsld_add_roles' ) );

	register_deactivation_hook( __FILE__, array( 'UAMSWP_Learndash_Custom_Capabilities', 'uamsld_remove_roles' ) );

	/**
	 * Start things up.
	 *
	 * @return \WSUWP_VALS_Custom_Roles
	 */
	function UAMSWP_Learndash_Custom_Capabilities() {
		return UAMSWP_Learndash_Custom_Capabilities::get_instance();
	}
}