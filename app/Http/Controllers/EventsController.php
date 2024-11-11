<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\EventDateRequest;
use App\Http\Requests\EventGetRequest;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Repositories\Events;
use Illuminate\Contracts\Console\Application as ConsoleApplication;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use JsonSerializable;

final class EventsController extends Controller
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct(
        Request $request,
        protected Events $events
    ) {
        parent::__construct($request);
    }

    /**
     * [GET] /calendar
     * index
     *
     * Returns the login view.
     */
    public function index(): ConsoleApplication|FoundationApplication|View|Factory
    {
        return view('events.index');
    }

    /**
     * [GET] /events
     * events.get
     *
     * Returns the login view.
     */
    public function get(EventGetRequest $request): array|JsonSerializable|Arrayable
    {
        $validate = $request->validated();

        $events = $this->events->newQuery()
            ->dateRange($validate['start'], $validate['end'])
            ->user(current_user())
            ->get();

        return EventResource::collection($events)->toArray($request);
    }

    /**
     * [GET] /events/create
     * events.create
     *
     * Returns the event modal stream view for create.
     *
     * @throws BindingResolutionException
     */
    public function create(): RedirectResponse|Response|ResponseFactory
    {
        if ($this->wantsTurboStream($this->request)) {
            $event = $this->events->build();

            return $this->renderTurboStream('events.form.modal_stream', ['event' => $event]);
        }

        return redirect()->back();
    }

    /**
     * [GET] /events/{event}/edit
     * events.edit
     *
     * Returns the company modal stream view for update.
     *
     * @throws BindingResolutionException
     */
    public function edit(
        Event $event,
    ): RedirectResponse|Response|ResponseFactory {
        if ($this->wantsTurboStream($this->request)) {
            return $this->renderTurboStream('events.form.modal_stream', [
                'event' => $event,
            ]);
        }

        return redirect()->back();
    }

    /**
     * [POST] /events
     * events.store
     *
     * Validate event form and create.
     */
    public function store(EventRequest $request): JsonResponse
    {
        $event = $this->events->create($request->validated());
        if (
            $event instanceof Event
        ) {
            return response()->json([
                'status' => 'success',
                'message' => __('general.responses.success-create-event'),
                'data' => new EventResource($event)
            ]);
        }

        return response()
            ->json([
                'status' => 'error', 'message' => __('general.responses.error-create-event')
            ])
            ->setStatusCode(500);
    }

    /**
     * [PUT] /events/{event}
     * events.update
     *
     * Validate request and update Event.
     */
    public function update(
        EventRequest $request,
        Event $event,
    ): JsonResponse
    {
        if ($this->events->update($event, $request->validated()) instanceof Event) {
            return response()->json([
                'status' => 'success',
                'message' => __('general.responses.success-update-event'),
                'data' => new EventResource($event)
            ]);
        }

        return response()
            ->json(['status' => 'error', 'message' => __('general.responses.error-update-event')])
            ->setStatusCode(500);
    }

    /**
     * [PUT] /events/{event}/dates
     * events.update.dates
     *
     * Validate request and update Event dates.
     */
    public function updateDates(
        EventDateRequest $request,
        Event $event,
    ): JsonResponse
    {
        if ($this->events->update($event, $request->validated()) instanceof Event) {
            return response()->json(['status' => 'success', 'message' => __('trip.responses.success-update-inspection')]);
        }

        return response()
            ->json(['status' => 'error', 'message' => __('trip.responses.error-update-inspection')])
            ->setStatusCode(500);
    }
}
