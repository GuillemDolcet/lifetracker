<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class Users extends Repository
{
    /**
     * The actual model class supporting the business logic.
     */
    public function getModelClass(): string
    {
        return User::class;
    }

    /**
     * *All* users query context.
     */
    public function allContext(array $options = []): Builder
    {
        return $this->applyBuilderOptions($this->newQuery(), $options);
    }

    /**
     * Get *all* users from the database.
     *
     * @return Collection<int,User>
     */
    public function all(array $options = []): Collection
    {
        return $this->allContext($options)->get();
    }

    /**
     * Instantiates a new User object.
     */
    public function build(array $attributes = []): User
    {
        return $this->make($attributes);
    }

    /**
     * Creates a User instance.
     */
    public function create(array $attributes = []): ?User
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
     * Updates a user instance.
     */
    public function update(User $instance, array $attributes = []): ?User
    {
        return DB::transaction(static function () use (
            $instance,
            $attributes
        ): ?\App\Models\User {
            $instance->fill($attributes);

            isset($attributes['password']) && '' !== $attributes['password']
                ? ($instance->password = $attributes['password'])
                : $instance->offsetUnset('password');

            if (null === $instance->getRememberToken()) {
                $instance->setRememberToken(Str::random(60));
            }

            $result = $instance->save();

            if ( ! $result) {
                return null;
            }

            return $instance;
        });
    }

    /**
     * Finds a user by its email attribute.
     */
    public function findByEmail(string $email, array $options = []): ?User
    {
        return $this->findBy(['email' => $email], $options);
    }
}
