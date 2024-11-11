@php use App\Models\User; @endphp
<form action="{{ $event->exists ? route('events.update', $event) : route('events.store') }}"
      method="post" accept-charset="utf-8" data-controller="form event" data-event-target="form">
    @csrf
    @if ($event->exists)
        @method('put')
    @endif
    <div class="modal-body nice-scrollbar scrollbar-primary">
        @include('events.form._fields')
    </div>
    <div class="modal-footer">
        <div class="d-flex justify-content-between">
            @if($event->exists)
                <button type="button" id="send-form" name="action" class="btn btn-primary ms-auto me-2 fw-bold" data-action="event#submitForm">
                    @svg(save) <span class="ms-1">@langUpperCase('general.save_changes')</span>
                </button>
            @else
                <button type="button" id="send-form" name="action" class="btn btn-primary ms-auto me-2 fw-bold" data-action="event#submitForm">
                    @svg(plus) <span class="ms-2">@langUpperCase('general.new') @langUpperCase('general.event')</span>
                </button>
            @endif
        </div>
    </div>
</form>
