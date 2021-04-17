<?php

declare(strict_types=1);

namespace Pollen\Database;

use Illuminate\Database\Capsule\Manager as BaseDatabaseManager;
use Pollen\Support\Exception\ManagerRuntimeException;

class DatabaseManager extends BaseDatabaseManager implements DatabaseManagerInterface
{
    /**
     * Récupération de l'instance principale.
     *
     * @return DatabaseManagerInterface|object
     */
    public static function getInstance(): DatabaseManagerInterface
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }
        throw new ManagerRuntimeException(sprintf('Unavailable [%s] instance', __CLASS__));
    }
}