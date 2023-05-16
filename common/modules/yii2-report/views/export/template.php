<?php
/* @var $config \lcssoft\report\models\ReportConfig */
/* @var $listReport array */
/* @var $type string */
/* @var $this yii\web\View */

$fieldCount = count($config->getFields());
$this->title = $config->reportObjectLabel;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="export-container">

    <div class="box box-primary">
        <!-- form start -->
        <div class="box-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?= Select2::widget([
                            'name' => 'report-type',
                            'data' => $listReport,
                            'value' => $type,
                            'pluginEvents' => [
                                "change" => "function (){
                            window.location.href='/export/template/'+ $(this).val();
                        }"
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">

            <?php $form = $config->renderForm() ?>

            <?php if (!empty($config->reportTemplateView)): ?>
                <?= $config->renderTemplateView($this) ?>

            <?php else: ?>
                <?= $this->render('_dynamic-template', ['config' => $config]) ?>
            <?php endif; ?>

            <?= $config->renderEndForm() ?>
        </div>

    </div>

</div>
