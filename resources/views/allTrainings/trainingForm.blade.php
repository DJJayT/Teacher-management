<form action="{{ $route }}" method="post" id="trainingForm">
    @csrf
    <div class="row">
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="title" class="form-label">{{ __('Title') }} (*)</label>
            <input type="text" class="form-control" name="title" id="title"
                   @if(isset($training))
                       value="{{$training->title}}"
                   @endif
                   required>
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="areas">{{ __('area') }} (*)</label>
            <select class="form-select" name="area_id" id="areas">
                @if(!isset($training))
                    <option value="0" selected>{{ __('Select area') }}</option>
                @endif
                @foreach($areas as $area)
                    <option
                        @if(isset($training) && $training->area_id == $area->id)
                            selected
                        @endif
                        value="{{ $area->id }}">{{ $area->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="providers">{{ __('provider') }} (*)</label>
            <select class="form-select" name="provider_id" id="providers">
                @if(!isset($training))
                    <option value="0" selected>{{ __('Select provider') }}</option>
                @endif
                @foreach($providers as $provider)
                    <option
                        @if(isset($training) && $training->provider_id == $provider->id)
                            selected
                        @endif
                        value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
