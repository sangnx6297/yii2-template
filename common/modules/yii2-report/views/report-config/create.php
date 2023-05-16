<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model lcssoft\report\entity\ReportConfig */

$this->title = 'Create Report Config';
$this->params['breadcrumbs'][] = ['label' => 'Report Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
