<?php

namespace lcssoft\report\models;

use Faker\Provider\Uuid;
use yii\base\Model;
use yii\db\ActiveQuery;

class ReportActiveJoinQuery extends Model
{

    const INNER_JOIN = 'INNER JOIN';
    const LEFT_JOIN = 'LEFT JOIN';
    /**
     * @var ActiveQuery
     */
    private $_activeQuery;

    private $_joinType;

    private $_joinSrcAlias;

    private $_joinSrcAttribute;
    private $_joinDestAttribute;

    private $_uuid;

    public function __construct($activeQuery, $srcAttribute, $destAttribute,  $joinType = self::INNER_JOIN, $config = [])
    {
        parent::__construct($config);
        $this->_activeQuery = $activeQuery;
        $this->_joinType = $joinType;
        $this->_joinSrcAttribute = $srcAttribute;
        $this->_joinDestAttribute = $destAttribute;
        $this->_uuid = Uuid::uuid();
    }

    public function srcAlias($str){
        $this->_joinSrcAlias = $str;
        return $this;
    }

    public function getJoinCondition($destAlias){
        $srcAlias = $this->_joinSrcAlias ?? substr($this->_uuid,1,8);
        return "{$srcAlias}.$this->_joinSrcAttribute = {$destAlias}.$this->_joinDestAttribute";
    }

    public function getJoinType(){
        return $this->_joinType;
    }

    public function getSrcAlias(){
        $srcAlias = $this->_joinSrcAlias ?? substr($this->_uuid,1,8);
        return $srcAlias;
    }

    public function build(){
        return $this->_activeQuery;
    }
}