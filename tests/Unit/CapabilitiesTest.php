<?php

/**
 * UAMSWP_Learndash_Custom_Capabilities, with WordPress mocked.
 *
 * Characterization tests: they pin what the class does now.
 *
 * @see includes/uamswp-learndash-user.php
 */

declare(strict_types=1);

use Brain\Monkey\Functions;

/**
 * Stand-in for the editor role: records which capabilities were added or removed.
 *
 * @param  list<string>  $held  Capabilities the role already has.
 */
function uamsld_fake_editor(array $held): object
{
    return new class($held)
    {
        /** @var list<string> */
        public array $added = [];

        /** @var list<string> */
        public array $removed = [];

        /** @param  list<string>  $held */
        public function __construct(private readonly array $held) {}

        public function has_cap(string $cap): bool
        {
            return in_array($cap, $this->held, true);
        }

        public function add_cap(string $cap): void
        {
            $this->added[] = $cap;
        }

        public function remove_cap(string $cap): void
        {
            $this->removed[] = $cap;
        }
    };
}

/**
 * The capabilities the plugin grants to and removes from the editor role, in call order.
 *
 * Two entries repeat in the plugin's list (`read_assignment`, `wpProQuiz_toplist_edit`);
 * the repeats are pinned as they are, since each is one more `add_cap()` call.
 *
 * @return list<string>
 */
function uamsld_expected_caps(): array
{
    return [
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
        'wpProQuiz_toplist_edit',
    ];
}

it('adds the LearnDash capabilities to an editor without read_courses', function (): void {
    $editor = uamsld_fake_editor([]);
    // Current behavior: the role is looked up a second time inside the branch.
    Functions\expect('get_role')->twice()->with('editor')->andReturn($editor);

    UAMSWP_Learndash_Custom_Capabilities::uamsld_add_roles();

    expect($editor->added)->toBe(uamsld_expected_caps())
        ->and($editor->removed)->toBe([]);
});

it('leaves an editor that already has read_courses alone when adding', function (): void {
    $editor = uamsld_fake_editor(['read_courses']);
    Functions\expect('get_role')->once()->with('editor')->andReturn($editor);

    UAMSWP_Learndash_Custom_Capabilities::uamsld_add_roles();

    expect($editor->added)->toBe([]);
});

it('removes the LearnDash capabilities from an editor that has read_courses', function (): void {
    $editor = uamsld_fake_editor(['read_courses']);
    Functions\expect('get_role')->once()->with('editor')->andReturn($editor);

    UAMSWP_Learndash_Custom_Capabilities::uamsld_remove_roles();

    expect($editor->removed)->toBe(uamsld_expected_caps())
        ->and($editor->added)->toBe([]);
});

it('leaves an editor without read_courses alone when removing', function (): void {
    $editor = uamsld_fake_editor([]);
    Functions\expect('get_role')->once()->with('editor')->andReturn($editor);

    UAMSWP_Learndash_Custom_Capabilities::uamsld_remove_roles();

    expect($editor->removed)->toBe([]);
});

it('does nothing when the editor role does not exist', function (string $method): void {
    Functions\expect('get_role')->once()->with('editor')->andReturn(null);

    UAMSWP_Learndash_Custom_Capabilities::$method();
})->with([
    'add' => ['uamsld_add_roles'],
    'remove' => ['uamsld_remove_roles'],
]);

// cspell:ignore wpProQuiz
