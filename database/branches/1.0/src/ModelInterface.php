<?php

declare(strict_types=1);

namespace Pollen\Database;

use Pollen\Database\Concerns\ColumnsAwareTraitInterface;
use Pollen\Database\Concerns\ConnectionAwareTraitInterface;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
interface ModelInterface extends ColumnsAwareTraitInterface, ConnectionAwareTraitInterface
{
}