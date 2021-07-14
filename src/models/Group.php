<?php

namespace idapp\rbac\models;

use app\models\User;
use app\models\UserGroup;
use idapp\rbac\models\enums\Permission;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $name Имя
 * @property string|null $description Описание
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property GroupPermission[] $groupPermissions
 * @property Permission[] $permissions
 * @property UserGroup[] $userGroups
 * @property User[] $users
 */
class Group extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', 'Имя'),
            'description' => Yii::t('common', 'Описание'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'created_by' => Yii::t('common', 'Created By'),
            'updated_by' => Yii::t('common', 'Updated By'),
        ];
    }


    public function setPermissions()
    {

    }

    /**
     * Gets query for [[GroupPermissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupPermissions()
    {
        return $this->hasMany(GroupPermission::class, ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Permissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(Permission::class, ['id' => 'permission_id'])->viaTable('group_permission', ['group_id' => 'id']);
    }

    /**
     * Gets query for [[UserGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups()
    {
        return $this->hasMany(UserGroup::class, ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('user_group', ['group_id' => 'id']);
    }

    public static function getAll()
    {
        return self::find()->all();
    }
}
