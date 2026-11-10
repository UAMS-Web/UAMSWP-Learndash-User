<?php

declare(strict_types=1);
class UAMSWP_Learndash_Custom_Capabilities
{
    /**
     * Option holding the revision of the capability set the editor role was last brought to.
     * Absent on a site that activated a release before the option existed.
     */
    public const VERSION_OPTION = 'uamswp_learndash_user_caps_version';

    /**
     * Revision of the capability set. Bump it when the set changes, and have uamsld_upgrade()
     * reconcile a site that is on an older revision.
     */
    public const CAPS_VERSION = '1';

    /**
     * Add the LearnDash capabilities to the Editor role on activation.
     */
    public static function uamsld_add_roles(): void
    {
        $editor = get_role('editor');
        if ($editor && ! ($editor->has_cap('read_courses'))) {
            // Add role capabilities for LD
            $editor = get_role('editor');
            $caps = [
                'enroll_users',
                'edit_courses',
                'edit_others_courses',
                'publish_courses',
                'read_courses',
                'read_private_courses',
                'delete_courses',
                'edit_published_courses',
                'edit_private_courses',
                'delete_others_courses',
                'delete_published_courses',
                'delete_private_courses',
                'edit_groups',
                'edit_others_groups',
                'publish_groups',
                'read_groups',
                'read_private_groups',
                'delete_groups',
                'edit_published_groups',
                'delete_others_groups',
                'delete_published_groups',
                'edit_reports',
                'edit_others_reports',
                'publish_reports',
                'read_reports',
                'read_private_reports',
                'delete_reports',
                'edit_published_reports',
                'delete_others_reports',
                'delete_published_reports',
                'read_assignment',
                'edit_assignment',
                'edit_assignments',
                'edit_others_assignments',
                'publish_assignments',
                'read_assignment',
                'read_private_assignments',
                'delete_assignment',
                'edit_published_assignments',
                'delete_others_assignments',
                'delete_published_assignments',
                'edit_essays',
                'edit_others_essays',
                'publish_essays',
                'read_essays',
                'read_private_essays',
                'delete_essays',
                'edit_published_essays',
                'delete_others_essays',
                'delete_published_essays',
                'wpProQuiz_show',
                'wpProQuiz_add_quiz',
                'wpProQuiz_edit_quiz',
                'wpProQuiz_delete_quiz',
                'wpProQuiz_show_statistics',
                'wpProQuiz_reset_statistics',
                'wpProQuiz_import',
                'wpProQuiz_export',
                'wpProQuiz_change_settings',
                'wpProQuiz_toplist_edit',
                'wpProQuiz_toplist_edit',
            ];
            foreach ($caps as $cap) {
                $editor->add_cap($cap);
            }

            // The set this activation granted is the current one, so the upgrade has nothing to do.
            update_option(self::VERSION_OPTION, self::CAPS_VERSION);
        }
    }

    /**
     * Bring the Editor role of a site that activated an earlier release to the current
     * capability set. Runs on `plugins_loaded`, before the current user's capabilities are
     * read at `init`, and does its work once: the option records the revision reached.
     *
     * Only an editor role holding `read_courses` is touched. That is the marker activation
     * leaves and deactivation clears, so a site where this plugin never granted the set
     * (a deactivated site, or a network site that activation did not reach) is left alone.
     */
    public static function uamsld_upgrade(): void
    {
        if (get_option(self::VERSION_OPTION) === self::CAPS_VERSION) {
            return;
        }

        $editor = get_role('editor');
        if ($editor && ($editor->has_cap('read_courses'))) {
            // Capabilities earlier releases granted to the editor role beside the LearnDash
            // ones. None of them is a LearnDash capability: `manage_options` is the site
            // settings screens, and `list_users` and `edit_users` are the user accounts.
            // Revision 1 stops granting them. The list is a local rather than a class
            // constant so that coverage records it as executed and mutation testing reaches it.
            $dropped = [
                'list_users',
                'edit_users',
                'manage_options',
            ];
            foreach ($dropped as $cap) {
                $editor->remove_cap($cap);
            }
        }

        update_option(self::VERSION_OPTION, self::CAPS_VERSION);
    }

    /**
     * Remove the LearnDash capabilities from the Editor role on deactivation.
     */
    public static function uamsld_remove_roles(): void
    {
        // check if role exist before removing it
        $editor = get_role('editor');
        if ($editor && ($editor->has_cap('read_courses'))) {
            $caps = [
                'enroll_users',
                'edit_courses',
                'edit_others_courses',
                'publish_courses',
                'read_courses',
                'read_private_courses',
                'delete_courses',
                'edit_published_courses',
                'edit_private_courses',
                'delete_others_courses',
                'delete_published_courses',
                'delete_private_courses',
                'edit_groups',
                'edit_others_groups',
                'publish_groups',
                'read_groups',
                'read_private_groups',
                'delete_groups',
                'edit_published_groups',
                'delete_others_groups',
                'delete_published_groups',
                'edit_reports',
                'edit_others_reports',
                'publish_reports',
                'read_reports',
                'read_private_reports',
                'delete_reports',
                'edit_published_reports',
                'delete_others_reports',
                'delete_published_reports',
                'read_assignment',
                'edit_assignment',
                'edit_assignments',
                'edit_others_assignments',
                'publish_assignments',
                'read_assignment',
                'read_private_assignments',
                'delete_assignment',
                'edit_published_assignments',
                'delete_others_assignments',
                'delete_published_assignments',
                'edit_essays',
                'edit_others_essays',
                'publish_essays',
                'read_essays',
                'read_private_essays',
                'delete_essays',
                'edit_published_essays',
                'delete_others_essays',
                'delete_published_essays',
                'wpProQuiz_show',
                'wpProQuiz_add_quiz',
                'wpProQuiz_edit_quiz',
                'wpProQuiz_delete_quiz',
                'wpProQuiz_show_statistics',
                'wpProQuiz_reset_statistics',
                'wpProQuiz_import',
                'wpProQuiz_export',
                'wpProQuiz_change_settings',
                'wpProQuiz_toplist_edit',
                'wpProQuiz_toplist_edit',
            ];
            foreach ($caps as $cap) {
                $editor->remove_cap($cap);
            }
        }
    }
}
