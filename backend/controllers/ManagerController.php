<?php

namespace backend\controllers;

class ManagerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
