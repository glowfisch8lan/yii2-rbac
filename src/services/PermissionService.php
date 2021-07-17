<?php


namespace idapp\rbac\services;


use idapp\rbac\models\Group;
use idapp\rbac\models\GroupPermission;
use idapp\rbac\models\User;
use yii\base\BaseObject;
use idapp\rbac\models\enums\Permission as PermissionEnum;

class PermissionService
{

    public function createRelatedPermissions(Group $group, array $permissions)
    {
        foreach ($permissions as $permissionId) {
            $relatedModel = new GroupPermission();
            $relatedModel->group_id = $group->id;
            $relatedModel->permission_id = $permissionId;
            $relatedModel->save();
        }

        return true;
    }

    /**
     * Поиск переданного разрешения в группах пользователя. Если * ли @ - то проверяем как Зарегистрированные и Гости.
     * @param string $permission
     */
    public function checkAccess(string $permission)
    {
        /** Если правило "Разрешить всем" и перед нами гость */
        if ($permission === '*') {
            return PermissionEnum::GRANT;
        } else if ($permission === '@' && !User::isGuest()) {
            /** Если правило "Только авторизованным" и перед нами не гость */
            return PermissionEnum::GRANT;
        } else if (!is_null($user = User::getCurrentUser())) {
            /** Если правило задано и перед нами не гость, то проверяем наличие правила в группах */
            foreach ($user->groups as $group) {
                foreach ($group->permissions as $permissionItem) {
                    if ($permissionItem->rule === $permission) {
                        return PermissionEnum::GRANT;
                    }
                }
            }
        }

        return PermissionEnum::DENY;
    }
}