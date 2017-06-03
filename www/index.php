<?php

require_once (dirname(__DIR__)."/vendor/autoload.php");

use App\Controller\Router;
use App\Env\App;
use App\Env\ProdApp;
use App\Env\StageApp;
use App\Env\VmApp;

// determine environment
switch (__DIR__) {
    case '/home/www/www.production-domain.com/www':
        $app = new ProdApp(App::getRequest(
            $_SERVER['REQUEST_METHOD'] ?? null,
            $_SERVER['REQUEST_URI'] ?? null,
            $_SERVER['HTTP_CONTENT_TYPE'] ?? null,
            $_SERVER['HTTP_X_REQUESTED_WITH'] ?? null,
            PHP_SAPI,
            $_REQUEST
        ));
        break;
    case '/home/www/www.stage-domain.net/www':
        $app = new StageApp(App::getRequest(
            $_SERVER['REQUEST_METHOD'] ?? null,
            $_SERVER['REQUEST_URI'] ?? null,
            $_SERVER['HTTP_CONTENT_TYPE'] ?? null,
            $_SERVER['HTTP_X_REQUESTED_WITH'] ?? null,
            PHP_SAPI,
            $_REQUEST
        ));
        break;
    case '/usr/home/www/vertilia-sample/www':
        $app = new VmApp(App::getRequest(
            $_SERVER['REQUEST_METHOD'] ?? null,
            $_SERVER['REQUEST_URI'] ?? null,
            $_SERVER['HTTP_CONTENT_TYPE'] ?? null,
            $_SERVER['HTTP_X_REQUESTED_WITH'] ?? null,
            PHP_SAPI,
            $_REQUEST
        ));
        break;
    default:
        $app = new ProdApp(App::getRequest(
            $_SERVER['REQUEST_METHOD'] ?? null,
            $_SERVER['REQUEST_URI'] ?? null,
            $_SERVER['HTTP_CONTENT_TYPE'] ?? null,
            $_SERVER['HTTP_X_REQUESTED_WITH'] ?? null,
            PHP_SAPI,
            $_REQUEST
        ));
}

// dispatch and render request
Router::getController($app, Router::getRoutes())->render();
