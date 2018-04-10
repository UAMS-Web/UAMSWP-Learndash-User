<?php
class UAMSWP_Learndash_Custom_Capabilities {
	/**
	 * @var UAMSWP_Learndash_Custom_Capabilities
	 */
	private static $instance;

	/**
	 * Add custom capabilities to editors for learndash on deactivation.
	 */
	public static function uamsld_add_roles() {
		$editor = get_role( 'editor' );
		if ( $editor && !($editor->has_cap( 'read_courses' ) ) ) {
			// Add role capabilities for LD
			$editor = get_role( 'editor' );
			$caps = array(
				'list_users',
				'edit_users',
				'enroll_users',
				'manage_options',
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
				'wpProQuiz_toplist_edit'
			);
			foreach ( $caps as $cap ) {
				$editor->add_cap( $cap );
			}
		}
	}
	/**
	 * Remove custom roles on deactivation.
	 */
	public static function uamsld_remove_roles(){
		//check if role exist before removing it
		$editor = get_role( 'editor' );
		if ( $editor && ($editor->has_cap( 'read_courses' ) ) ) {
			$caps = array(
				'list_users',
				'edit_users',
				'enroll_users',
				'manage_options',
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
				'wpProQuiz_toplist_edit'
			);
			foreach ( $caps as $cap ) {
				$editor->remove_cap( $cap );
			}
		}
	}

}
