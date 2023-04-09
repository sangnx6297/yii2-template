<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;

//AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--    --><?php //$this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <meta name="HandheldFriendly" content="true">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#f6f6f6">
    <meta name="theme-color" media="(prefers-color-scheme: dark)"  content="#292929">


    <?php $this->head() ?>


</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<!--<main role="main">-->
<!--    <div class="container">-->
        <?= $content ?>
<!--    </div>-->
<!--</main>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
