<?php

namespace App\Model\Contract;

use Vertilia\Data\Record;

class ContractRecord extends Record
{
    const ID = 'id';
    const ID_USERS = 'id_users';
    const OWNER_TYPE = 'owner_type';
    const REF_NUM = 'ref_num';
    const IS_VALID = 'is_valid';
    const DATE_UPDATED = 'date_updated';
    const DATE_BEGIN = 'date_begin';
    const DATE_END = 'date_end';
    const DESCRIPTION = 'description';
    const ATTR = 'attr';

    public $id;
    public $id_users;
    public $owner_type;
    public $ref_num;
    public $is_valid;
    public $date_updated;
    public $date_begin;
    public $date_end;
    public $description;
    public $attr;

    /**
     * @param array $params associative array with field values
     */
    public function __construct($params = null)
    {
        if (is_array($params)) {
            parent::__construct($params);
        } elseif (is_int($params)) {
            $this->id = $params;
            parent::__construct();
        }
    }
}
