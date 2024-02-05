<form action="{{ $route }}" method="post" id="userForm">
    @csrf
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="name" class="form-label">{{ __('Name') }} (*)</label>
            <input type="text" class="form-control" name="name" id="name"
                   @if(isset($user))
                       value="{{ $user->name }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="abbreviation" class="form-label">{{ __('Abbreviation') }} (*)</label>
            <input type="text" class="form-control" name="abbreviation" id="abbreviation"
                   @if(isset($user))
                       value="{{ $user->abbreviation }}"
                   @endif
                   required>
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="email" class="form-label">{{ __('Email') }} (*)</label>
            <input type="email" class="form-control" name="email" id="email"
                   @if(isset($user))
                       value="{{ $user->email }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="role">{{ __('Role') }} (*)</label>
            <select class="form-select" name="role" id="role">
                <option value="0" selected>{{ __('No role') }}</option>
                @foreach($roles as $role)
                    <option
                        @if(isset($user) && $user->hasRole($role->name))
                            selected
                        @endif
                        value="{{ $role->name }}">{{ __(ucfirst($role->name)) }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="mb-2 col-md-6 col-sm-12">
                <label for="password" class="form-label">{{ __('Password') }}
                    @if(!isset($user))
                        (*)
                    @else
                        ({{ __('No change if empty') }})
                    @endif
                </label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            @if(!isset($user))
                <div class="mb-2 col-md-6 col-sm-12">
                    <label for="password_confirmation" class="form-label">{{ __('Password confirmation') }} (*)</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>
            @endif
        </div>
</form>
