<?php

declare(strict_types=1);

namespace Pollen\Database\Eloquent\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Model
 * @mixin Builder
 */
interface ConnectionAwareTraitInterface
{
    /**
     * Récupération du préfixe des tables.
     *
     * @return string
     */
    public function getTablePrefix(): string;
}