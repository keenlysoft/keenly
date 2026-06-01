# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project intends to follow [Semantic Versioning](https://semver.org/spec/v2.0.0.html) for future releases.

## [Unreleased]

## [2.5.0] - 2026-06-01

### Added

- Add CI validation across PHP 7.4, 8.1, 8.2, and 8.3.

### Changed

- Declare support for PHP 7.4 through PHP 8.x.
- Require `keenlysoft/database ^1.28` as the PHP 8 compatibility baseline.
- Update CI to `actions/checkout@v6`.

## [2.4.0] - 2026-06-01

### Added

- Contributor guide, security policy, code of conduct, issue templates, and pull request template
- GitHub Actions workflow for Composer validation and PHP syntax linting
- README sections for features, installation, quick start, requirements, structure, roadmap, and license
- PHPUnit test suite for containers, request handling, routing validation, and encryption helpers
- Dependabot configuration for Composer and GitHub Actions updates

### Changed

- Improved Composer package metadata and removed the obsolete regional Packagist mirror
- Corrected the Composer PHP constraint to reflect syntax used by the current codebase
- Changed configuration templates to avoid enabled debug mode, privileged database users, and hard-coded example passwords by default
- Updated Bootstrap and Smarty within compatible major versions and removed the unused vulnerable PHPUnit 5 development dependency

### Fixed

- Removed an accidental leading character from `component/Di.php` that could emit output when the class is loaded
- Corrected session key deletion, session regeneration, and cookie-domain handling
- Removed a debug-only CAPTCHA response and switched CAPTCHA digits to `random_int()`
- Disabled unrestricted controller/action routing in the default template and validated opt-in catch-all path segments
- Fixed modern PHP syntax compatibility in the Swoole process wrapper and removed debug output
- Hardened URL generation against untrusted host headers and escaped nested request parameters safely
- Migrated new OpenSSL helper payloads from legacy Blowfish CBC to versioned AES-256-CBC with HMAC verification before decryption

## [2.3.6] - 2019-01-22

Latest published GitHub release. The repository also contains unreleased fixes committed after this release.

[Unreleased]: https://github.com/keenlysoft/keenly/compare/2.5.0...master
[2.5.0]: https://github.com/keenlysoft/keenly/compare/2.4.0...2.5.0
[2.4.0]: https://github.com/keenlysoft/keenly/compare/2.3.6...2.4.0
[2.3.6]: https://github.com/keenlysoft/keenly/releases/tag/2.3.6
