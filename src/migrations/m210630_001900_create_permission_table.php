<?php

namespace idapp\rbac\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%permission}}`.
 */
class m210630_001900_create_permission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%permission}}', [
            'id' => $this->primaryKey(),
            'rule' => $this->string()->notNull(),
            'description' => $this->string()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%permission}}');
    }
}
