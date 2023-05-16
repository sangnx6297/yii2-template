<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model lcssoft\report\entity\ReportConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'object_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
