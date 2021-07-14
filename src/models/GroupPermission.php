<?php

namespace idapp\rbac\models;

use Yii;

/**
 * This is the model class for table "group_permission".
 *
 * @property int $group_id
 * @property int $permission_id
 *
 * @property Group $group
 * @property Permission $permission
 */
class GroupPermission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_permission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'permission_id'], 'required'],
            [['group_id', 'permission_id'], 'integer'],
            [['group_id', 'permission_id'], 'unique', 'targetAttribute' => ['group_id', 'permission_id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
            [['permission_id'], 'exist', 'skipOnError' => true, 'targetClass' => Permission::class, 'targetAttribute' => ['permission_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'group_id' => Yii::t('common', 'Group ID'),
            'permission_id' => Yii::t('common', 'Permission ID'),
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for [[Permission]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPermission()
    {
        return $this->hasOne(Permission::class, ['id' => 'permission_id']);
    }
}
