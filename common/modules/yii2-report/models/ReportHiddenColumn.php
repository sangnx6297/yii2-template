<?php

namespace lcssoft\report\models;


use lcssoft\report\entity\ReportMeta;
use lcssoft\report\handler\ReportHiddenColumnInterface;

class ReportHiddenColumn extends ReportMeta implements ReportHiddenColumnInterface
{

    public function getHiddenColumns()
    {
        return json_decode($this->extra_data, true) ?? [];
    }

}