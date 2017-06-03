<?php

namespace App\Env;

use Vertilia\Nls\Nls;
use Vertilia\Nls\Text;
use Vertilia\Request\HttpRequest;
use Vertilia\Request\Request;
use Vertilia\Ui\Html;

class ProdApp extends App
{
    /**
     * @param Request $request
     */
    function __construct(Request $request)
    {
        // define $lang and set cookies to $lang if http request
        if ($request instanceof HttpRequest) {
            $lang = App::getHttpLang($request, $_COOKIE, $_SERVER['HTTP_ACCEPT_LANGUAGE']);
            if (empty($_COOKIE[self::LANG_VAR]) or $_COOKIE[self::LANG_VAR] != $lang) {
                setcookie(self::LANG_VAR, $lang, $_SERVER['REQUEST_TIME'] + 2592000, '/'); // 1 month
            }
        }
        else {
            $lang = 'en';
        }

        $nls = new Nls($lang);
        $translation = "App\\Locale\\$lang\\".self::TRANSLATION_CLASS;

        parent::__construct(
            $request,
            $nls,
            new Text(new $translation()),
            new Html($nls)
        );
    }
}
