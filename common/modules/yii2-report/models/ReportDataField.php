<?php
namespace lcssoft\report\report\models;

use kartik\helpers\Html;
use kartik\widgets\DatePicker;
use yii\base\InvalidValueException;
use yii\base\Model;

class ReportDataField extends \yii\base\Model
{
    /**
     * @var \kartik\form\ActiveForm
     */
    public $form;

    /**
     * @var Model
     */
    public $model;

    public $containerCol = 'md';
    public $containerSize = 3;

    public $label;
    public $attribute;
    public $fieldOptions = [];
    public $fieldWidget = [];
    public $hidden = false;
    public $renderWidget = false;
    public $defaultValue;

    /**
     * @return \kartik\form\ActiveField
     * @throws \Exception
     */
    public function renderField()
    {

        if (empty($this->attribute)) {
            throw new InvalidValueException("\$attribute must be declared!");
        }

        if (empty($this->form)) {
            throw new InvalidValueException("\$form must be declared!");
        }

        if (empty($this->model)) {
            throw new InvalidValueException("\$model must be declared!");
        }

        if (!$this->model->hasProperty($this->attribute)) {
            throw new \Exception("$this->attribute is missing in " . get_class($this->model));
        }

        if ($this->defaultValue) {

            $this->model->setAttributes([
                $this->attribute => $this->defaultValue
            ]);

        }

        if ($this->renderWidget) {
            if (!empty($this->fieldWidget)) {
                if (isset($this->fieldWidget['widgetClass'])) {

                    $config = isset($this->fieldWidget['config']) ? $this->fieldWidget['config'] : [];

                    if ($config instanceof \Closure) {
                        $config = call_user_func_array($config, ['model' => $this->model]);
                    }

                    if (!is_array($config)) {
                        throw new \Exception("Widget config must be an array!");
                    }

                    $config['form'] = $this->form;
                    $config['model'] = $this->model;
                    $config['attribute'] = $this->attribute;
                    $config['name'] = Html::getInputName($this->model, $this->attribute);
                    $field = ($this->fieldWidget['widgetClass'])::widget($config);
                }
            }
        } else {
            $field = $this->form->field($this->model, $this->attribute, $this->fieldOptions);
            if (!empty($this->fieldWidget)) {
                if (isset($this->fieldWidget['widgetClass'])) {
                    $config = isset($this->fieldWidget['config']) ? $this->fieldWidget['config'] : [];

                    if ($config instanceof \Closure) {
                        $config = call_user_func_array($config, ['model' => $this->model]);
                    }

                    if (!is_array($config)) {
                        throw new \Exception("Widget config must be an array!");
                    }

                    $field->widget($this->fieldWidget['widgetClass'], $config);
                }
            }

            if ($this->hidden) {
                $field->hiddenInput();
            }

            $field->label($this->label);
        }
        return $field;
    }


}