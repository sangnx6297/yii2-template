<?php

namespace lcssoft\report\handler;


use lcssoft\report\behaviors\ReportBehavior;
use lcssoft\report\events\ReportEvent;
use lcssoft\report\helpers\Logger;
use lcssoft\report\helpers\Utilities;
use lcssoft\report\models\ReportSession;
use lcssoft\report\models\ReportSheetConfig;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use yii\base\Model;
use yii\base\UnknownPropertyException;
use yii\db\ActiveQuery;
use yii\db\Exception;
use yii\db\Query;

class ReportHandler extends Model
{


    public $objectClass;
    public $parameters;

    /**
     * @return bool
     * @throws Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function exec()
    {

        $object = \Yii::createObject($this->objectClass);

        if (!($object instanceof ReportTemplateInterface)) {
            throw new Exception("Object not instance of ReportTemplateInterface");
        }

        $template = \yii\helpers\Url::to('@rootPath/sample/report-template.xlsx');

        if ($tempTemplate = $object->getReportFileTemplate()) {
            $template = $tempTemplate;
        }
        $query = $object->getQuery($this->parameters);

        if(method_exists($object, 'init')){
            $object->init();
        }else{
            $object->initObject();
        }
        $sheets = $object->sheets();

        if(empty($sheets)){

            $columns = $object->columns();
            $rowOptions = $object->rowOptions();
            return $this->handler($object, $query, $this->initColumns($columns, $query), $rowOptions, $template, null, null);
        }

        $result = false;
        foreach ($sheets as $sheet){

            if($sheet instanceof ReportSheetConfig){
                $query = $sheet->query;
                $columns = $sheet->columns;
                $rowOptions = $sheet->rowOptions;
                $result = $this->handler($object, $query, $this->initColumns($columns, $query), $rowOptions, $template, $sheet->sheet, $sheet);
                if($result){
                    $template = $result;
                }
            }

        }
        return $result;
    }

    /**

     * @return boolean
     * @param $object Model | ReportTemplateInterface
     * @param $query ActiveQuery
     * @param $columns ReportColumnData[]
     * @param $rowOptions
     * @param $template
     * @param $sheet
     * @param $sheetConfig ReportSheetConfig
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function handler($object, $query, $columns, $rowOptions, $template, $sheet, $sheetConfig)
    {
        $sessionStorage = new ReportSession();

        $fistCellString = $object->getInitFirstCell();
        list($rowIndex, $colIndex) = $this->detectInitValue($fistCellString);

        $objExcelTemplate = IOFactory::load($template);
        if (empty($sheet)) {
            $activeSheet = $objExcelTemplate->getActiveSheet();
        } else {
            if(in_array(ReportSheetConfig::SHEET_DEFAULT, $objExcelTemplate->getSheetNames())){
                $activeSheet = $objExcelTemplate->getSheetByName(ReportSheetConfig::SHEET_DEFAULT);
                $activeSheet->setTitle($sheet);
            } else if (in_array($sheet, $objExcelTemplate->getSheetNames())) {
                $activeSheet = $objExcelTemplate->getSheetByName($sheet);
            } else {
                $activeSheet = $objExcelTemplate->createSheet(null);
                $activeSheet->setTitle($sheet);
                Logger::log("Working on ".$activeSheet->getTitle());
            }
        }

        $activeSheet = $this->renderSheetHeader($activeSheet, $object, $columns, $rowIndex, $colIndex);
        $startRow = $rowIndex;
//        $this->initEvents($object->getReportEvents());

        $this->beforeRender($object, $activeSheet, $startRow, $startRow, $sessionStorage, $sheetConfig);
        $activeSheet = $this->renderSheetBody($query, $activeSheet, $columns, $rowOptions, $rowIndex, $colIndex, $sessionStorage);
        $this->afterRender($object, $activeSheet, $startRow, $rowIndex, $sessionStorage, $sheetConfig);

        $objWriter = IOFactory::createWriter($activeSheet->getParent(), 'Xlsx');
        $basePath = \yii\helpers\Url::to('@rootPath/static/download');
        $objectClass = explode("\\",get_class($object));

        if ($basePathTemp = $object->getReportDownloadFolder()) {
            $basePath = $basePathTemp;
        } else {
            $basePath = Utilities::createDirectory([$basePath, date('Y'), date('m'), $objectClass[count($objectClass) - 1]]);
        }


        $filePath = $basePath . DIRECTORY_SEPARATOR . $this->getFileName($object) . date('Y_m_d_h_i_s') . '.xlsx';

        $objWriter->save($filePath);
        return $filePath;
    }

    /**
     * @param $columns
     * @param $query ActiveQuery
     * @return ReportColumnData[]
     */
    public function initColumns($columns, $query)
    {
        $columnData = [];

        if (empty($columns)) {
            throw new \yii\base\Exception("Columns must be declare.");
        }

        $columnData[] = $this->getIndexColumn();

        foreach ($columns as $column) {

            $columnConfig = [];

            if (is_array($column)) {
                $columnConfig = array_merge($columnConfig, $column);
            } else {
                $columnConfig = [
                    'attribute' => $column,
                ];
            }

            if (!isset($columnConfig['class'])) {
                $columnConfig['class'] = ReportColumnData::class;
            }

            $columnData[] =  \Yii::createObject($columnConfig);
        }

        return $columnData;
    }

