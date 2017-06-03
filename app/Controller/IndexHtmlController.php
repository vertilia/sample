<?php

namespace App\Controller;

use App\Env\App;

class IndexHtmlController extends BaseHtmlResponse
{
    /** @var App */
    public $app;

    /**
     * @param App $app
     */
    function __construct(App $app)
    {
        $this->app = $app;
        $this->title = 'Vertilia Sample';

        parent::__construct(dirname(__DIR__).'/View/index.php', $this->app->html, $this->app->nls->lang);
    }

    public function render()
    {
        parent::render();
//        var_dump($this->app->request);
    }
}
