<?php

namespace backend\controllers;

class AgentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
