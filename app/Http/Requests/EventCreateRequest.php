<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class EventCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'start' => ['nullable', 'date'],
            'end' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ]
        ];
    }
}