    public function getIndexColumn()
    {
        $config = [
            'class' => ReportColumnData::class,
            'label' => \Yii::t('backend', 'Index'),
            'value' => function ($model, $cell, $index, $rowIndex) {
                return $index + 1;
            }
        ];

        return \Yii::createObject($config);
    }

    /**
     * @param $activeSheet Worksheet
     * @param $object Model
     * @param $columns ReportColumnData[]
     * @return Worksheet
     */
    public function renderSheetHeader($activeSheet, $object, $columns, &$rowIndex, $colIndex)
    {
        $rowIndex = $rowIndex++;

        echo PHP_EOL;
        echo PHP_EOL;


        foreach ($columns as $idx => $column) {
            $colStr = Coordinate::stringFromColumnIndex(($idx+ $colIndex));
            $cellKey = "{$colStr}{$rowIndex}";
            if($column->headerOptions){
                $activeSheet->getCell($cellKey)->getStyle()->applyFromArray($column->headerOptions, false);
                $activeSheet->getColumnDimension($colStr)->setAutoSize($column->autoResize);
            }

            $activeSheet->getCell($cellKey)->setValue($column->getLabel($object));
            echo $activeSheet->getCell($cellKey)->getValue()."\t|\t";
        }
        echo PHP_EOL;
        return $activeSheet;
    }

    /**
     * @param $dataProvider ActiveQuery | ActiveQuery []
     * @param $activeSheet Worksheet
     * @param $columns ReportColumnData []
     * @param $rowIndex integer
     * @return Worksheet
     * @throws \yii\base\InvalidConfigException
     */
    public function renderSheetBody($dataProviders, $activeSheet, $columns, $rowOptions, &$rowIndex, $colIndex, $sessionStorage)
    {

        if (is_array($dataProviders)) {
            if (!empty($dataProviders)) {
                if ($dataProviders[0] instanceof ActiveQuery) {
                    Logger::log($dataProviders[0]->createCommand()->rawSql);
                }
            }

            foreach ($dataProviders as $idx => $dataProvider) {
                $activeSheet = $this->renderBodyWithSingleDataProvider($dataProvider, $activeSheet, $columns, $rowOptions, $rowIndex, $colIndex, $idx, $sessionStorage);
                $rowIndex--;
            }

            $rowIndex++;
            return $activeSheet;
        } else {
            if ($dataProviders instanceof ActiveQuery) {
                Logger::log($dataProviders->createCommand()->rawSql);
            }
            return $this->renderBodyWithSingleDataProvider($dataProviders, $activeSheet, $columns, $rowOptions, $rowIndex, $colIndex, 0, $sessionStorage);
        }
    }

    /**
     * @param $dataProvider ActiveQuery | mixed
     * @param $activeSheet Worksheet
     * @param $columns ReportColumnData []
     * @param $rowIndex
     * @param $colIndex
     * @param $index
     * @param $sessionStorage ReportSession
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function renderBodyWithSingleDataProvider($dataProvider, $activeSheet, $columns, $rowOptions, &$rowIndex, $colIndex, $index = 0, $sessionStorage)
    {
        $rowIndex++;
        if ($dataProvider instanceof Query) {
            $statement = $dataProvider->createCommand(\Yii::$app->get('dberpslave'))->query();
            while ($objectData = $statement->read()) {
                $this->renderBody($objectData, $activeSheet, $columns, $rowOptions, $rowIndex, $colIndex, $index, $sessionStorage);
            }
        } else if (is_array($dataProvider)) {
            foreach ($dataProvider as $objectData) {
                $this->renderBody($objectData, $activeSheet, $columns, $rowOptions, $rowIndex, $colIndex, $index, $sessionStorage);
            }
        }
        return $activeSheet;
    }

    protected function renderBody($objectData, $activeSheet, $columns, $rowOptions, &$rowIndex, $colIndex, &$index, $sessionStorage)
    {
        /**
         * @var $object Model
         */
        try {
            $objectData['class'] = $this->objectClass;
            $object = \Yii::createObject($objectData);
        } catch (UnknownPropertyException $ex) {
            Logger::error($ex);
            $object = new $this->objectClass;
            foreach ($objectData as $key => $value) {
                if (!$object->hasProperty($key)) {
                    continue;
                }
                $object->{$key} = $value;
            }
        }


        $tempColIndex = $colIndex;
//            $colStr = Coordinate::stringFromColumnIndex($colIndex++);
//            $activeSheet->getCell("{$colStr}{$rowIndex}")->setValue(($index + 1));


