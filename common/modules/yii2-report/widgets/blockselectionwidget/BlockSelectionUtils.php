<?php

namespace lcssoft\report\widgets\blockselectionwidget;


use Yii;
use yii\base\Widget;

class BlockSelectionUtils
{
    public static function getJsActionOnFilterElement($data){
        $item = ['jsEvents' => ''];
        foreach ($data as $key => $element){
            if(empty($key) || $key === 0){
                throw new \yii\db\Exception('Invalid JS Event');
            }
            $item['jsEvents'] .= Yii::t('app', "$('#{element}').{event}(function(){ $('#btn-refresh').trigger('click');});",
                [
                    'element' => $element['elementId'],
                    'event' => $key,
                ]);
            $item["data-$key-".$element['elementId']] = implode('#',[$element['elementId'],$element['submitArg']]);
        }
        return $item;
    }
}