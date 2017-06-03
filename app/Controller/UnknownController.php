<?php

namespace App\Controller;

use App\Env\App;
use Vertilia\Response\JsonResponse;

class UnknownController extends JsonResponse
{
    /** @var App */
    public $app;

    function __construct(App $app)
    {
        $this->app = $app;
        $this->setError($app->text->_('Unknown ressource requested'), 404);
    }
}
