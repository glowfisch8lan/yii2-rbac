<?php


namespace idapp\rbac;


use idapp\rbac\interfaces\AuthInterface;
use yii\base\BaseObject;

class AuthManager implements AuthInterface
{
    /** @var string */
    public string $userClass;

    protected string $currentClassController = '';

    /** Пытаемся авторизовать клиента с помощью списка Разрешений*/
    public function authorize(array $permissionsMap)
    {
        $this->currentClassController = get_class(\Yii::$app->controller);

        if(!class_exists($this->currentClassController)) {
            throw new \Exception("$this->currentClassController don't exists");
        }

        foreach ($permissionsMap as $permission) {
            if (!is_array($permission) ||
                !is_array($permission['route']['controllers']) ||
                !is_array($permission['route']['actions']) ||
                !is_string($permission['rule'])
            )
            {
                throw new \TypeError();
            }
        }

        return (new AccessControl([
            'permissionsMap' => $permissionsMap,
            'currentClassController' => $this->currentClassController
        ]))->authorize();

    }

    public function can()
    {
        // TODO: Implement can() method.
    }
}