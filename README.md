<p>В связи с тем, что пакеты проприетарные и не выложены на packagist.org для установки требуется добавить 
в локальный файл composer.json репозитории проектов:</p>

````
"repositories": [
...
{
    "type":"vcs",
    "url":"git@github.com:glowfisch8lan/yii2-rbac.git"
},
````
ВНИМАНИЕ! Репозитории приватные!
````
        'authManager' => [
            'class' => idapp\rbac\AuthManager::class,
            'userClass' => 'idapp\rbac\models\User',
        ],
````

yii migrate --migrationPath=@vendor/idapp/yii2-rbac/src/migrations
Требование:
Наличие таблицы user (по-умолчанию как в шаблоне advanced)
Тесты:

cd vendor/idapp/yii2-rbac
codecept run

Для работы 
1. Определить геттер getPermissionMap
2. Вызвать сервис перед каждым action

````
    public AuthorizationService $authorizationService;
    
    public function init()
    {
        parent::init();
        ...
        $this->authorizationService = \Yii::createObject(AuthorizationService::class);
    }
  /**
     * {@inheritDoc}
     */
    public function getPermissionsMap(): array
    {
        return [
            /**
             * Правило применяется ко всем контроллерам и ко всем действиям
             *
             * Если у контроллера указан allow - то будет преобладать он.
             *

             */
            [
                'rule' => Permission::SYSTEM_UPLOAD_FILE,
                'route' => [
                    'controllers' => [
                        [
                            'controller' => 'app\controllers\DriverController',
                            'allow' => true
                        ],
                    ],
                    'actions' => ['upload'],
                    'allow' => true //не учитывается, если заданы контроллеры
                ]
            ],
        ];
    }
...
    public function beforeAction($action)
    {
        $this->authorizationService->authorize($this->permissionsMap);
        return parent::beforeAction($action);
    }
````