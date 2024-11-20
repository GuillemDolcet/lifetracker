<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Event extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'color',
        'is_all_day',
    ];

    // RELATIONS //

    /**
     * User relation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }

    /**
     * Socials relation.
     */
    public function socials(): BelongsToMany
    {
        return $this->belongsToMany(
            Social::class,
            'event_socials',
            'event_id',
            'social_id',
        )->withPivot('event_social_id');
    }

    // SCOPES

    /**
     * Scope between a range of dates
     */
    public function scopeDateRange(Builder $query, string $startDate, string $endDate): void
    {
        $query->where($this->qualifyColumn('start_date'), '>=', $startDate)
            ->orWhere($this->qualifyColumn('end_date'), '<=', $endDate);
    }

    /**
     * Scope by one or multiple users
     */
    public function scopeUser(
        Builder $query,
        User|string|int|array $user,
    ): void {
        if (is_array($user)) {
            $query->whereIn($this->qualifyColumn('user_id'), $user);
        } elseif ($user instanceof User) {
            $query->where(
                $this->qualifyColumn('user_id'),
                $user->getKey(),
            );
        } else {
            $query->where($this->qualifyColumn('user_id'), $user);
        }
    }

    // Functions

    /*
     * Returns if the events belongs to user
     */
    public function belongsToUser(User $user): bool
    {
        return $this->user->getKey() === $user->getKey();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'is_all_day' => 'boolean'
        ];
    }
}
