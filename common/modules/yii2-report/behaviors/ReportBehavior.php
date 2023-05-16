<?php

namespace lcssoft\report\behaviors;

use lcssoft\report\events\ReportEvent;
use yii\base\Behavior;

class ReportBehavior extends Behavior
{


    const EVENT_BEFORE_REPORT_RENDER = 'beforeReportRender';
    const EVENT_AFTER_REPORT_RENDER = 'afterReportRender';

    public function events()
    {
        return [
            self::EVENT_BEFORE_REPORT_RENDER => 'beforeReportRender',
            self::EVENT_AFTER_REPORT_RENDER => 'afterReportRender',
        ];
    }

    public function beforeReportRender(ReportEvent $event)
    {
        var_dump("beforeReportRender");
    }

    public function afterReportRender(ReportEvent $event)
    {
        var_dump("afterReportRender");
    }

}