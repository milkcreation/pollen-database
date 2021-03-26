<?php

declare(strict_types=1);

namespace Pollen\Database;

use Pollen\Container\BaseServiceProvider;

class DatabaseServiceProvider extends BaseServiceProvider
{
    /**
     * @var string[]
     */
    protected $provides = [
        DatabaseManagerInterface::class,
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(DatabaseManagerInterface::class, function () {
           return new DatabaseManager();
        });
    }
}