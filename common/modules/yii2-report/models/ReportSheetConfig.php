<?php

namespace lcssoft\report\models;

use lcssoft\report\events\ReportEvent;
use lcssoft\report\handler\ReportTemplateInterface;
use yii\base\Model;

class ReportSheetConfig extends Model implements ReportTemplateInterface
{
    const SHEET_DEFAULT = 'Sheet1';

    public $sheet;
    public $query;
    public $columns;
    public $rowOptions;
    public $beforeRender;
    public $afterRender;


    public function getQuery($parameters)
    {
        return $this->query;
    }

    public function columns()
    {
        // TODO: Implement columns() method.
        return $this->columns;
    }

    public function getReportFileName(): string
    {
        // TODO: Implement getReportFileName() method.
        return "";
    }

    public function getReportFileTemplate(): string
    {
        // TODO: Implement getReportFileTemplate() method.
        return "";
    }

    public function getReportLabel(): string
    {
        // TODO: Implement getReportLabel() method.
        return "";
    }

    public function getReportDownloadFolder(): string
    {
        // TODO: Implement getReportDownloadFolder() method.
        return "";
    }

    public function getInitFirstCell(): string
    {
        // TODO: Implement getInitFirstCell() method.
        return "";
    }

    public function beforeRender(ReportEvent $event)
    {
        // TODO: Implement beforeRender() method.
        if ($this->beforeRender instanceof \Closure) {
            call_user_func_array($this->beforeRender, ['event' => $event]);
        }
    }

    public function afterRender(ReportEvent $event)
    {
        // TODO: Implement afterRender() method.
        // TODO: Implement beforeRender() method.
        if ($this->afterRender instanceof \Closure) {
            call_user_func_array($this->afterRender, ['event' => $event]);
        }
    }

    public function initObject()
    {
        // TODO: Implement initObject() method.
    }

    public function rowOptions()
    {
      return $this->rowOptions;
    }

    public function sheets()
    {
        // TODO: Implement sheets() method.
        return $this->sheet;
    }
}