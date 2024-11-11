<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class EventRequest extends FormRequest
{
    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'events.create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:2', 'max:100'],
            'description' => ['nullable', 'max:500'],
            'start_date.date' => [
                'required',
                'date'
            ],
            'start_date.hour' => [
                'required',
            ],
            'end_date.date' => [
                'required',
                'date',
                'after_or_equal:start_date.date',
            ],
            'end_date.hour' => [
                'required',
            ],
            'color' => [
                'required',
                'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'
            ],
            'is_all_day' => [
                'required',
                Rule::in(['true', 'false'])
            ]
        ];
    }

    /**
     * Get the URL to redirect to on a validation error.
     */
    protected function getRedirectUrl(): string
    {
        return $this->event && $this->event->exists
            ? route('events.edit', $this->event)
            : parent::getRedirectUrl();
    }
}
