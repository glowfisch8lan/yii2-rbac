<?php

namespace idapp\rbac\migrations;

use \yii\db\Migration;

/**
 * Handles the creation of table `{{%group}}`.
 */
class m210630_000516_create_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->comment('Имя'),
            'description' => $this->string()->null()->comment('Описание'),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%group}}');
    }
}
