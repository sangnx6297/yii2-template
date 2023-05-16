<?php

use yii\db\Migration;

/**
 * Class m230516_034347_init_report_config
 */
class m230516_034347_init_report_config extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("{{%report_config}}",[
            'id' => $this->primaryKey(11),
            'object_class' => $this->string(255),
            'object_type' => $this->string(255),
            'type' => $this->string(255),
            'description' => $this->string(255),
        ]);

        $this->createTable("{{%report_meta}}",[
            'id' => $this->primaryKey(11),
            'id_report_config' => $this->integer(11),
            'class' => $this->string(255),
            'key' => $this->string(255),
            'value' => $this->string(255),
            'extra_data' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230516_034347_init_report_config cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230516_034347_init_report_config cannot be reverted.\n";

        return false;
    }
    */
}
