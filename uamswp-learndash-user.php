<?php

declare(strict_types=1);
/*
Plugin Name: UAMSWP Custom Editor for Learndash
Plugin URI: https://www.uams.edu
Description: UAMSWP Add Capabilites to Editor for Learndash
Author: Todd McKee, MEd
Version: 0.1.0
Requires PHP: 8.2
*/

// If this file is called directly, abort.
if (! defined('WPINC')) {
    exit;
}

// The plugin requires PHP 8.2 or greater. WordPress enforces `Requires PHP` when the
// plugin is activated; this covers a site whose PHP is downgraded underneath an
// already-active plugin, where the alternative is a fatal error.
if (version_compare(PHP_VERSION, '8.2', '<')) {
    add_action('admin_notices', static function (): void {
        echo '<div class="error"><p>'.esc_html__('UAMSWP Custom Editor for Learndash requires PHP 8.2 to function properly. Please upgrade PHP or deactivate the plugin.', 'uamswp-learndash-user').'</p></div>';
    });

    return;
}

require_once __DIR__.'/includes/uamswp-learndash-user.php';
register_activation_hook(__FILE__, ['UAMSWP_Learndash_Custom_Capabilities', 'uamsld_add_roles']);
register_deactivation_hook(__FILE__, ['UAMSWP_Learndash_Custom_Capabilities', 'uamsld_remove_roles']);
