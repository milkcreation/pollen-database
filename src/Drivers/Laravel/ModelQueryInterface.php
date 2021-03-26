<?php

declare(strict_types=1);

namespace Pollen\Database\Drivers\Laravel;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Pollen\Support\ParamsBagInterface;

interface ModelQueryInterface extends ParamsBagInterface
{
    /**
     * Création d'une instance basée sur un modèle et selon la cartographie des classes de rappel.
     *
     * @param ModelInterface|object $model
     *
     * @return static
     */
    public static function build(object $model): ?ModelQueryInterface;

    /**
     * Instance de la classe du modèle associé.
     *
     * @return ModelInterface|null
     */
    public static function builtInModel(): ?ModelInterface;

    /**
     * Création d'une instance basée sur un argument de qualification.
     *
     * @param int|string|Model|ModelQuery|null $id
     * @param array ...$args Liste des arguments de qualification complémentaires.
     *
     * @return static|null
     */
    public static function create($id = null, ...$args): ?ModelQueryInterface;

    /**
     * Récupération d'une instance basée sur l'indice de clé primaire.
     *
     * @param int $id Indice de clé primaire.
     *
     * @return static|null
     */
    public static function createFromId(int $id): ?ModelQueryInterface;

    /**
     * Récupération d'une liste d'instances selon une requête en base|selon une liste d'arguments.
     *
     * @param Collection|array|null $query
     *
     * @return ModelQueryInterface[]|array
     */
    public static function fetch($query = null): array;

    /**
     * Récupération d'une liste d'instance depuis une liste d'arguments.
     *
     * @param array $args
     *
     * @return static[]|array
     */
    public static function fetchFromArgs(array $args = []): array;

    /**
     * Récupération d'une liste d'instance basée sur un résultat de requête Eloquent.
     *
     * @param Collection $collection
     *
     * @return static[]|array
     */
    public static function fetchFromEloquent(Collection $collection): array;

    /**
     * Récupération du nom de qualification de la clé primaire.
     *
     * @return string|null
     */
    public static function keyName(): ?string;

    /**
     * Traitement d'une requête de récupération d'éléments selon une liste d'arguments.
     *
     * @param array $args
     *
     * @return Builder|null
     */
    public static function parseQueryArgs(array $args = []): ?Builder;

    /**
     * Traitement de l'ordonnancement d'une requête de récupération d'éléments.
     *
     * @param string|array|null $order
     * @param Builder $query
     *
     * @return Builder
     */
    public static function parseQueryArgOrderBy($order, Builder $query): Builder;

    /**
     * Traitement de la limitation d'une requête de récupération d'éléments.
     *
     * @param int $limit
     * @param Builder $query
     *
     * @return Builder
     */
    public static function parseQueryArgPerPage(int $limit, Builder $query): Builder;

    /**
     * Définition de la classe du modèle associé.
     *
     * @param string $classname
     *
     * @return void
     */
    public static function setBuiltInModelClass(string $classname): void;

    /**
     * Récupération de l'indice de la clé primaire.
     *
     * @return string|int|null
     */
    public function getId();
}