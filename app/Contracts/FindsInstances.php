<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface FindsInstances
{
    /**
     * Finds a model instance by key.
     */
    public function find(mixed $id, array $options = []): mixed;

    /**
     * Finds a model instance by key.
     */
    public function findMany(array $keys, array $options = []): Collection;

    /**
     * Finds a model instance by the supplied attributes.
     */
    public function findBy(array $attributes, array $options = []): mixed;

    /**
     * Get all model instances by the supplied attributes.
     */
    public function allBy(array $attributes, array $options = []): mixed;

    /**
     * Finds a model instance by key via the supplied context.
     *
     * @return mixed|null
     */
    public function findViaContext(
        Builder $ctx,
        mixed $id,
        array $options = [],
    ): mixed;

    /**
     * Finds a model instance by the supplied attributes via the supplied context.
     */
    public function findByViaContext(
        Builder $ctx,
        array $attributes,
        array $options = [],
    ): mixed;

    /**
     * Finds a model instance by key via the supplied context.
     */
    public function findManyViaContext(
        Builder $ctx,
        array $keys,
        array $options = [],
    ): Collection;
}
