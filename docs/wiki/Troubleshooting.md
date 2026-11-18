# Troubleshooting

Written against v0.3.0.

- [An editor lacks LearnDash capabilities after activation](#an-editor-lacks-learndash-capabilities-after-activation)
- [An editor lost the settings screens or the user list](#an-editor-lost-the-settings-screens-or-the-user-list)
- [Capabilities remain after deactivation](#capabilities-remain-after-deactivation)
- [An admin notice says the plugin requires PHP 8.2](#an-admin-notice-says-the-plugin-requires-php-82)

## An editor lacks LearnDash capabilities after activation

**Cause:** activation grants the set only when the Editor role does not already hold `read_courses`. A role that holds it, for example because another copy of the capabilities was applied earlier, is treated as already granted, even if some of the 59 capabilities are missing from it. Roles are also stored per site, so activating on one site of a network does not change the Editor role on another.

**Fix:** deactivate the plugin on the affected site, then activate it again. Deactivation removes the whole set while the role holds `read_courses`, and the next activation grants all of it. See [Activation, upgrade and deactivation](Activation-upgrade-and-deactivation.md).

## An editor lost the settings screens or the user list

**Cause:** a release with capability-set revision 1 removes `manage_options`, `list_users` and `edit_users` from the Editor role the first time a site loads it. Earlier releases granted them; they are site-management capabilities, not LearnDash ones. See [Capabilities granted](Capabilities-granted.md#capabilities-the-plugin-no-longer-grants).

**Fix:** none in the plugin; the removal is intended. An account that needs those screens needs a role that is meant to hold those capabilities.

## Capabilities remain after deactivation

**Cause:** deactivation removes the set only when the Editor role holds `read_courses`. If that capability had already been removed by other means, deactivation does nothing, and any other capabilities from the set that the role still holds stay.

**Fix:** remove the remaining capabilities from the Editor role with a role-management tool, or activate and deactivate the plugin once so that `read_courses` is present when the removal runs.

## An admin notice says the plugin requires PHP 8.2

**Cause:** the plugin requires PHP 8.2. WordPress refuses to activate it on an older version, so the notice appears only when a site's PHP was lowered underneath an already-active plugin. While the notice shows, the plugin loads nothing else, so no activation, deactivation or upgrade work runs.

**Fix:** raise the site's PHP to 8.2 or later, or deactivate the plugin.
