<?php

declare(strict_types=1);

namespace Pollen\Database;

use Illuminate\Database\Capsule\Manager as LaraDatabase;

class Database extends LaraDatabase implements DatabaseInterface
{
}