        foreach ($columns as $idx => $column) {

            $colStr = Coordinate::stringFromColumnIndex($tempColIndex++);
            $cell = $column->renderAttribute($activeSheet->getCell("{$colStr}{$rowIndex}"), $object, $index, $rowIndex, $objectData, $sessionStorage);

            $args = [
                'model' => $object,
                'cell' => $cell,
                'index' => $index,
                'rowIndex' => $rowIndex,
            ];

            $cellKey = "{$colStr}{$rowIndex}";

            if ($column->contentOptions) {
                $activeSheet->getCell($cellKey)->getStyle()->applyFromArray($column->contentOptions);
            }

            $activeSheet->getCell($cellKey)->setValue($column->formattedValue($cell->getValue(), $args));

//                if($idx == 0){
            $activeSheet->getColumnDimension($colStr)->setAutoSize($column->autoResize);
            $activeSheet->getColumnDimension($colStr)->setWidth($column->getAttributeValue('width', $args));
            $activeSheet->getColumnDimension($colStr)->setVisible($column->getAttributeValue('visible', $args));
//                }

            if ($column->dataType) {
                $activeSheet->getCell($cellKey)->setDataType($column->dataType);
            }
            if ($column->excelNumberFormat) {
                $activeSheet->getStyle($cellKey)->getNumberFormat()->setFormatCode($column->excelNumberFormat);
            }

            echo $activeSheet->getCell($cellKey)->getValue() . "\t|\t";
        }
        $minCol = Coordinate::stringFromColumnIndex($colIndex);
        $maxCol = Coordinate::stringFromColumnIndex(($tempColIndex - 1));
        $rowRangeString = "{$minCol}{$rowIndex}:{$maxCol}{$rowIndex}";
        $options = $rowOptions;
        if ($rowOptions instanceof \Closure) {
            $options = call_user_func_array($rowOptions, ['model' => $object, 'rowRangeString' => $rowRangeString, 'sessionStorage' => $sessionStorage]);
        }

        if (!empty($options)) {
            if (is_array($options)) {
                $activeSheet->getStyle($rowRangeString)->applyFromArray($options);
            }
        }

        echo PHP_EOL;

        $index++;
        $rowIndex++;
    }


    /**
     * @param $model Model
     * @param $columns ReportColumnData[]
     * @return mixed;
     */
    public function getHeaderLabels($model, $columns)
    {
        $headerLabels = [];
        foreach ($columns as $column) {
            $headerLabels[] = $column->getLabel($model);
        }
        return $headerLabels;
    }

    /**
     * @param $object Model | ReportTemplateInterface
     * @return string
     */
    public function getFileName($object)
    {
        $fileName = $object->getReportFileName();
        if (empty($fileName)) {
            return md5(microtime(false));
        }
        return $fileName;
    }


    /**
     * @param $events array
     * @return void
     */
    public function initEvents($events)
    {
        $this->attachBehaviors($events);
    }

    /**
     * @param $object ReportTemplateInterface
     * @param $sheetConfig  ReportSheetConfig
     * @param $activeSheet Worksheet
     * @param $startRowIndex
     * @param $endRowIndex
     * @return Worksheet
     */
    public function beforeRender($object, $activeSheet, $startRowIndex, $endRowIndex, $sessionStorage, $sheetConfig)
    {
        $event = new ReportEvent();
//        $event->object = $object;
        $event->activeSheet = $activeSheet;
        $event->model = $object;
        $event->startRowIndex = $startRowIndex;
        $event->endRowIndex = $endRowIndex;
        $event->sessionStorage = $sessionStorage;


//        $this->trigger(ReportBehavior::EVENT_BEFORE_REPORT_RENDER, $event);
        if ($sheetConfig) {
            $sheetConfig->beforeRender($event);
        } else {
            $object->beforeRender($event);
        }
        return $event->activeSheet;
    }

    /**
     * @param $object ReportTemplateInterface
     * @param $sheetConfig  ReportSheetConfig
     * @param $activeSheet Worksheet
     * @param $startRowIndex
     * @param $endRowIndex
     * @return Worksheet
     */
    public function afterRender($object, $activeSheet, $startRowIndex, $endRowIndex, $sessionStorage, $sheetConfig)
    {
        $event = new ReportEvent();
        $event->model = $object;
        $event->activeSheet = $activeSheet;
        $event->startRowIndex = $startRowIndex;
        $event->endRowIndex = $endRowIndex;
        $event->sessionStorage = $sessionStorage;

        if ($sheetConfig) {
            $sheetConfig->afterRender($event);
        } else {
            $object->afterRender($event);
        }
        return $event->activeSheet;
    }

    /**
     * @param $celString
     * @return array|int[]
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    protected function detectInitValue($celString)
    {
        $cellIndex = [1,1];

        if(!preg_match("([A-Z]*[0-9]*)", $celString)){
            return $cellIndex;
        }

        $colString = preg_replace("([0-9]*)", "", $celString);
        $colIndex = Coordinate::columnIndexFromString($colString);
        $rowIndex = intval(preg_replace("([A-Z]*)", "", $celString));

        return [$rowIndex, $colIndex];
    }

}