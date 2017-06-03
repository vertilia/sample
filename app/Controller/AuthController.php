<?php

namespace App\Controller;

use App\Env\App;
use Vertilia\Request\HttpRequest;
use Vertilia\Response\JsonResponse;

class AuthController extends JsonResponse
{
    /** @var App */
    public $app;
    /** @var string */
    public $table = 'contracts';

    function __construct(App $app, array $components)
    {
        $this->app = $app;

        if (empty($components[1])) {
            switch ($this->app->request->method) {
                case HttpRequest::METHOD_POST:
                    $this->loginAction();
                    break;
                default:
                    $this->setError($app->text->_('Unhandled method'), 405);
            }
        } elseif ($components[1] == 'logout') {
            switch ($this->app->request->method) {
                case HttpRequest::METHOD_DELETE:
                    $this->logoutAction();
                    break;
                default:
                    $this->setError($app->text->_('Unhandled method'), 405);
            }
        } else {
            $this->setError($app->text->_('Wrong contract id'));
        }
    }

    public function loginAction()
    {
        $this->result = [];
    }

    public function logoutAction()
    {
        unset($this->result);
    }
}
