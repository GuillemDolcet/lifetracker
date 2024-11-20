<div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
            @unless ($event->exists)
                <h5 class="modal-title">@langUpperCase('general.news.event')</h5>
            @else
                <h5 class="modal-title">
                    {{ $event->title }}
                </h5>
            @endif
            <span class="btn-close" data-bs-dismiss="modal"></span>
        </div>
        @include('events.form._form')
    </div>
</div>
