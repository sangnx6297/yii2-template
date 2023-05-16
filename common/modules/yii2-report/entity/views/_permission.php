<?php
/**
 * @var $this \yii\web\View
 * @var $model \lcssoft\report\entity\ReportConfig
 * @var $rule \lcssoft\report\entity\ReportMeta
 * @var $accessType
 */
?>

<?= \lcssoft\report\widgets\blockselectionwidget\BlockSelectionWidget::widget([
    'urlAssign' => ['assign'],
    'urlRemove' => ['remove'],
    'availableData' => $model->getAvailableAccess($accessType),
    'assignedData' => $model->getAssignedAccess($accessType),
    'submitData' => [
        'id' => $model->id,
        'class' => $accessType,
    ],
])?>
