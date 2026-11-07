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
        public function __construct(private array $held) {}

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

it('adds the LearnDash capabilities to an editor without read_courses', function (): void {
    $editor = uamsld_fake_editor([]);
    // Current behavior: the role is looked up a second time inside the branch.
    Functions\expect('get_role')->twice()->with('editor')->andReturn($editor);

    UAMSWP_Learndash_Custom_Capabilities::uamsld_add_roles();

    expect($editor->added)
        ->toContain('read_courses', 'edit_groups', 'read_reports', 'edit_essays', 'wpProQuiz_show')
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

    expect($editor->removed)
        ->toContain('read_courses', 'edit_groups', 'read_reports', 'edit_essays', 'wpProQuiz_show')
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
