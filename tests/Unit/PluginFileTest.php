<?php

/**
 * The plugin's main file, with WordPress mocked.
 *
 * @see uamswp-learndash-user.php
 */

declare(strict_types=1);

use Brain\Monkey\Functions;

it('registers the activation and deactivation hooks and defines no instance helper', function (): void {
    if (! defined('WPINC')) {
        define('WPINC', 'wp-includes');
    }

    Functions\expect('register_activation_hook')
        ->once()
        ->with(Mockery::type('string'), ['UAMSWP_Learndash_Custom_Capabilities', 'uamsld_add_roles']);
    Functions\expect('register_deactivation_hook')
        ->once()
        ->with(Mockery::type('string'), ['UAMSWP_Learndash_Custom_Capabilities', 'uamsld_remove_roles']);

    require __DIR__.'/../../uamswp-learndash-user.php';

    // The removed helper called get_instance(), which the class never defined, so calling it fataled.
    expect(function_exists('UAMSWP_Learndash_Custom_Capabilities'))->toBeFalse();
    expect(method_exists('UAMSWP_Learndash_Custom_Capabilities', 'get_instance'))->toBeFalse();
});
