<?php

namespace lcssoft\report\entity;



use lcssoft\report\handler\ReportConfigViewTemplateInterface;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "report_meta".
 *
 * @property int $id
 * @property int $id_report_config
 * @property string $class
 * @property string $key
 * @property string $value
 * @property string $extra_data
 *
 * @property ReportConfig $reportConfig
 */
class ReportMeta extends \yii\db\ActiveRecord implements ReportConfigViewTemplateInterface
{

    const TYPE_ROLE = 'ROLE';
    const TYPE_PERMISSION = 'PERMISSION';
    const TYPE_USER = 'USER';
    const TYPE_CUSTOM = 'CUSTOM';
    public $object_type;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'erp_report_meta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_report_config'], 'integer'],
            [['extra_data'], 'string'],
            [['class', 'key', 'value'], 'string', 'max' => 255],
            [['id_report_config'], 'exist', 'skipOnError' => true, 'targetClass' => ReportConfig::className(), 'targetAttribute' => ['id_report_config' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_report_config' => 'Id Report Config',
            'class' => 'Class',
            'key' => 'Key',
            'value' => 'Value',
            'extra_data' => 'Extra Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportConfig()
    {
        return $this->hasOne(ReportConfig::className(), ['id' => 'id_report_config']);
    }

    public function availableAccess()
    {
        return [
            self::TYPE_ROLE => \Yii::t('backend', 'Roles'),
            self::TYPE_PERMISSION => \Yii::t('backend', 'Permissions'),
            self::TYPE_USER => \Yii::t('backend', 'User'),
            self::TYPE_CUSTOM => \Yii::t('backend', 'Custom'),
        ];
    }

    public function renderPath($accessType)
    {
        return implode("/", [str_replace("\\","/",__NAMESPACE__), 'views', "_".strtolower($accessType)]);
    }


    public function availableRole()
    {
        $roles = \Yii::$app->authManager->getRoles();
        $roles = ArrayHelper::getColumn($roles, 'name');

    }


}
