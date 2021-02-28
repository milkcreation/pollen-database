<?php

declare(strict_types=1);

namespace Pollen\Database;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Pollen\Database\Concerns\ColumnsAwareTrait;
use Pollen\Database\Concerns\ConnectionAwareTrait;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
abstract class Model extends BaseModel implements ModelInterface
{
    use ColumnsAwareTrait;
    use ConnectionAwareTrait;
}