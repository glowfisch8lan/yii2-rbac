<?php

namespace app\modules\kernel\components\filters;


use Yii;
/*
use app\models\Group;
use app\models\SystemUsers;
use yii\helpers\Json;
use yii\web\ServerErrorHttpException;
*/
/**
 * Class AccessControl
 * @package app\kernel\components\filters
 *
 * Это класс, расширяющий AccessControll и дающий следующие преимущества:
 * 1. К каждому действию/контроллеру/модулю можно получить доступ, имея на то соответствующее разрешение.
 * Все разрешения хранятся в особых Группах (таблица system_groups) в формате json;
 * Если пользователь входит в нужную группу с разрешением, то может получить доступ к странице.
 *
 * ['actions' => ['sign-out', 'update', 'view'],
 * 'roles' => ['@']
 * ]
 * Настройка доступа реализуется через Фильтр в поведении Модуля/Контроллера
 *
 */
class AccessControl extends \yii\filters\AccessControl
{

    /** @var AccessControl Хранит разрешения CRUD на доступ. crudController - если есть все права, то crudController,
     * если только create, то cController, если на модификацию, то vController и т.д.
     */
    public $rules;

    public $visible = true;
    public $excludedRules;

    public function beforeAction($action)
    {
        $user = $this->user;
        return true;
//        /** Если текущий action, указанный в правилах не содержится в общем массиве action - то разрешаем доступ */
//        foreach ($this->rules as $rule) {
//            if (isset($rule->actions) && !in_array(\Yii::$app->controller->action->id, $rule->actions)) {
//                return true;
//            }
//        }

//        /** Доступ только зарегистрированным пользователям */
//        foreach ($this->rules as $rule) {
//            foreach($rule->roles as $role){
//                if (($role === 'onlyAuth' || $role === '@') && !Yii::$app->user->isGuest) {
//                    return true;
//                }
//            }
//        }
//
//        var_dump(1);
//
//        /** Доступ для всех */
//        foreach ($this->rules as $rule) {
//            foreach($rule->roles as $role) {
//                if ($role === 'all' || $role === '?') return true;
//            }
//        }
//

//
//        /** Если пользователь неГость - проверка прав доступа к модулю | категории | действию; */
//        $auth = false;
//        if (!(Yii::$app->user->isGuest)) {
//            foreach ($this->rules as $rule) {
//                foreach ($rule->roles as $role) {
//                    if (self::checkAccess($this->user->id, $role))
//                        return true;
//                }
//            }
//        }
//
//        if (!$auth)
//            $this->denyAccess($user);
//
//        /** return parent::beforeAction($action); */
//        return true;
    }

//    /**
//     * Проверка наличия разрешающего правила у Пользователя. Правила хранятся в JSON формате в БД в таблице system_groups.
//     *
//     * @param int $user_id
//     * @param string $rule
//     * @return bool
//     * @throws ServerErrorHttpException
//     */
//    public static function checkAccess(?int $user_id, string $rule): bool
//    {
//        if(is_null($user_id))
//            return false;
//
//        $arr = [];
//        foreach (SystemUsers::getUserGroups($user_id) as $group)
//            $arr[] = Json::Decode(Group::getPermissions($group['id'])['permissions']);
//
//        if (empty($arr)) {
//            Yii::$app->user->logout();
//            throw new ServerErrorHttpException('В группе отсутствуют разрешения, дальнейшая работа невозможна!');
//        }
//
//        /** access granted; */
//        foreach ($arr as $val)
//            if (in_array($rule, $val)) return true;
//
//        /**  access deny; */
//        return false;
//    }
}
