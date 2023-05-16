<?php

namespace lcssoft\report\handler;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use yii\base\BaseObject;
use yii\base\Exception;
use yii\base\Model;

class ReportColumnData extends BaseObject
{

    /** @desc model attribute in query */
    public $attribute;

    /** @desc label show in sheet */
    public $label;

    /** @desc value of column
     *   closure: function ( $model, $cell, $index, $rowIndex){
     *
     *            }
     */
    public $value;

    /**
     * @desc value format in sheet string | array | closure
     * -  closure: function ( $model, $cell, $index, $rowIndex, $rowData, $sessionStorage){
     *
     *            }
     * - array:
     *  + php format: format with php config after render <value>
     *          [
     *              'php' => '<Y-m-d| Y-m-d h:i:s>',
     *          ]
     *      or
     *  + php format: format with excel config render <value>
     *          [
     *              'xls' => '<#,##0.00_);(#,##0.00)>'
     *          ]
     */
    public $format;

    public $headerOptions = [
        'alignment' => [
            'vertical' => Alignment::VERTICAL_CENTER,
            'horizontal' => Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN
            ]
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['rgb' => '366092'],
        ],
        'font' => [
            'color' => [
                'rgb' => 'FFFFFF',
            ],
            'bold' => true,
        ]
    ];

    public $contentOptions = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN
            ]
        ],
    ];

    public $autoResize = true;

    public $width = -1;

    public $visible = true;

    public $dataType;

    public $excelNumberFormat;

    public $defaultValue;

    public $rowOptions = [];

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        if (!empty($this->attribute)) {
            if (strpos($this->attribute, ':')) {
                list($attribute, $format) = explode(":", $this->attribute);
                $this->format = $format;
                $this->attribute = $attribute;
            }
        }

    }

    /**
     * @param $cell Cell
     * @param $model object
     * @param $index
     * @param $rowIndex
     * @return Cell
     */
    public function renderAttribute(Cell $cell, $model, $index, $rowIndex, $rowData, $sessionStorage)
    {

        $cellData = null;
        $args = [
            'model' => $model,
            'cell' => $cell,
            'index' => $index,
            'rowIndex' => $rowIndex,
            'rowData' => $rowData,
            'sessionStorage' => $sessionStorage,
        ];

        if ($this->format) {
            $cell->setDataType($this->format);
        }

        if (!empty($this->value)) {
//            if ($this->value instanceof \Closure) {
            if (!empty($this->attribute)) {
                $attribute = $this->attribute;
                if (!$model->hasProperty($attribute)) {
                    throw new Exception("Attribute $attribute not existed.");
                }
                if (!empty($attribute)) {
                    $cellData = $this->getAttributeValue('value', $args);
                    if (empty($cellData)) {
                        $cellData = $model->{$attribute};
                    }
                }
            } else {
                $cellData = $this->getAttributeValue('value', $args);
            }
//            } else {
//                $cellData = $this->value;
//            }
        } else {

            $attribute = $this->attribute;

            if (!$model->hasProperty($attribute)) {
                throw new Exception("Attribute $attribute not existed.");
            }

            if (!empty($attribute)) {
                $cellData = $model->{$attribute};
            }
        }

        $cell->setValue($cellData ?? $this->defaultValue);

        return $cell;
    }

    /**
     * @param $model Model
     * @return string
     */
    public function getLabel($model = null)
    {
        if (!empty($this->label)) {
            return $this->label;
        }

        if (empty($model)) {
            return null;
        }

        if (!$model->hasProperty($this->attribute)) {
            return null;
        }
        return $model->getAttributeLabel($this->attribute);
    }


    public function getAttributeValue($attribute, $params = [])
    {
        if (!$this->hasProperty($attribute)) {
            throw new Exception("Attribute $attribute not found.");
        }

        $value = $this->{$attribute};

        if ($this->{$attribute} instanceof \Closure) {
            $value = call_user_func_array($this->{$attribute}, $params);
        }

        return $value;
    }

    public function formattedValue($value, $args)
    {
        $format = $this->format;
        $formatType = null;
        $formatPattern = null;

        if ($format instanceof \Closure) {
            $format = call_user_func_array($this->format, $args);
        }

        if (is_array($format)) {
            if (isset($format['php'])) {
                $formatType = $format['php'];
            }
            if (isset($format['pattern'])) {
                $formatPattern = $format['pattern'];
            }
        } else {
            $formatType = $format;
        }

        switch ($formatType) {
            case 'date':
                $pattern = "Y-m-d";
                if (!empty($formatPattern)) {
                    $pattern = $format['pattern'];
                }
                $time = $value;
                if (!is_integer($time)) {
                    $time = strtotime($time);
                }
                return date($pattern, $time);
            case 'datetime':
                $pattern = "Y-m-d H:i:s";
                if (!empty($formatPattern)) {
                    $pattern = $format['pattern'];
                }
                $time = $value;
                if (!is_integer($time)) {
                    $time = strtotime($time);
                }
                return date($pattern, $time);
        }

        return $value;
    }
}