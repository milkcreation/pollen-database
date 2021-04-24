<?php

declare(strict_types=1);

namespace Pollen\Database\Drivers\Laravel\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Pollen\Support\Proxy\DbProxy;

abstract class AbstractModel extends Model
{
    use DbProxy;

    /**
     * {@inheritDoc}
     *
     * @return Builder|$this
     */
    public static function on($connection = null)
    {
        return parent::on($connection);
    }
}