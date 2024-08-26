<div class="alert {{ $alertClass }} alert-dismissible">
    <div class="d-flex align-items-center">
        @if (!!$iconClass)
            <div class="me-2">
                @if($iconClass == 'info')
                    @svg(info)
                @elseif($iconClass == 'alert-circle')
                    @svg(alert-circle)
                @elseif($iconClass == 'alert-warning')
                    @svg(alert-warning)
                @else
                    @svg(check)
                @endif
            </div>
        @endif
        <div>
            <h4 class="alert-title">{!! $message !!}</h4>
        </div>
    </div>
    <a class="btn-close" data-bs-dismiss="alert" aria-label="cerrar"></a>
</div>
