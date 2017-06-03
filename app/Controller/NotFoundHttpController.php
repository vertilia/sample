<?php

namespace App\Controller;

use Vertilia\Response\Renderable;

class NotFoundHttpController implements Renderable
{
    public function render()
    {
        http_response_code(404);
    }
}
