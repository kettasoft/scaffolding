# Scaffolding™

[![Run Tests](https://github.com/ibrahimelmonier/scaffolding/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/ibrahimelmonier/scaffolding/actions/workflows/ci.yml)

## Requirements

* PHP 7.4 or higher
* Database (eg: MySQL, PostgreSQL, SQLite)
* Web Server (eg: Apache, Nginx)

[//]: # (* [Other libraries]&#40;'To Be Added'&#41;)

## Framework

Scaffolding uses [Laravel](http://laravel.com), the best existing PHP framework, as the foundation framework
and [Module](https://nwidart.com/laravel-modules/v6/introduction) package for Apps.

## Installation

* Install [Composer](https://getcomposer.org/download) and [Npm](https://nodejs.org/en/download)
* Clone the repository: `git clone https://github.com/ibrahimelmonier/scaffolding.git`
* if you want to change dashboard colors ?
* before running: `npm run dev`
  change `INSTALLER_CHOSEN_COLOR, MIX_INSTALLER_CHOSEN_COLOR, DASHBOARD_CHOSEN_COLOR, MIX_DASHBOARD_CHOSEN_COLOR` and
  set your desired color without `#`
* Install dependencies: `composer install ; npm install ; npm run dev`
* Create new MySQL database for this application
* Install Scaffolding:

simply visit this url `{{app_url}}/installer` and follow instructions

* Or :

If you use valet or linux system just execute the init.sh file to configure your environment automatically.

```bash
sh init.sh
```

* Or :

If you use Windows system just execute the init.bat file to configure your environment automatically.

```bash
init.bat
```

* Or :

```bash
php artisan install
```

* Or :

```bash
php artisan install --db-name="scaffolding" --db-username="root" --db-password="" --admin-name="admin" --admin-email="admin@demo.com" --admin-phone="987654321" --admin-password="password"
```

* Create sample data (optional):

```bash
php artisan sample-data:seed
```

* Or if you want a specific number

```bash
php artisan sample-data:seed --count="your count here"
```

