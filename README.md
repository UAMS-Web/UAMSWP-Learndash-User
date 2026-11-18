# UAMSWP Custom Editor for Learndash

A WordPress plugin that adds the LearnDash capabilities to the Editor role on activation and removes them on deactivation.

## Documentation

The [wiki](https://github.com/UAMS-Web/UAMSWP-Learndash-User/wiki) lists every capability the plugin grants and explains what it does on activation, on upgrade and on deactivation. Its pages are written in `docs/wiki/` and published from there by the `Publish wiki` workflow, so change them through a pull request.

## Requirements and installation

The plugin needs WordPress 6.8 or later and PHP 8.2 or later. Install it like any plugin, by placing its folder in the site's `wp-content/plugins/` directory, and activate it from the Plugins screen. Activation adds the capabilities to the Editor role; deactivation removes them.

## Tests

The unit suite runs on Pest 5 with Brain Monkey, so it needs no database and no WordPress checkout. It develops and tests on PHP 8.4 (`config.platform.php` in `composer.json` pins `8.4.27`); the development dependencies are never part of the deployed plugin.

```bash
composer install
composer test
```

`composer test` runs `vendor/bin/pest` over `tests/Unit`. The same suite runs in GitHub Actions on every pull request.

## Continuous integration

`.github/workflows/ci.yml` calls the shared chain in `UAMS-Web/uams-ci-workflows`, so this plugin runs the same checks as the other UAMS-Web repositories instead of a copy of them. The call runs on Linux only, runs mutation testing as `composer mutate` (a pull request mutates only the PHP files it changes; a manual run and the weekly scheduled run mutate everything), runs the unit suite as `composer test:unit`, and switches on the two jobs only a plugin runs: the PHP 8.2 floor lint and the download archive check. The job named `CI` reports the result of the whole call, and is the one check a ruleset requires from this workflow.

The floor lint parses every shipped PHP file with the supported floor. To run it locally under another PHP:

```sh
LINT_PHP=/path/to/php8.2 composer lint:floor
```

## Reading blame

`.git-blame-ignore-revs` lists the whole-repository reformat commits `git blame` should skip. Run this once per clone to turn it on:

```sh
git config blame.ignoreRevsFile .git-blame-ignore-revs
```

## Credits

Developed and maintained by UAMS Web Services.

Developers:

- Josh Daugherty
- Todd McKee, MEd
- Brent Passmore
