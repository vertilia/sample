# Sample application on [Vertilia Toolkit](https://github.com/vertilia/kit)

Vertilia Toolkit is a collection of useful code libraries for professional php development.

We use composer-based dependency management and PSR-4 autoloader. A single `index.php` file available in document root is a front controller, configured in `nginx.conf` file.

All application-specific code is placed in corresponding sub-directories of an `app` folder: models, views, controllers, environment configurations and translations.

## Features

+ composer-managed project dependencies
+ composer-managed PSR-4 autoloader
+ UI localization using .PO files
+ RESTful requests/responses
+ single global variable `$app`
+ dependency injection
+ fully namespaced
+ input validation
+ PSR-2 style
+ testability

## Translations

All user interface messages are handled by Text class from Vertilia Toolkit, which allows for full externalization of localization process.

First, the messages are collected from source code and stored in .PO files with `gettext` utility. Then human translators prepare a new language translation using standard tools that work with .PO files. Finally, the fully translated .PO file is converted to php format and merged with the source code.

## Application code structure

```
+-app/          <- application code
| +-Controller/ <- MVC code
| +-Env/        <- configurations
| +-Locale/     <- translations
| +-Model/      <- MVC code
| +-View/       <- MVC code
|
+-cli/          <- CLI scripts
|
+-tests/        <- phpunit tests
|
+-vendor/       <- libraries
| +-composer/   <- autoloading
| +-psr/
| +-vertilia/
| +-autoload.php
|
+-www/          <- document root
| +-index.php   <- front controller
+-composer.json
```

## Installation

When installing on machine with PHP version less than 7.0 run composer with `--ignore-platform-reqs` flag.

```
git clone https://github.com/vertilia/sample.git
cd sample
composer install
```

