<?php

use yii\db\Migration;

/**
 * Class m230409_161036_add_colunm_cis_secret_to_user
 */
class m230409_161036_add_colunm_cis_secret_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\User::tableName(), 'extension', $this->string());
        $this->addColumn(\common\models\User::tableName(), 'extension_secret', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230409_161036_add_colunm_cis_secret_to_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230409_161036_add_colunm_cis_secret_to_user cannot be reverted.\n";

        return false;
    }
    */
}
