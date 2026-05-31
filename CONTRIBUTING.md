# Contributing to Keenly

Thank you for helping maintain Keenly. Focused bug fixes, documentation improvements, compatibility work, and tests are welcome.

## Before You Start

- Check existing issues before opening a new one.
- Open an issue before making a large behavioral change.
- Keep pull requests small and scoped to one concern.
- Do not include credentials, local configuration, generated files, or unrelated formatting changes.

## Development Setup

Fork and clone the repository, then install dependencies:

```bash
git clone https://github.com/YOUR_USERNAME/keenly.git
cd keenly
composer install
```

Validate the package metadata and lint PHP files before submitting a pull request:

```bash
composer validate --strict --no-check-publish
find . -path ./.git -prune -o -path ./vendor -prune -o -name '*.php' -print0 | xargs -0 -n1 php -l
composer test
```

When changing behavior, add focused automated tests where possible and describe any manual verification steps in the pull request.

## Pull Requests

- Explain the problem and the chosen solution.
- Note any compatibility impact, especially for PHP, Smarty, Redis, or Swoole.
- Update `CHANGELOG.md` for user-visible changes.
- Add or update documentation when configuration or usage changes.
- Complete the pull request checklist.

## Reporting Bugs

Use the bug report template and include a minimal reproduction where possible. For vulnerabilities, do not open a public issue; follow [SECURITY.md](SECURITY.md).
