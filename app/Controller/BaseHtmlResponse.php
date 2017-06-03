<?php

namespace App\Controller;

use Vertilia\Response\HtmlResponse;
use Vertilia\Ui\Html;

class BaseHtmlResponse extends HtmlResponse
{
    function __construct(string $template, Html $html, string $lang)
    {
        parent::__construct($template, $html, $lang);

        $this->head_pool['bootstrap.css'] = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
        $this->scripts_pool['jquery.js'] = '<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>';
        $this->scripts_pool['underscore.js'] = '<script src="//underscorejs.org/underscore-min.js"></script>';
        $this->scripts_pool['backbone.js'] = '<script src="//backbonejs.org/backbone-min.js"></script>';
        $this->scripts_pool['bootstrap.js'] = '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>';
    }
}
