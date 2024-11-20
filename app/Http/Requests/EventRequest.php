<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use App\Policies\EventPolicy;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

final class EventRequest extends FormRequest
{
    /**
     * User class
     */
    protected User $currentUser;

    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'events.create';

    /**
     * Create a new form request instance.
     */
    public function __construct(
        protected EventPolicy $eventPolicy
    )
    {
        parent::__construct();
        $this->currentUser = current_user();
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authorize =
            $this->event && $this->event->exists
                ? $this->eventPolicy->update(
                    $this->currentUser,
                    $this->event,
                )
                : $this->eventPolicy->store($this->currentUser);

        if ( ! $authorize->allowed()) {
            throw new HttpResponseException(
                response()->setStatusCode(Response::HTTP_FORBIDDEN)
            );
        }

        return true;
    }

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
            'is_all_day' => [
                'required',
                Rule::in(['true', 'false'])
            ],
            'start_date' => [
                'required',
                'date'
            ],
            'end_date' => [
                'required_if:is_all_day,==,false',
                'date',
                'after_or_equal:start_date',
            ],
            'color' => [
                'required',
                'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $isAllDay = $this->input('is_all_day') === true || $this->input('is_all_day') === 'true';

        if (!$isAllDay) {
            $this->merge([
                'start_date' => $this->combineDateTime($this->input('start_date')['date'], $this->input('start_date')['hour'] ?? null),
                'end_date' => $this->combineDateTime($this->input('end_date')['date'], $this->input('end_date')['hour'] ?? null),
            ]);
        } else {
            $this->merge([
                'start_date' => $this->input('start_date')['date'],
                'end_date' => null,
            ]);
        }
    }

    private function combineDateTime($date, $time): ?Carbon
    {
        if (!$date || !$time) {
            return null;
        }

        try {
            return Carbon::createFromFormat('d-m-Y H:i', "$date $time");
        } catch (\Exception $e) {
            return null;
        }
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
