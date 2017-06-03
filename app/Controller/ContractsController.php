<?php

namespace App\Controller;

use App\Env\App;
use App\Model\Contract\Contract;
use App\Model\Contract\ContractRecord;
use Exception;
use Vertilia\Data\Entity;
use Vertilia\Request\HttpRequest;

class ContractsController extends AppJsonResponse
{
    /** @var App */
    public $app;
    /** @var Contract */
    public $contract;

    /**
     * @param App $app
     */
    function __construct(App $app)
    {
        $this->app = $app;
        $this->contract = new Contract($app->text, $app->nls, $app->db_contracts, $app->logger);
        $args = $this->app->request->args;

        if (empty($args['id'])) {
            // no additional components
            switch ($this->app->request->method) {
                case HttpRequest::METHOD_GET:
                    $this->listAction();
                    break;
                case HttpRequest::METHOD_POST:
                    $this->createAction();
                    break;
                default:
                    $this->setError($app->text->_('Unhandled method'), 405);
            }
        } elseif (is_numeric($args['id'])) {
            // second component is an id
            switch ($this->app->request->method) {
                case HttpRequest::METHOD_GET:
                    $this->readAction($args['id']);
                    break;
                case HttpRequest::METHOD_PUT:
                    $this->updateAction($args['id']);
                    break;
                case HttpRequest::METHOD_DELETE:
                    $this->deleteAction($args['id']);
                    break;
                default:
                    $this->setError($app->text->_('Unhandled method'), 405);
            }
        } else {
            $this->setError($app->text->_('Wrong contract id'));
        }
    }

    public function listAction()
    {
        $this->result = $this->contract->loadList();
    }

    public function createAction()
    {
        $ct = new ContractRecord([ContractRecord::CT_ON_ID=>1, ContractRecord::CT_UR_ID=>1] + $this->app->request->args);
        if (! $this->contract->validate($ct, [
            ContractRecord::CT_CN_ID => Entity::REQUIRED,
            ContractRecord::CT_OWNER_TYPE => Entity::REQUIRED,
            ContractRecord::CT_REF_NUM => Entity::REQUIRED,
            ContractRecord::CT_IS_VALID => [],
            ContractRecord::CT_DATE_UPDATED => [],
            ContractRecord::CT_DATE_BEGIN => [],
            ContractRecord::CT_DATE_END => [],
            ContractRecord::CT_DESCRIPTION => [],
            ContractRecord::CT_ATTR => [],
        ])) {
            $this->setError($this->app->text->_($this->contract->errors));
        } elseif (1 != $ct->ct_cn_id) {
            $this->setError($this->app->text->_('you are not authorized to create contracts with this company'));
        } elseif ($ct->ct_date_begin and $ct->ct_date_end and $ct->ct_date_begin != $ct->ct_date_end) {
            $this->setError($this->app->text->_('beginning and end dates do not match'));
        } else {
            $ct->ct_ur_id = 1;
            $ct->ct_on_id = 1;
            try {
                $this->result = $this->contract->saveRecord($ct);
            } catch (Exception $e) {
                $this->handleException($e, $this->app->logger);
            }
        }
    }

    /**
     * @param int $id
     */
    public function readAction(int $id)
    {
        try {
            $this->result = $this->contract->loadRecord(new ContractRecord($id));
        } catch (Exception $e) {
            $this->handleException($e, $this->app->logger);
        }
    }

    /**
     * @param int $id
     */
    public function updateAction(int $id)
    {
        $this->result = ['id'=>$id] + $this->app->request->args;
    }

    /**
     * @param int $id
     */
    public function deleteAction(int $id)
    {
        unset($this->result);
    }
}
