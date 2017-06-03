<?php

namespace App\Controller;

use App\Env\App;
use Vertilia\Request\CliRequest;
use Vertilia\Request\HttpRequest;
use Vertilia\Response\Renderable;

class Router
{
    /**
     * Returns a Renderable controller for the current HttpRequest based on array of routes
     * @param App $app application instance
     * @param array $routes array of routes, ex: [
     *  "POST /api/{ver}/invoices",
     *  "GET /api/{ver}/invoices/{id}",
     *  "GET /api/{ver}/invoices",
     *  "PATCH /api/{ver}/invoices/{id}",
     *  "DELETE /api/{ver}/invoices/{id}",
     * ]
     * @return Renderable
     * @see HttpRequest::setRequest for details of routes parsing
     */
    public static function getController(App $app, array $routes=null): Renderable
    {
        if ($app->request instanceof CliRequest) {
            // cli request
            return new CliController($app);
        } elseif ($routes and $app->request instanceof HttpRequest) {
            // http request
            $app->request->setRoutes($routes);
            if ($app->request->parseRoute()) {
                if (isset($app->request->controller)) {
                    if (class_exists($app->request->controller)) {
                        return new $app->request->controller($app);
                    } else {
                        return new UnknownController($app);
                    }
                } else {
                    return new UnknownController($app);
                }
            } else {
                return new NotFoundHttpController($app);
            }
        } else {
            return new NotFoundHttpController($app);
        }
    }

    public static function getRoutes(): array
    {
        return [
            'GET /' => IndexHtmlController::class,
            // contracts handling
            'POST /api/{ver}/contracts' => ContractsController::class,
            'GET /api/{ver}/contracts' => ContractsController::class,
            'GET /api/{ver}/contracts/{id}' => ContractsController::class,
            'PUT /api/{ver}/contracts/{id}' => ContractsController::class,
            'DELETE /api/{ver}/contracts/{id}' => ContractsController::class,
        ];
    }
}
