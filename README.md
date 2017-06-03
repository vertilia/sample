# Sample application on Vertilia Toolkit

Vertilia Toolkit is a collection of useful code libraries for professional php development.

We use front controller (a single `index.php` file available in document root), composer-based dependency management and PSR-4 autoloader.

## Basic principles

+ composer-managed project dependencies
+ composer-managed PSR-4 autoloader
+ single global variable `$app`
+ RESTful requests/responses
+ dependency injection
+ fully namespaced
+ input validation
+ PSR-2 style
+ testability

## Application code structure

```
+-app/ -- where application code goes
| +-Controller/
| +-Env/
| +-Locale/
| +-Model/
| +-View/
|
+-cli/ -- CLI scripts
|
+-tests/ -- phpunit tests
|
+-vendor/ -- vendor libraries
| +-composer/
| +-psr/
| +-vertilia/
| +-autoload.php
|
+-www/ -- document root
  +-index.php
```

## Installation

When installing on machine with PHP version less than 7.0 run composer with `--ignore-platform-reqs` flag.

```
git clone https://github.com/vertilia/sample.git
cd sample
composer install
```

