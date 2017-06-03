<?php

namespace App\Controller;

use App\Env\App;
use Vertilia\Response\CliResponse;

class CliController extends CliResponse
{
    /** @var App */
    public $app;

    function __construct(App $app)
    {
        $this->app = $app;
    }
}
