<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class EventDateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'start_date' => ['required', 'date'],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ]
        ];
    }

    public function validationData(): array
    {
        return $this->json()->all();
    }
}
