<?php

namespace idapp\rbac\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group_permission}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%group}}`
 * - `{{%permission}}`
 */
class m210630_002019_create_junction_table_for_group_and_permission_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group_permission}}', [
            'group_id' => $this->integer(),
            'permission_id' => $this->integer(),
            'PRIMARY KEY(group_id, permission_id)',
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            '{{%idx-group_permission-group_id}}',
            '{{%group_permission}}',
            'group_id'
        );

        // add foreign key for table `{{%group}}`
        $this->addForeignKey(
            '{{%fk-group_permission-group_id}}',
            '{{%group_permission}}',
            'group_id',
            '{{%group}}',
            'id',
            'CASCADE'
        );

        // creates index for column `permission_id`
        $this->createIndex(
            '{{%idx-group_permission-permission_id}}',
            '{{%group_permission}}',
            'permission_id'
        );

        // add foreign key for table `{{%permission}}`
        $this->addForeignKey(
            '{{%fk-group_permission-permission_id}}',
            '{{%group_permission}}',
            'permission_id',
            '{{%permission}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%group}}`
        $this->dropForeignKey(
            '{{%fk-group_permission-group_id}}',
            '{{%group_permission}}'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            '{{%idx-group_permission-group_id}}',
            '{{%group_permission}}'
        );

        // drops foreign key for table `{{%permission}}`
        $this->dropForeignKey(
            '{{%fk-group_permission-permission_id}}',
            '{{%group_permission}}'
        );

        // drops index for column `permission_id`
        $this->dropIndex(
            '{{%idx-group_permission-permission_id}}',
            '{{%group_permission}}'
        );

        $this->dropTable('{{%group_permission}}');
    }
}
