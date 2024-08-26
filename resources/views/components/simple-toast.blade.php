@props(['type' => 'info'])

@php
    $borderClass = 'border-primary';
    if ($type === 'error') {
        $borderClass = 'border-danger';
    } else if ($type != 'info') {
        $borderClass = "border-{$type}";
    }

    $iconColorClass = 'text-primary';
    if ($type === 'success') {
        $iconColorClass = 'text-success';
    } else if ($type === 'error') {
        $iconColorClass = 'text-danger';
    }
@endphp

<div {{ $attributes->merge(['class' => "toast border border-2 shadow-sm {$borderClass}"]) }}
     data-controller="toast" data-toast-auto-show-value="true">
    <div class="d-flex align-items-center justify-content-between p-1">
        <div class="{{ $iconColorClass }}">
            @if($type === 'success')
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md icon-tada"
                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
            @elseif($type === 'error')
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md icon-tada"
                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md icon-tada"
                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    <polyline points="11 12 12 12 12 16 13 16"></polyline>
                </svg>
            @endif
        </div>
        <div class="toast-body w-100 text-body">{{ $slot }}</div>
        <span class="btn-close mt-1 me-1 align-self-start" data-bs-dismiss="toast"></span>
    </div>
</div>
