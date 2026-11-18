# Capabilities granted

Written against v0.3.0.

On activation the plugin adds 59 capabilities to the Editor role. They are LearnDash's own capability names, so an editor can work with courses, groups, reports, assignments, essays and quizzes without holding the Administrator role. The list lives in `uamsld_add_roles()` in `includes/uamswp-learndash-user.php`, and deactivation removes the same set (see [Activation, upgrade and deactivation](Activation-upgrade-and-deactivation.md)).

**Note:** the plugin does not check that LearnDash is active. It writes capability names to the Editor role whether or not LearnDash is installed, and the capabilities have an effect only where LearnDash registers the matching screens.

## Enrollment

| Capability | Effect |
| --- | --- |
| `enroll_users` | Enroll users in courses and groups. |

## Courses

| Capability | Effect |
| --- | --- |
| `read_courses` | Read courses. Also the marker the plugin uses to tell that it has already granted the set (see [Activation, upgrade and deactivation](Activation-upgrade-and-deactivation.md)). |
| `read_private_courses` | Read private courses. |
| `edit_courses` | Edit the editor's own courses. |
| `edit_others_courses` | Edit courses written by others. |
| `edit_published_courses` | Edit published courses. |
| `edit_private_courses` | Edit private courses. |
| `publish_courses` | Publish courses. |
| `delete_courses` | Delete the editor's own courses. |
| `delete_others_courses` | Delete courses written by others. |
| `delete_published_courses` | Delete published courses. |
| `delete_private_courses` | Delete private courses. |

## Groups

| Capability | Effect |
| --- | --- |
| `read_groups` | Read groups. |
| `read_private_groups` | Read private groups. |
| `edit_groups` | Edit the editor's own groups. |
| `edit_others_groups` | Edit groups written by others. |
| `edit_published_groups` | Edit published groups. |
| `publish_groups` | Publish groups. |
| `delete_groups` | Delete the editor's own groups. |
| `delete_others_groups` | Delete groups written by others. |
| `delete_published_groups` | Delete published groups. |

## Reports

| Capability | Effect |
| --- | --- |
| `read_reports` | Read reports. |
| `read_private_reports` | Read private reports. |
| `edit_reports` | Edit the editor's own reports. |
| `edit_others_reports` | Edit reports written by others. |
| `edit_published_reports` | Edit published reports. |
| `publish_reports` | Publish reports. |
| `delete_reports` | Delete the editor's own reports. |
| `delete_others_reports` | Delete reports written by others. |
| `delete_published_reports` | Delete published reports. |

## Assignments

| Capability | Effect |
| --- | --- |
| `read_assignment` | Read an assignment. |
| `read_private_assignments` | Read private assignments. |
| `edit_assignment` | Edit an assignment. |
| `edit_assignments` | Edit the editor's own assignments. |
| `edit_others_assignments` | Edit assignments written by others. |
| `edit_published_assignments` | Edit published assignments. |
| `publish_assignments` | Publish assignments. |
| `delete_assignment` | Delete an assignment. |
| `delete_others_assignments` | Delete assignments written by others. |
| `delete_published_assignments` | Delete published assignments. |

## Essays

| Capability | Effect |
| --- | --- |
| `read_essays` | Read essays. |
| `read_private_essays` | Read private essays. |
| `edit_essays` | Edit the editor's own essays. |
| `edit_others_essays` | Edit essays written by others. |
| `edit_published_essays` | Edit published essays. |
| `publish_essays` | Publish essays. |
| `delete_essays` | Delete the editor's own essays. |
| `delete_others_essays` | Delete essays written by others. |
| `delete_published_essays` | Delete published essays. |

## Quizzes

| Capability | Effect |
| --- | --- |
| `wpProQuiz_show` | See the quiz screens. |
| `wpProQuiz_add_quiz` | Add a quiz. |
| `wpProQuiz_edit_quiz` | Edit a quiz. |
| `wpProQuiz_delete_quiz` | Delete a quiz. |
| `wpProQuiz_show_statistics` | See quiz statistics. |
| `wpProQuiz_reset_statistics` | Reset quiz statistics. |
| `wpProQuiz_import` | Import quizzes. |
| `wpProQuiz_export` | Export quizzes. |
| `wpProQuiz_change_settings` | Change quiz settings. |
| `wpProQuiz_toplist_edit` | Edit a quiz's leaderboard entries. |

## Capabilities the plugin no longer grants

Earlier releases also gave the Editor role three site-management capabilities that are not LearnDash capabilities: `manage_options`, `list_users` and `edit_users`. Activation no longer adds them, and the upgrade removes them from a site that still holds them. See [Activation, upgrade and deactivation](Activation-upgrade-and-deactivation.md#the-upgrade).
