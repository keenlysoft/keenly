# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project intends to follow [Semantic Versioning](https://semver.org/spec/v2.0.0.html) for future releases.

## [Unreleased]

### Added

- Contributor guide, security policy, code of conduct, issue templates, and pull request template
- GitHub Actions workflow for Composer validation and PHP syntax linting
- README sections for features, installation, quick start, requirements, structure, roadmap, and license

### Changed

- Improved Composer package metadata and removed the obsolete regional Packagist mirror
- Corrected the Composer PHP constraint to reflect syntax used by the current codebase
- Changed configuration templates to avoid enabled debug mode, privileged database users, and hard-coded example passwords by default

### Fixed

- Removed an accidental leading character from `component/Di.php` that could emit output when the class is loaded

## [2.3.6] - 2019-01-22

Latest published GitHub release. The repository also contains unreleased fixes committed after this release.

[Unreleased]: https://github.com/keenlysoft/keenly/compare/2.3.6...master
[2.3.6]: https://github.com/keenlysoft/keenly/releases/tag/2.3.6
