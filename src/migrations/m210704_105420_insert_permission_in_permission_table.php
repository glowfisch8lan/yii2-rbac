<?php


use yii\db\Migration;

/**
 * Class m210704_105420_insert_permission_in_permission_table
 */
class m210704_105420_insert_permission_in_permission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%permission}}', ['rule', 'description'], [
            ['system.all.permission', 'Full access to app'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210704_105420_insert_permission_in_permission_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210704_105420_insert_permission_in_permission_table cannot be reverted.\n";

        return false;
    }
    */
}
