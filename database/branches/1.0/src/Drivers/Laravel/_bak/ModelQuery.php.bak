<?php

declare(strict_types=1);

namespace Pollen\Database\Drivers\Laravel;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Pollen\Support\ParamsBag;
use Pollen\Support\Str;

class ModelQuery extends ParamsBag implements ModelQueryInterface
{
    /**
     * Liste des classes de rappel d'instanciation selon un critère.
     * @var string[][]|array
     */
    protected static $builtInClasses = [];

    /**
     * Classe du modèle associé.
     * @var string
     */
    protected static $builtInModelClass = '';

    /**
     * Classe de rappel d'instanciation.
     * @var string
     */
    protected static $fallbackClass = '';

    /**
     * Instance du modèle Eloquent associé.
     * @var ModelInterface|null
     */
    protected $model;

    /**
     * @param ModelInterface|null $model
     */
    public function __construct(?ModelInterface $model = null)
    {
        if ($this->model = $model instanceof ModelInterface ? $model : null) {
            $this->set($model->getAttributes());
            $this->parse();
        }
    }

    /**
     * @inheritDoc
     */
    public static function build(object $model): ?ModelQueryInterface
    {
        if (!$model instanceof ModelInterface) {
            return null;
        }

        $class = self::$fallbackClass ?: static::class;

        return class_exists($class) ? new $class($model) : new static($model);
    }

    /**
     * @inheritDoc
     */
    public static function builtInModel(): ?ModelInterface
    {
        if (!$modelClass = static::$builtInModelClass) {
            return null;
        }
        if (!($model = new $modelClass()) instanceof ModelInterface) {
            return null;
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public static function create($id = null, ...$args): ?ModelQueryInterface
    {
        if (is_numeric($id)) {
            return static::createFromId((int)$id);
        }

        if ($id instanceof ModelInterface) {
            return static::build($id);
        }

        if ($id instanceof ModelQueryInterface) {
            return static::createFromId($id->getId());
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public static function createFromId(int $id): ?ModelQueryInterface
    {
        return ($model = static::builtInModel()) && ($instance = $model->find($id)) ? static::build($instance) : null;
    }

    /**
     * @inheritDoc
     */
    public static function fetch($query = null): array
    {
        if (is_array($query)) {
            return static::fetchFromArgs($query);
        }

        if ($query instanceof Collection) {
            return static::fetchFromEloquent($query);
        }

        return [];
    }

    /**
     * @inheritDoc
     */
    public static function fetchFromArgs(array $args = []): array
    {
        return ($query = static::parseQueryArgs($args)) ? static::fetchFromEloquent($query->get()) : [];
    }

    /**
     * @inheritDoc
     */
    public static function fetchFromEloquent(Collection $collection): array
    {
        $instances = [];
        foreach ($collection as $model) {
            $instances[] = static::build($model);
        }

        return $instances;
    }

    /**
     * @inheritDoc
     */
    public static function keyName(): ?string
    {
        return ($model = static::builtInModel()) && ($key = $model->getKeyName()) ? $key : null;
    }

    /**
     * @inheritDoc
     */
    public static function parseQueryArgs(array $args = []): ?Builder
    {
        if (!$model = static::builtInModel()) {
            return null;
        }

        $columns = $model->getColumns();
        $query = $model->newQuery();

        foreach ($columns as $c) {
            if (isset($args[$c])) {
                $v = $args[$c];

                $method = 'parseQueryArg' . Str::studly($c);

                if (method_exists(__CLASS__, $method)) {
                    $query = static::{$method}($v, $query);
                } else {
                    if (is_array($v)) {
                        if (isset($v['value'], $v['compare'])) {
                            $query->where($c, $v['compare'], $v['value']);
                        } else {
                            $query->whereIn($c, $v);
                        }
                    } else {
                        $query->where($c, $v);
                    }
                }
            }
        }

        $query = static::parseQueryArgOrderBy($order = $args['order_by'] ?? null, $query);

        $query = isset($args['per_page']) && is_numeric($args['per_page'])
            ? static::parseQueryArgPerPage((int)$args['per_page'], $query) : $query;


        return $query;
    }

    /**
     * @inheritDoc
     */
    public static function parseQueryArgOrderBy($order, Builder $query): Builder
    {
        if (is_string($order)) {
            $query->orderBy($order);
        } elseif (is_array($order)) {
            foreach ($order as $col => $dir) {
                if (is_numeric($col)) {
                    $col = $dir;
                    $dir = 'asc';
                }
                $query->orderBy($col, $dir);
            }
        }

        return $query;
    }

    /**
     * @inheritDoc
     */
    public static function parseQueryArgPerPage(int $limit, Builder $query): Builder
    {
        if (($limit > 0)) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * @inheritDoc
     */
    public static function setBuiltInModelClass(string $classname): void
    {
        static::$builtInModelClass = $classname;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->get(static::keyName());
    }
}