<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <div class="row justify-content-between w-100">
            <ul class="navbar-nav d-flex col-12 col-xl-7 col-lg-7">
                <li class="nav-item {{ request()->url() == route('index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('index') }}" title="@langUpperCase('general.home')">
                        @svg(home) <span class="nav-link-title ms-2">@langUpperCase('general.home')</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->url() == route('events.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('events.index') }}" title="@langUpperCase('general.calendar')">
                        @svg(calendar) <span class="nav-link-title ms-2">@langUpperCase('general.calendar')</span>
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
                                       title="{{ __("general.languages.$language->name") }}"
                                       data-action="form#submit">
                                        <img src="{{ image_url($language->image) }}" alt="{{ $language->name }}" height="32">
                                        <div class="fw-medium ms-2">{{ ucfirst(__("general.languages.$language->name")) }}</div>
                                    </a>
                                </form>
                            @endforeach
                        </div>
                    </div>
                    @if(!session()->has('mode') || session()->get('mode') == 'light')
                        <div
                            data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="@langUpperCase('general.theme.dark')"
                            data-bs-original-title="@langUpperCase('general.theme.dark')">
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
                            data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="@langUpperCase('general.theme.light')"
                            data-bs-original-title="@langUpperCase('general.theme.light')">
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
</header>
