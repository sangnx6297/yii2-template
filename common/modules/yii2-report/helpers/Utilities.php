<?php


namespace lcssoft\report\helpers;



use kartik\widgets\DatePicker;
use Yii;

class Utilities
{
    /**
     * @param $string string
     * @param $index int | array
     * @param $needle string
     * @return string
     * @example
     *  - insertStringIntoStringIndex("ABCDE",2,"+")
     *  => result: "A+BCDE"
     *  - insertStringIntoStringIndex("ABCDE",[2,4],"+")
     *  => result: "A+BC+DE"
     */
    public static function insertStringIntoStringIndex($string,$index,$needle){

        $result = $string;
        $diff = 0;
        if(!is_array($index)){
            $index = [$index];
        }
        foreach ($index as $arrIndex){
            $point = ($arrIndex-1+$diff);
            if($point>strlen($result)){
                continue;
            }
            $tempString= substr($result,0,$point)."$needle";
            $tempString.= substr($result,$point,strlen($string));
            $result = $tempString;
            $diff++;
        }
        return $result;
    }

    public static function getProviderTotal($provider, $fieldName,$condition = ['k' => '','v'=>''])
    {
        $total = 0;

        foreach ($provider as $item) {
            $total += $item[$fieldName];
        }

        return $total;
    }



    public static function createDirectory($directories = [])
    {
        try {
            if (empty($directories)) {
                return false;
            }
            $dirPath = "";
            foreach ($directories as $dir) {
                $dirPath .= DIRECTORY_SEPARATOR . $dir;
                if (!is_dir($dirPath)) {
                    mkdir($dirPath, 0777, true);
                }
            }
            return $dirPath;
        } catch (\Exception $e) {
           throw $e;
        }

        return false;
    }


    public static function dateRangePickerWidgetConfig($name2, $attribute2, $value2)
    {
        return [
            'type' => DatePicker::TYPE_RANGE,
            'name2' => $name2,
            'attribute2' => $attribute2,
            'value2' => $value2,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ],
            'pluginEvents' => [
                'changeDate' => 'function(e) {
                                    var from_date = $("#accountantreport-from_date").val();
                                    var to_date = $("#accountantreport-to_date").val();
                                    if(from_date != "" || to_date != ""){
                                    if(to_date < from_date){
                                        $("#accountantreport-to_date").val(from_date);
                                    }
                                        var from_date_plus = new Date(from_date);
                                        from_date_plus.setDate(from_date_plus.getDate() + 30);
                                        $("#accountantreport-to_date").kvDatepicker("setEndDate", from_date_plus);
                                    }
                                }',
            ],
            'separator' => \Yii::t('backend', 'To'),
        ];
    }

    public static function convertTimeStr($str_time, $type = 's')
    {
        $hours = intval(preg_replace("/^([\d]{1,2})\:([\d]{2})\:([\d]{2})$/", "$1", $str_time));
        $minutes = intval(preg_replace("/^([\d]{1,2})\:([\d]{2})\:([\d]{2})$/", "$2", $str_time));
        $seconds = intval(preg_replace("/^([\d]{1,2})\:([\d]{2})\:([\d]{2})$/", "$3", $str_time));
        switch ($type) {
            case 'm':
                return ($hours * 60) + $minutes;
            case 'h':
                return $hours;
            default:
            case 's':
                return ($hours * 3600) + ($minutes * 60) + $seconds;
        }
    }

    public static function camelizeString($string){
        $pattern = "([A-Z]{1})([a-zA-Z]*)";
        $fistChar = strtoupper(preg_replace("#$pattern#","$1", $string));
        $endChars = strtolower(preg_replace("#$pattern#","$2", $string));
        return "{$fistChar}{$endChars}";
    }


    /**
     * @param $role
     * @param null $id_user
     * @return bool
     */
    public static function hasRole($role, $id_user = null): bool
    {
        if (!Yii::$app->user->isGuest) {
            $id_user = $id_user ?? Yii::$app->user->id;
            $role_name = Yii::$app->authManager->getRole($role) ? Yii::$app->authManager->getRole($role)->name : '';
            $roles = array_keys(\Yii::$app->authManager->getRolesByUser($id_user));

            return is_array($roles) && in_array($role_name, $roles, true);
        }

        return false;
    }

}