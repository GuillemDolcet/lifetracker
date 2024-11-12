<div class="row">
    <div class="col-12 mb-2">
        <label class="form-label fw-bold" for="title">
            @langUpperCase('general.title') <sup class="text-danger fs-xs">*</sup>
        </label>
        <div class="input-group">
            <span class="input-group-text">@svg('a-z')</span>
            <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                   autocomplete="off" required value="{{ old('title', $event->title) }}" minlength="2" maxlength="100">
        </div>
        @error('title')
        <div class="text-danger fs-5">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-xl-6 mt-2 mb-2">
        <label class="form-label fw-bold" for="start_date">
            @langUpperCase('general.start_date') <sup class="text-danger fs-xs">*</sup>
        </label>
        <div class="input-group">
            <span class="input-group-text">@svg(calendar)</span>
            <input
                class="form-control @error('start_date.date') is-invalid @enderror"
                data-form-target="datepicker"
                id="start_date[date]"
                name="start_date[date]"
                value="{{ old('start_date.date', $event->exists ? $event->start_date->format('d-m-Y') : (isset($startDate) ? \Carbon\Carbon::parse($startDate)->format('d-m-Y') : \Carbon\Carbon::now()->format('d-m-Y'))) }}"
                data-single-mode="true">
            <span class="input-group-text">@svg(clock)</span>
            <input
                class="form-control @error('start_date.hour') is-invalid @enderror"
                type="time"
                id="start_date[hour]"
                name="start_date[hour]"
                value="{{ old('end_date.hour', $event->exists ? $event->start_date->format('H:i') : (isset($startDate) ? \Carbon\Carbon::parse($startDate)->format('H:i') : '23:59')) }}">
        </div>
        @error('start_date.*')
        <div class="text-danger fs-5">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-xl-6 mt-2 mb-2">
        <label class="form-label fw-bold" for="end_date">
            @langUpperCase('general.end_date') <sup class="text-danger fs-xs">*</sup>
        </label>
        <div class="input-group">
            <span class="input-group-text">@svg(calendar)</span>
            <input
                class="form-control @error('end_date.date') is-invalid @enderror"
                data-form-target="datepicker"
                id="end_date[date]"
                name="end_date[date]"
                value="{{ old('end_date.date', $event->exists ? $event->end_date->format('d-m-Y') : (isset($endDate) ? \Carbon\Carbon::parse($endDate)->format('d-m-Y') : \Carbon\Carbon::now()->format('d-m-Y'))) }}"
                data-single-mode="true">
            <span class="input-group-text">@svg(clock)</span>
            <input
                class="form-control @error('end_date.hour') is-invalid @enderror"
                type="time"
                id="end_date[hour]"
                name="end_date[hour]"
                value="{{ old('end_date.hour', $event->exists ? $event->end_date->format('H:i') : (isset($endDate) ? \Carbon\Carbon::parse($endDate)->format('H:i') : '23:59')) }}">
        </div>
        @error('end_time.*')
        <div class="text-danger fs-5">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-xl-6 mt-2 mb-2">
        <label class="form-label fw-bold" for="color">
            @langUpperCase('general.color') <sup class="text-danger fs-xs">*</sup>
        </label>
        <div class="row g-2">
            <div class="col-auto">
                <label class="form-colorinput">
                    <input name="color" type="radio" value="#0818A8" class="form-colorinput-input" required
                        {{ old('color') == '#0818A8' || ($event->exists && !old('color') && $event->color == '#0818A8') ? 'checked' : '' }}>
                    <span class="form-colorinput-color bg-blue"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="form-colorinput">
                    <input name="color" type="radio" value="#4299e1" class="form-colorinput-input" required
                        {{ old('color') == '#4299e1' || ($event->exists && !old('color') && $event->color == '#4299e1') ? 'checked' : '' }}>
                    <span class="form-colorinput-color bg-azure"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="form-colorinput">
                    <input name="color" type="radio" value="#4263eb" class="form-colorinput-input" required
                        {{ old('color') == '#4263eb' || ($event->exists && !old('color') && $event->color == '#4263eb') ? 'checked' : '' }}>
                    <span class="form-colorinput-color bg-indigo"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="form-colorinput">
                    <input name="color" type="radio" value="#5D3FD3" class="form-colorinput-input" required
                        {{ old('color') == '#5D3FD3' || ($event->exists && !old('color') && $event->color == '#5D3FD3') ? 'checked' : '' }}>
                    <span class="form-colorinput-color bg-purple"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="form-colorinput">
                    <input name="color" type="radio" value="#d6336c" class="form-colorinput-input" required
                        {{ old('color') == '#d6336c' || ($event->exists && !old('color') && $event->color == '#d6336c') ? 'checked' : '' }}>
                    <span class="form-colorinput-color bg-pink"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="form-colorinput">
                    <input name="color" type="radio" value="#880808" class="form-colorinput-input" required
                        {{ old('color') == '#880808' || ($event->exists && !old('color') && $event->color == '#880808') ? 'checked' : '' }}>
                    <span class="form-colorinput-color bg-red"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="form-colorinput">
                    <input name="color" type="radio" value="#f76707" class="form-colorinput-input" required
                        {{ old('color') == '#f76707' || ($event->exists && !old('color') && $event->color == '#f76707') ? 'checked' : '' }}>
                    <span class="form-colorinput-color bg-orange"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="form-colorinput">
                    <input name="color" type="radio" value="#f59f00" class="form-colorinput-input" required
                        {{ old('color') == '#f59f00' || ($event->exists && !old('color') && $event->color == '#f59f00') ? 'checked' : '' }}>
                    <span class="form-colorinput-color bg-yellow"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="form-colorinput">
                    <input name="color" type="radio" value="#74b816" class="form-colorinput-input" required
                        {{ old('color') == '#74b816' || ($event->exists && !old('color') && $event->color == '#74b816') ? 'checked' : '' }}>
                    <span class="form-colorinput-color bg-lime"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="form-colorinput">
                    <input name="color" type="radio" value="#0ca678" class="form-colorinput-input" required
                        {{ old('color') == '#0ca678' || ($event->exists && !old('color') && $event->color == '#0ca678') ? 'checked' : '' }}>
                    <span class="form-colorinput-color bg-teal"></span>
                </label>
            </div>
        </div>
        @error('color')
        <div class="text-danger fs-5">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-xl-6 mt-2 mb-2">
        <label class="form-label fw-bold" for="is_all_day">@langUpperCase('general.all_day_event')</label>
        <div class="form-selectgroup">
            <label class="form-selectgroup-item w-7">
                <input type="radio" name="is_all_day" value="false"
                       class="form-selectgroup-input @error('is_all_day') is-invalid @enderror"
                    {{ (isset($event) && $event->exists && !$event->is_all_day && !old('is_all_day')) || old('is_all_day') == 'false' || !old('is_all_day') ? 'checked' : '' }}>
                <span class="form-selectgroup-label">@langUpperCase('general.no')</span>
            </label>
            <label class="form-selectgroup-item w-7">
                <input type="radio" name="is_all_day" value="true" data-action="change->"
                       class="form-selectgroup-input @error('is_all_day') is-invalid @enderror"
                    {{ (isset($event) && $event->exists && $event->is_all_day && !old('is_all_day')) || old('is_all_day') == 'true' ? 'checked' : '' }}>
                <span class="form-selectgroup-label">@langUpperCase('general.yes')</span>
            </label>
        </div>
        @error('is_all_day')
        <div class="text-danger fs-5">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 mt-2 mb-2">
        <label class="form-label fw-bold" for="description">@langUpperCase('general.description')</label>
        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                  rows="4" maxlength="500">{{ old('description', $event->description) }}</textarea>
        @error('description')
        <div class="text-danger fs-5">{{ $message }}</div>
        @enderror
    </div>
</div>
