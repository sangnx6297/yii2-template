<?php

namespace lcssoft\report\widgets\blockselectionwidget;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;

/** @var $this \yii\web\View*/
$context = $this->context;

$opts = Json::htmlEncode([
    'items' => [
        'available' => $context->availableData,
        'assigned' => $context->assignedData,
    ],
]);

$filterElementAffected = BlockSelectionUtils::getJsActionOnFilterElement($context->filterElementAffected);
$this->registerJs("
".$filterElementAffected['jsEvents']."
");

unset($filterElementAffected['jsEvents']);
$uuid = uniqid();
$jsVariable = "block_selection_$uuid";
//$this->registerJs("var _opts = {$opts};");

$this->registerJs($this->render('_script.js'),  \yii\web\View::POS_READY);


//$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
$animateIcon = ' <i class="fa fa-sync fa-spin animate-'.$uuid.'"></i>';


$assignBtnOptions = [
    'class' => "btn btn-success btn-assign-$uuid",
    'data-target' => "available-$uuid",
    'title' => \Yii::t('app', 'Assign'),
];

$removeBtnOptions = [
    'class' => "btn btn-danger btn-assign-$uuid",
    'data-target' => "assigned-$uuid",
    'title' => \Yii::t('app', 'Remove'),
];

$jsDataSearch = [];

foreach ($context->submitData as $key => $value){
    $assignBtnOptions["data-$key"] = $value;
    $removeBtnOptions["data-$key"] = $value;
    $jsDataSearch[$key] = $value;
}
$searchData = Json::htmlEncode($jsDataSearch);

//$this->registerJs("var _searchData = $searchData;");
//$this->registerJs("");
$js = <<< JS
$(document).ready(function() {
   var $jsVariable = new BlockSelection('$uuid',$opts,$searchData);

    $jsVariable.init();
});

JS;
$this->registerJs($js);

?>

<div class="row">
    <div class="col-sm-5">
        <div class="input-group">
            <input class="form-control search<?="-$uuid"?>" data-target="available"
                   placeholder="<?= Yii::t('app', 'Search for available'); ?>">
            <span class="input-group-btn">
                <?= Html::a("<i class='fas fa-sync-alt'></i>", $context->urlRefresh??['refresh'], [
                    'class' => 'btn btn-default',
                    'data' => $filterElementAffected,
                    'id' => "btn-refresh-$uuid",
                ]); ?>
            </span>
        </div>
        <select multiple size="20" class="form-control list<?="-$uuid"?>" data-target="available<?="-$uuid"?>"></select>
    </div>
    <div class="col-sm-2 text-center">
        <br><br>
        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . $animateIcon, $context->urlAssign??\Yii::$app->controller->action->id, $assignBtnOptions); ?><br><br>
        <?= Html::a('<i class="fa fa-angle-double-left"></i>' . $animateIcon, $context->urlRemove??\Yii::$app->controller->action->id, $removeBtnOptions); ?>
    </div>
    <div class="col-sm-5">
        <input class="form-control search<?="-$uuid"?>" data-target="assigned"
               placeholder="<?= Yii::t('app', 'Search for assigned'); ?>">
        <select multiple size="20" class="form-control list<?="-$uuid"?>" data-target="assigned<?="-$uuid"?>"></select>
    </div>
</div>
