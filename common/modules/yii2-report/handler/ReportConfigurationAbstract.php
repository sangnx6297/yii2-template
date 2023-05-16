<?php

namespace lcssoft\report\handler;

use yii\base\Model;

abstract class ReportConfigurationAbstract extends Model
{
    abstract public static function exportTemplateConfig();
}