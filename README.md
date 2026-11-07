# UAMSWP Custom Editor for Learndash

A WordPress plugin that adds the LearnDash capabilities to the Editor role on activation and removes them on deactivation.

## Tests

The unit suite runs on Pest 5 with Brain Monkey, so it needs no database and no WordPress checkout. It develops and tests on PHP 8.4 (`config.platform.php` in `composer.json` pins `8.4.27`); the development dependencies are never part of the deployed plugin.

```bash
composer install
composer test
```

`composer test` runs `vendor/bin/pest` over `tests/Unit`. The same suite runs in GitHub Actions on every pull request.
