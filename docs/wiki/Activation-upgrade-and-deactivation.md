# Activation, upgrade and deactivation

Written against v0.3.0.

The plugin has no settings screen. It changes the Editor role's capabilities at three points: when it is activated, when a site that already has it active loads an updated copy, and when it is deactivated. Each change is made on the site where it runs, because roles are stored per site.

- [Activation](#activation)
- [The upgrade](#the-upgrade)
- [Deactivation](#deactivation)
- [Requirements](#requirements)

## Activation

On activation the plugin looks up the Editor role and checks whether it holds `read_courses`.

1. If the role is missing, or already holds `read_courses`, activation does nothing.
2. Otherwise it adds every capability in [Capabilities granted](Capabilities-granted.md) to the role.
3. It then records the capability-set revision it granted in the `uamswp_learndash_user_caps_version` option, so the upgrade has nothing to do on that site.

`read_courses` is the marker. A role that already holds it is treated as already granted, which is why activating the plugin on a site where LearnDash or an earlier copy of the plugin has already given the Editor role that capability changes nothing.

## The upgrade

WordPress runs no activation hook when a site's plugin files are replaced while the plugin is active. The plugin therefore reconciles the role itself on `plugins_loaded`, before the current user's capabilities are read at `init`.

The check is cheap: if the `uamswp_learndash_user_caps_version` option already equals the current revision (`1`), the upgrade returns at once. Otherwise:

1. If the Editor role holds `read_courses`, the upgrade removes `list_users`, `edit_users` and `manage_options` from it. Earlier releases granted these beside the LearnDash capabilities; none of them is a LearnDash capability, and revision 1 stops granting them.
2. It records revision `1` in the option, so the work happens once per site.

A role that does not hold `read_courses` is left alone, because that marker shows the plugin never granted the set there (a deactivated site, or a site the activation did not reach). The option is still written, so the check does not repeat on every request.

**Note:** because the upgrade removes `manage_options`, `list_users` and `edit_users` from the Editor role, an editor who used the site settings screens or the user list through those capabilities loses access when a site first loads a release with revision 1.

## Deactivation

On deactivation the plugin looks up the Editor role and, if the role holds `read_courses`, removes every capability in [Capabilities granted](Capabilities-granted.md). If the role does not hold `read_courses`, deactivation does nothing, so capabilities that were never granted through this plugin are not touched by a role that lacks the marker.

Deactivation does not delete the `uamswp_learndash_user_caps_version` option. A later activation on a role that no longer holds `read_courses` grants the full set again and writes the option.

## Requirements

- WordPress 6.8 or later (`Requires at least` in the plugin header).
- PHP 8.2 or later (`Requires PHP`). WordPress enforces this when the plugin is activated; if a site's PHP is lowered underneath an already-active plugin, the plugin shows an admin notice and loads nothing else. See [Troubleshooting](Troubleshooting.md#an-admin-notice-says-the-plugin-requires-php-82).
