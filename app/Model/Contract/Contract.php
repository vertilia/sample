<?php

namespace App\Model\Contract;

use Vertilia\Db\Db;
use Vertilia\Db\DbEntity;
use Vertilia\Db\DbException;
use Vertilia\Nls\Nls;
use Vertilia\Nls\Text;
use Vertilia\Util\Logger;
use Vertilia\Util\Misc;

class Contract extends DbEntity
{
    protected $table = 'contracts';
    protected $id_fld = ContractRecord::ID;

    public $fields = [
        ContractRecord::ID => [self::TYPE=>self::TYPE_INT],
        ContractRecord::ID_USERS => [self::TYPE=>self::TYPE_INT],
        ContractRecord::OWNER_TYPE => [self::TYPE=>self::TYPE_ALPHA],
        ContractRecord::REF_NUM => [self::TYPE=>self::TYPE_ALPHA, self::WIDTH=>85],
        ContractRecord::IS_VALID => [self::TYPE=>self::TYPE_INT],
        ContractRecord::DATE_UPDATED => [self::TYPE=>self::TYPE_ALPHA],
        ContractRecord::DATE_BEGIN => [self::TYPE=>self::TYPE_ALPHA],
        ContractRecord::DATE_END => [self::TYPE=>self::TYPE_ALPHA],
        ContractRecord::DESCRIPTION => [self::TYPE=>self::TYPE_ALPHA, self::WIDTH=>255],
        ContractRecord::ATTR => [self::TYPE=>self::TYPE_BLOB, self::WIDTH=>65535],
    ];

    /**
     * @param Text $text
     * @param Nls $nls
     * @param Db $db
     * @param Logger $log
     */
    public function __construct(Text $text, Nls $nls, Db $db, Logger $log)
    {
        parent::__construct($text, $nls, $db, $log);
        $this->fields[ContractRecord::OWNER_TYPE][self::ITEMS] = [
            'prov'=>$text->_('provider'),
            'cli'=>$text->_('client'),
        ];
    }

    /**
     * @param array $params
     * @return array
     * @throws DbException
     */
    public function loadList(array $params = null): array
    {
        $rows = [];
        try {
            foreach ($this->db->fetchHash(Misc::vsprintfArgs(
                'select * from %table$s',
                ['table'=>$this->table]
            ), $this->id_fld) as $id => $row) {
                $rows[$id] = new ContractRecord($row);
            }
        } catch (DbException $e) {
            $this->log->error(Logger::STD_MESSAGE, [Logger::METHOD=>__METHOD__, Logger::EXCEPTION=>$e]);
            throw $e;
        }

        return $rows;
    }
}
