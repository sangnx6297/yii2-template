<?php
namespace common\components;

use yii\web\IdentityInterface;

class User extends \yii\web\User
{
    public function login(IdentityInterface $identity, $duration = 0)
    {
        if(parent::login($identity, $duration)){

            \Yii::$app->session->set($identity->getId() . "_sip_username", \Yii::$app->user->identity->extension);
            \Yii::$app->session->set($identity->getId() . "_sip_secret", \Yii::$app->user->identity->extension_secret);
            return true;
        }
        return false; // TODO: Change the autogenerated stub
    }
}