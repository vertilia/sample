<?php

namespace App\Model\Contract;

use Vertilia\Data\Record;

class ContractRecord extends Record
{
    const CT_ID = 'ct_id';
    const CT_ON_ID = 'ct_on_id';
    const CT_CN_ID = 'ct_cn_id';
    const CT_UR_ID = 'ct_ur_id';
    const CT_OWNER_TYPE = 'ct_owner_type';
    const CT_REF_NUM = 'ct_ref_num';
    const CT_IS_VALID = 'ct_is_valid';
    const CT_DATE_UPDATED = 'ct_date_updated';
    const CT_DATE_BEGIN = 'ct_date_begin';
    const CT_DATE_END = 'ct_date_end';
    const CT_DESCRIPTION = 'ct_description';
    const CT_ATTR = 'ct_attr';

    public $ct_id;
    public $ct_on_id;
    public $ct_cn_id;
    public $ct_ur_id;
    public $ct_owner_type;
    public $ct_ref_num;
    public $ct_is_valid;
    public $ct_date_updated;
    public $ct_date_begin;
    public $ct_date_end;
    public $ct_description;
    public $ct_attr;

    /**
     * @param array $params associative array with field values
     */
    public function __construct($params = null)
    {
        if (is_array($params)) {
            parent::__construct($params);
        } elseif (is_int($params)) {
            $this->ct_id = $params;
            parent::__construct();
        }
    }
}
