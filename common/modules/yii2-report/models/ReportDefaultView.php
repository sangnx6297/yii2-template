<?php

namespace lcssoft\report\models;


use lcssoft\report\entity\ReportMeta;
use lcssoft\report\handler\ReportViewInterface;

class ReportDefaultView extends ReportMeta implements ReportViewInterface
{
    public function getDefaultView()
    {
        return $this->object_type;
    }
}