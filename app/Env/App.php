<?php

namespace App\Env;

use Vertilia\Db\Db;
use Vertilia\Nls\Nls;
use Vertilia\Nls\Text;
use Vertilia\Request\AjaxRequest;
use Vertilia\Request\CliRequest;
use Vertilia\Request\HttpRequest;
use Vertilia\Request\Request;
use Vertilia\Ui\Html;
use Vertilia\Util\Logger;

class App
{
    const LANG_VAR = 'ln';
    const TRANSLATION_CLASS = 'VertiliaSampleTranslation';

    const SHARD_USERS = 'users';
    const SHARD_CONTRACTS = 'contracts';
    const SHARD_STORAGE = 'storage';

    public static $languages = ['en'=>'English', 'fr'=>'Français'];

    /** @var Request */
    public $request;

    /** @var string */
    public $lang;

    /** @var Nls */
    public $nls;

    /** @var Text */
    public $text;

    /** @var Html */
    public $html;

    /** @var Logger */
    public $logger;

    /** @var Db */
    public $db_users;
    /** @var Db */
    public $db_contracts;
    /** @var Db */
    public $db_storage;

    /** initialise application parameters.
     *
     * to generate Text objects:
     * cd app/
     * php ../vendor/vertilia/kit/src/Nls/po2class.php Locale/en/vertilia-sample.po VertiliaSampleTranslation > Locale/en/VertiliaSampleTranslation.php
     * php ../vendor/vertilia/kit/src/Nls/po2class.php Locale/fr/vertilia-sample.po VertiliaSampleTranslation > Locale/fr/VertiliaSampleTranslation.php
     *
     * @param Request $request
     * @param Nls $nls
     * @param Text $text
     * @param Html $html
     * @param Logger $logger
     * @param Db $db_users
     * @param Db $db_contracts
     * @param Db $db_storage
     */
    function __construct(
        Request $request,
        Nls $nls,
        Text $text,
        Html $html,
        Logger $logger,
        Db $db_users,
        Db $db_contracts,
        Db $db_storage
    ) {
        $this->request = $request;
        $this->nls = $nls;
        $this->lang = $nls->lang;
        $this->text = $text;
        $this->html = $html;
        $this->logger = $logger;
        $this->db_users = $db_users;
        $this->db_contracts = $db_contracts;
        $this->db_storage = $db_storage;
    }

    /**
     *
     * @param string $method        ex: 'GET'
     * @param string $uri           ex: '/'
     * @param string $content_type  ex: 'application/json'
     * @param string $x_requested_with ex: 'XMLHttpRequest'
     * @param string $sapi          ex: 'fpm-fcgi'
     * @param array $request        array of CGI request params
     * @return Request instance of CliRequest, AjaxRequest or HttpRequest based on input params
     */
    public static function getRequest(
        string $method = null,
        string $uri = null,
        string $content_type = null,
        string $x_requested_with = null,
        string $sapi = null,
        array $request = null
    ): Request {
        if (strncmp($sapi, 'cli', 3) == 0) {
            return new CliRequest();
        } elseif ($x_requested_with == 'XMLHttpRequest') {
            return new AjaxRequest($method, $uri, $content_type, $request);
        } else {
            return new HttpRequest($method, $uri, $request);
        }
    }

    /**
     * @param HttpRequest $request  current request object
     * @param array $cookie         array of request cookies
     * @param array $accept_language Accept-Language http header
     * @return string language index from self::$languages array, based on values from request or cookies
     */
    public static function getHttpLang(HttpRequest $request, array $cookie = null, string $accept_language = null): string
    {
        if (isset($request->args[self::LANG_VAR]) and isset(self::$languages[$request->args[self::LANG_VAR]])) {
            return $request->args[self::LANG_VAR];
        } elseif (isset($cookie[self::LANG_VAR]) && isset(self::$languages[$cookie[self::LANG_VAR]])) {
            return $cookie[self::LANG_VAR];
        } else {
            return $request->getLang($accept_language, array_keys(self::$languages), 'fr');
        }
    }
}
