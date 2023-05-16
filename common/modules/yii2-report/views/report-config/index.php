<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel lcssoft\report\models\search\ReportConfigSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report Configs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-config-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title custom-title" data-toggle="collapse" data-target="#search-box" aria-expanded="true">
                <span class="collapse-icon"><i class="fa"></i></span>
                <?= Yii::t('catalog', 'Search') ?> <small
                        class="muted"><?= Yii::t('catalog', '(Click to expand/collapse)') ?></small>
            </h3>
        </div>
        <div class="box-body">

            <?= \common\widgets\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'object_type',
                        'value' => function (\common\components\report\entity\ReportConfig $model) {
                            $label = $model->getReportInstance()->getReportLabel();
                            return $label;
                        },
                    ],
                    'ruleLabel',
                    'description',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => \lcssoft\authmanager\components\Helper::filterActionColumn(['view'])
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
