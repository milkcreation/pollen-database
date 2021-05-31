<?php

declare(strict_types=1);

namespace Pollen\Database\Eloquent\Concerns;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @see \Pollen\Database\Eloquent\Concerns\ColumnsAwareTraitInterface
 */
trait ColumnsAwareTrait
{
    /**
     * Liste des colonnes de la table.
     * @var array
     */
    protected $columns;

    /**
     * Récupération de la liste des colonnes de la table.
     *
     * @return array
     */
    public function getColumns(): array
    {
        if (is_null($this->columns)) {
            $this->columns = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable())
                ?: [];
        }

        return $this->columns;
    }

    /**
     * Vérification d'une colonne dans la table.
     *
     * @param string $name Nom de qualification de la colonne.
     *
     * @return bool
     */
    public function hasColumn(string $name): bool
    {
        return in_array($name, $this->getColumns(), true);
    }
}