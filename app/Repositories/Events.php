<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class Events extends Repository
{
    /**
     * The actual model class supporting the business logic.
     */
    public function getModelClass(): string
    {
        return Event::class;
    }

    /**
     * *All* events query context.
     */
    public function allContext(array $options = []): Builder
    {
        return $this->applyBuilderOptions($this->newQuery(), $options);
    }

    /**
     * Get *all* events from the database.
     *
     * @return Collection<int,Event>
     */
    public function all(array $options = []): Collection
    {
        return $this->allContext($options)->get();
    }

    /**
     * Instantiates a new Event object.
     */
    public function build(array $attributes = []): Event
    {
        return $this->make($attributes);
    }

    /**
     * Creates a Event instance.
     */
    public function create(array $attributes = []): ?Event
    {
        return $this->update($this->build(), $attributes);
    }

    /**
     * Listing result set.
     */
    public function listing(
        Builder $context,
        array $options = [],
    ): LengthAwarePaginator {
        $options = array_merge(['per_page' => 50], $options);

        return $context->paginate($options['per_page']);
    }

    /**
     * Updates a event instance.
     */
    public function update(Event $instance, array $attributes = []): ?Event
    {
        return DB::transaction(static function () use (
            $instance,
            $attributes
        ): ?Event {
            if (isset($attributes['start_date']) && is_array($attributes['start_date'])) {
                $attributes['start_date'] = $attributes['start_date']['date'] . $attributes['start_date']['hour'];
            }

            if (isset($attributes['end_date']) && is_array($attributes['end_date'])) {
                $attributes['end_date'] = $attributes['end_date']['date'] . $attributes['end_date']['hour'];
            }

            $instance->fill($attributes);

            if (isset($attributes['user'])) {
                $instance->user()->associate($attributes['user']);
            } else{
                $instance->user()->associate(current_user());
            }

            $result = $instance->save();

            if ( ! $result) {
                return null;
            }

            return $instance;
        });
    }
}
