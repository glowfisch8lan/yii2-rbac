<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permission".
 *
 * @property int $id
 * @property string $rule
 * @property string|null $description
 *
 * @property GroupPermission[] $groupPermissions
 * @property Group[] $groups
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rule'], 'required'],
            [['rule', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'rule' => Yii::t('common', 'Rule'),
            'description' => Yii::t('common', 'Description'),
        ];
    }

    public static function getAll()
    {
        return self::find()->all();
    }
    /**
     * Gets query for [[GroupPermissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupPermissions()
    {
        return $this->hasMany(GroupPermission::class, ['permission_id' => 'id']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])->viaTable('group_permission', ['permission_id' => 'id']);
    }

    public static function validatePermission(int $id): bool
    {
        return !is_null(self::findOne($id));
    }
}
