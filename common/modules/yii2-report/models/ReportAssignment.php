<?php

namespace lcssoft\report\models;


use lcssoft\report\entity\ReportMeta;
use lcssoft\report\handler\ReportAccessInterface;

class ReportAssignment extends ReportMeta implements ReportAccessInterface
{

    public function checkAccess()
    {
        $userId = \Yii::$app->user->id;
        switch ($this->key) {
            case self::TYPE_ROLE:
                if (!\Yii::$app->user->isGuest) {
                    $id_user = $id_user ?? \Yii::$app->user->id;
                    $role_name = \Yii::$app->authManager->getRole($this->value) ? \Yii::$app->authManager->getRole($this->value)->name : '';
                    $roles = array_keys(\Yii::$app->authManager->getRolesByUser($id_user));

                    return is_array($roles) && in_array($role_name, $roles, true);
                }
                return false;
//                return UserRole::hasRole($this->value, $userId);
            case self::TYPE_PERMISSION:
                return \Yii::$app->user->can($this->value);
            case self::TYPE_USER:
                return $userId == $this->value;
        }
        return false;
    }

    public function render($accessType)
    {
        // TODO: Implement render() method.
    }

    public function availableAccess()
    {
        return parent::availableAccess();
    }
}