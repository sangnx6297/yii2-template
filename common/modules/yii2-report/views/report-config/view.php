<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model lcssoft\report\entity\ReportConfig */

$this->title = $model->getReportInstance()->getReportLabel();
$this->params['breadcrumbs'][] = ['label' => 'Report Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendor-view">
    <div class="box box-primary">
        <div class="form-control-section">
        </div>
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-book"></i> <?= Yii::t('catalog', 'Details') ?></h3>
        </div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'object_type',
                        'value' => function (\common\components\report\entity\ReportConfig $model) {
                            $label = $model->getReportInstance()->getReportLabel();
                            return $label;
                        },
                    ],
                    'ruleLabel',
                    'description',
                ],
            ]) ?>
        </div>
        <!--        --><?php //if(!$popup)  {?>
        <?php $rule = $model->getRuleInstance(); ?>

        <?php if (!($rule instanceof \common\components\report\handler\ReportConfigViewTemplateInterface)): ?>
            <?= Html::tag("p", Yii::t('backend', "No accessibility supported !!"),['style' => "color: red; font-weight: bold"]) ?>
        <?php else: ?>
            <div class="boxes">
                <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs">
                        <?php $availableAccess = $rule->availableAccess(); ?>
                        <?php foreach ($availableAccess as $type => $accessLabel): ?>
                            <li class="<?= array_key_first($availableAccess) == $type ? "active" : "" ?>">
                                <a href="#<?= $type ?>_tab" data-toggle="tab">
                                    <i class="fa fa-info-circle"
                                       aria-hidden="true"></i> <?= Yii::t('backend', $accessLabel) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach ($availableAccess as $type => $accessLabel): ?>
                            <div class="tab-pane <?= array_key_first($availableAccess) == $type ? "active" : "" ?>"
                                 id="<?= $type ?>_tab">
                                <div class="box-header">

                                </div>
                                <div class="box-body">
                                    <?php ?>
                                    <?= $this->render("@" . $rule->renderPath($type), [
                                        'model' => $model,
                                        'rule' => $rule,
                                        'accessType' => $type,
                                    ]) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>




