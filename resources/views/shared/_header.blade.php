@php use App\Models\User; @endphp
@php use App\Models\Company; @endphp
<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="row w-100 align-items-center" data-controller="session">
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3 col mt-1 mb-1">
                <a href="{{ route('index') }}">
                    <img src="{{ image_url(!session()->has('mode') || session()->get('mode') == 'light' ? 'logo-dark.png' : 'logo-light.png') }}" height="30" alt="{{ config('app.name') }}">
                </a>
            </h1>
            <div class="input-group me-2 header-input col-xl-3 col-lg-3 col-12 m-auto mt-1 mb-1">
                <span class="input-group-text">@svg(factory)</span>
                <select class="form-select" id="company-select"
                        data-url="{{ route('session.company', ['company' => 'value', 'route' => null]) }}"
                        data-action="change->session#change" @if(count(current_user_companies()) == 1) disabled
                        @endif autocomplete="off">
                    @foreach(current_user_companies() as $company)
                        <option
                            value="{{ $company->getKey() }}" {{ session()->get('company') == $company->getKey() ? 'selected=selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group me-2 header-input col-xl-3 col-lg-3 col-12 m-auto mt-1 mb-1">
                <span class="input-group-text">@svg(location)</span>
                <select class="form-select" id="location-select"
                        data-url="{{ route('session.location', ['location' => 'value']) }}"
                        data-action="change->session#change" autocomplete="off">
                    <option value="">@langUpperCase('trip.all')</option>
                    @foreach(current_user_locations() as $location)
                        <option value="{{ $location->getKey() }}"
                            {{ session()->has('location') && session()->get('location') == $location->getKey() ? 'selected=selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group header-input col-xl-3 col-lg-3 col-12 m-auto mt-1 mb-1">
                <span class="input-group-text">@svg(activity)</span>
                <select class="form-select" id="activity-select"
                        data-url="{{ route('session.activity', ['activity' => 'value']) }}"
                        data-action="change->session#change" autocomplete="off">
                    <option value="">@langUpperCase('trip.all')</option>
                    @foreach(current_user_locations_activities() as $activity)
                        <option value="{{ $activity->getKey() }}"
                            {{ session()->has('activity') && session()->get('activity') == $activity->getKey() ? 'selected=selected' : '' }}>
                            {{ ucfirst(__('trip.activities-trans.' . $activity->name)) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</header>
<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <div class="row justify-content-between w-100">
                    <ul class="navbar-nav d-flex col-12 col-xl-7 col-lg-7">
                        <li class="nav-item {{ request()->url() == route('index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('index') }}" title="@langUpperCase('trip.home')">
                                @svg(home) <span class="nav-link-title ms-2">@langUpperCase('trip.home')</span>
                            </a>
                        </li>
                        @can('view', User::class)
                            <li class="nav-item {{ request()->is('*users*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('users.index') }}"
                                   title="@langUpperCase('trip.users')">
                                    @svg(users) <span class="nav-link-title ms-2">@langUpperCase('trip.users')</span>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item dropdown {{ request()->is('*companies*') && !request()->is('*files*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle d-flex justify-content-between" data-bs-toggle="dropdown"
                               data-bs-auto-close="outside" role="button" aria-expanded="false">
                                @svg(factory) <span class="nav-link-title ms-2">@langUpperCase('trip.companies')</span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        @can('view', Company::class)
                                            <a class="dropdown-item" href="{{ route('companies.index') }}">
                                                @langUpperCase('trip.alls.companies')
                                            </a>
                                        @endcan
                                        <a class="dropdown-item" href="{{ route('companies.company') }}">
                                            @langUpperCase('trip.your_company')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item {{ request()->is('*equipments*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('equipments.index') }}"
                               title="@langUpperCase('trip.users')">
                                @svg(tool) <span class="nav-link-title ms-2">@langUpperCase('trip.equipments')</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown {{ request()->is('*inspections*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                               role="button" aria-expanded="false">
                                @svg(zoom) <span class="nav-link-title ms-2">@langUpperCase('trip.inspections')</span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="{{ route('inspections.index') }}">
                                            @langUpperCase('trip.alls.inspections')
                                        </a>
                                        <a class="dropdown-item"
                                           href="{{ route('inspections.index', ['type' => '1']) }}">
                                            @langUpperCase('trip.inspections') @lang('trip.inspections-types.regulatory')
                                        </a>
                                        <a class="dropdown-item"
                                           href="{{ route('inspections.index', ['type' => '2']) }}">
                                            @langUpperCase('trip.inspections') @lang('trip.inspections-types.volunteer')
                                        </a>
                                        <a class="dropdown-item"
                                           href="{{ route('inspections.index', ['type' => '3']) }}">
                                            @langUpperCase('trip.inspections') @lang('trip.inspections-types.maintenance')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item {{ request()->is('*libraries*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('libraries.index') }}"
                               title="@langUpperCase('trip.libraries')">
                                @svg(books) <span class="nav-link-title ms-2">@langUpperCase('trip.library')</span>
                            </a>
                        </li>
                    </ul>
                    <div class="ms-2 nav-item dropdown d-flex justify-content-between justify-content-sm-end mt-1 mb-1 col-12 col-lg-4 col-xl-4 align-items-center">
                        <div class="me-2 cursor-pointer d-flex align-items-center">
                            <div class="me-3 dropdown">
                                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                        <img src="{{ image_url(app()->getLocale() . '.png') }}" alt="{{ app()->getLocale() }}" height="32">
                                </a>
                                <div class="dropdown-menu dropdown-menu-start dropdown-menu-arrow">
                                    @foreach(\App\Models\Language::whereNot('name', app()->getLocale())->get() as $language)
                                        <form method="post" class="dropdown-item" action="{{ route('session.locale', $language->getKey()) }}"
                                              data-controller="form">
                                            @csrf
                                            <a href="#" class="w-100 text-decoration-none d-flex align-items-center"
                                               title="{{ __("trip.languages.$language->name") }}"
                                               data-action="form#submit">
                                                <img src="{{ image_url($language->image) }}" alt="{{ $language->name }}" height="32">
                                                <div class="fw-medium ms-2">{{ ucfirst(__("trip.languages.$language->name")) }}</div>
                                            </a>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                            @if(!session()->has('mode') || session()->get('mode') == 'light')
                                <div
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="@langUpperCase('trip.theme.dark')"
                                    data-bs-original-title="@langUpperCase('trip.theme.dark')">
                                    <form method="post"
                                          action="{{ route('session.mode', ['mode' => 'dark']) }}" data-controller="form">
                                        @csrf
                                        <a href="#" class="text-decoration-none" data-action="form#submit">
                                            @svg(moon, 24, 24)
                                        </a>
                                    </form>
                                </div>
                            @else
                                <div
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="@langUpperCase('trip.theme.light')"
                                    data-bs-original-title="@langUpperCase('trip.theme.light')">
                                    <form method="post"
                                          action="{{ route('session.mode', ['mode' => 'light']) }}" data-controller="form">
                                        @csrf
                                        <a href="#" class="text-decoration-none" data-action="form#submit">
                                            @svg(sun, 32, 32)
                                        </a>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <div class="ps-2">
                                <div>{{ current_user()->first_name }} {{ current_user()->last_name }}</div>
                                <div class="mt-1 small text-secondary text-end">{{ current_user()->username }}</div>
                            </div>
                            <span class="text-muted ms-2">@svg(down)</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="#"
                               class="dropdown-item text-decoration-none d-flex align-items-center w-100"
                               title="@langUpperCase('trip.edit')"
                               data-controller="remote-modal"
                               data-action="remote-modal#toggle"
                               data-remote-modal-url-value="{{ route('users.edit', current_user()) }}"
                               data-remote-modal-target-value="#user-form-modal">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div class="fw-medium">@svg(user)</div>
                                    <div class="fw-medium">@langUpperCase('trip.edit') @lang('trip.user')</div>
                                </div>
                            </a>
                            <form method="post" class="dropdown-item w-100" action="{{ route('logout') }}"
                                  data-controller="form">
                                @csrf
                                @method('delete')
                                <a href="#" class="w-100 text-decoration-none d-flex align-items-center"
                                   title="@langUpperCase('auth.logout')"
                                   data-action="form#submit">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <div class="fw-medium">@svg(logout)</div>
                                        <div class="fw-medium">@langUpperCase('auth.logout')</div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
