<?php


namespace idapp\rbac\models\enums;

/**
 * Class Permission
 * @package idapp\rbac\models\enum
 */
class Permission
{
    /**
     * Разрешение на загрузку файлов;
     */
    const SYSTEM_UPLOAD_FILE = 'system.upload.file';
    /**
     * Полный доступ к системе;
     */
    const SYSTEM_ALL_PERMISSION = 'system.all.permission';

    /**
     * Доступ к модулю
     */
    const MODULE_ACCESS = 'module.access';

    const GRANT = true;

    const DENY = false;
}