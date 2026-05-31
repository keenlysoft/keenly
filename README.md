# Keenly

Keenly is a lightweight PHP framework for building small web applications and command-line tools. It provides routing, request helpers, session handling, Smarty-based views, a simple service container, model generation, and optional Swoole components.

The project is intentionally compact. It is suitable for developers who want to understand the framework internals, maintain an existing Keenly application, or contribute focused improvements without adopting a large application stack.

## Features

- HTTP routing with controller and action dispatch
- Request helpers for query parameters, form data, and raw request bodies
- Session handling with configurable file or Redis storage
- Smarty template rendering and cache configuration
- Model generation through the `keenly` command
- CLI controller invocation
- Simple dependency injection and singleton helpers
- Optional Redis and Swoole integrations
- Apache, Nginx, and IIS rewrite configuration examples

## Requirements

- PHP 7.1 or later in the PHP 7.x series
- Composer
- `ext-mbstring` for request and route handling
- `ext-openssl` for the bundled encryption helpers
- A web server such as Nginx, Apache, or IIS for web applications

Optional extensions depend on the features you use:

- `ext-gd` for CAPTCHA image helpers
- Redis and the relevant PHP extension for Redis-backed sessions or caching
- Swoole for the optional process, table, and HTTP server components

PHP 7.4 is the recommended runtime for the current stable line. PHP 8.x support is on the roadmap and should be treated as experimental until the framework and `keenlysoft/database` dependency have been audited and tested together.

## Installation

Create a new Keenly application with Composer:

```bash
composer create-project keenlysoft/app keenly
cd keenly
```

The framework package can also be installed directly when maintaining an existing application:

```bash
composer require keenlysoft/keenly
```

Composer uses Packagist by default. Older Keenly documentation referenced a regional Composer mirror; that mirror is no longer required.

## Quick Start

Define routes in your application's `config/routes.php`:

```php
<?php

use keenly\routes\routes;

routes::get('', 'index@index');
routes::get('home2/i/w', 'admin@index@home2');
routes::post('contact', 'index@contact');
routes::get('(:all)', false);
routes::keenly();
```

The `index@index` handler resolves to the default project's `indexController::index()` method. See the [routing guide](doc/routes.md) for the existing routing conventions.

For Nginx, route requests through your application's front controller:

```nginx
server {
    listen 80;
    server_name keenly.example;
    root /path/to/keenly/web;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ [^/]\.php(/|$) {
        try_files $uri =404;
        fastcgi_pass unix:/path/to/php-fpm.sock;
        fastcgi_index index.php;
        include fastcgi.conf;
    }
}
```

Replace the document root and `fastcgi_pass` value with paths that match your environment. IIS users can start from [`routes/config/Web.config`](routes/config/Web.config), and smaller Nginx rewrite examples are available in [`routes/config/nginx.conf`](routes/config/nginx.conf).

## CLI Usage

Generate models from the application root:

```bash
php keenly model
php keenly model user
php keenly model -f user
```

Run a controller action from the command line:

```bash
php keenly cli admin@index@index argument1 argument2
```

The CLI route format is `project@controller@method`, followed by optional arguments.

## Redis Connection

Configure Redis in your application's `config/database.php`. Do not commit production credentials:

```php
'redis' => [
    'driver'    => 'pconnect', // or connect
    'host'      => '127.0.0.1',
    'port'      => '6379',
    'password'  => '',
    'selectDB'  => '0',
    'timeout'   => '1',
    'rebinding' => '100',
],
```

Use the Redis component through the application container or the database package singleton:

```php
keenly::$box->redis->set();
redis::I()->use('0')->set();
```

## Pagination

Pagination is provided by the database package:

```php
$user = User::find()->where('id > 0');
$pag = new pagination($user->Count(), $page, 2);
$list = $user->limit($pag->limit)->offset($pag->offset)->all();

k::render('test', [
    'list' => $list,
    'page' => $pag->page(),
]);
```

Render `{$page}` in the Smarty template to display pagination HTML.

## Project Structure

| Path | Purpose |
| --- | --- |
| `base/` | Application container, singleton helper, CLI dispatch, and model generation |
| `component/` | Dependency injection helpers and optional Swoole integrations |
| `config/` | Application configuration templates |
| `request/` | HTTP request helper |
| `routes/` | Router, URL helper, and web server rewrite examples |
| `session/` | Session wrapper and configurable session handler |
| `view/` | Smarty view renderer |
| `doc/` | Additional project documentation |

## Documentation

- [Routing](doc/routes.md)
- [Views](VIEW.md)
- [Database package](https://github.com/keenlysoft/database)

## Roadmap

- Expand automated coverage for sessions, view rendering, and application bootstrapping
- Audit and document PHP 8.x compatibility across Keenly and `keenlysoft/database`
- Replace legacy configuration examples with environment-based application configuration
- Review optional Swoole components against currently supported Swoole versions
- Prepare the next compatibility release after the PHP 8.x audit and changelog review

## Contributing

Contributions are welcome. Please read [CONTRIBUTING.md](CONTRIBUTING.md), follow the [Code of Conduct](CODE_OF_CONDUCT.md), and report security issues according to [SECURITY.md](SECURITY.md).

## License

Keenly is released under the [Apache License 2.0](LICENSE).
