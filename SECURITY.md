# Security Policy

## Supported Versions

Keenly is resuming active maintenance. Until a new release is published, security fixes are evaluated against the latest code on the `master` branch and the most recent stable release, `2.3.6`.

| Version | Supported |
| --- | --- |
| `master` | Best effort |
| `2.3.6` | Best effort |
| Older releases | No |

## Reporting a Vulnerability

Please do not open a public GitHub issue for a suspected vulnerability.

Send a private report to `qiaopi520@qq.com` with:

- A description of the issue and its potential impact
- Reproduction steps or a proof of concept
- The affected version, commit, and configuration
- Any suggested mitigation, if available

Please allow maintainers time to investigate before publicly disclosing the issue. The project will acknowledge reports when possible and coordinate a fix or advisory based on severity and maintainer availability.

## Security Notes

- Treat files generated from `config/*.tpl` as starting points. Use unique secrets and deployment-specific credentials.
- Keep debug mode disabled in production.
- Review optional Redis and Swoole configuration before exposing services to a network.
- Treat the legacy encryption helpers in `common.php` as compatibility code. Do not use them for new sensitive data until they have received a dedicated cryptographic review.
- This policy is not a claim that the framework has completed a formal security audit.
