<?php

/**
 * Custom JSON response handling
 *
 * [type: framework]
 *
 * @author stas trefilov
 */

namespace App\Controller;

use Exception;
use Vertilia\Db\DbException;
use Vertilia\Response\JsonResponse;
use Vertilia\Util\Logger;

class AppJsonResponse extends JsonResponse
{
    public function handleException(Exception $e, Logger $log)
    {
        if (! ($e instanceof DbException)) {
            $log->error($e->getMessage());
        }
        $this->setError($e->getMessage());
    }
}
