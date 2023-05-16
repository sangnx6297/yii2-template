<?php

namespace lcssoft\report\handler;

use lcssoft\report\events\ReportEvent;
use lcssoft\report\models\ReportSheetConfig;
use yii\db\ActiveQuery;

interface ReportTemplateInterface
{

    /**
     * @param $parameters
     * @return ActiveQuery
     */
    public function getQuery($parameters);

    /**
     * @desc
     * @array [
     *              'class' => ReportColumnData::class,
     *              'attribute' => '',
     *              'value' => string | closure function
     *              'label' => '',
     *              'format' => ''
     *         ]
     * @return mixed
     */
    public function columns();

    /**
     * @return string
     */
    public function getReportFileName(): string;

    /**
     * @return string
     */
    public function getReportFileTemplate(): string;

    /**
     * @return string
     */
    public function getReportLabel(): string;

    /**
     * @return string
     */
    public function getReportDownloadFolder(): string;

    /**
     * @return array
     */
    public function getInitFirstCell(): string;

    /**
     * @return array
     */
    public function beforeRender(ReportEvent $event);

    /**
     * @return array
     */
    public function afterRender(ReportEvent $event);

    public function initObject();

    public function rowOptions();

    /**
     * @return ReportSheetConfig | ReportSheetConfig[]
     */
    public function sheets();
}