@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        @if(is_array(session('success')))
            <ul class="m-0 p-0">
                @foreach (session('success') as $message)
                    <li class="list-group-item">{{ $message }}</li>
                @endforeach
            </ul>
        @else
            <li class="list-group-item">{{ session('success') }}</li>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="m-0 p-0">
            @foreach ($errors->all() as $error)
                <li class="list-group-item">{{ ucfirst($error) }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        @if(is_array(session('error')))
            <ul class="m-0 p-0">
                @foreach(session('error') as $message)
                    <li class="list-group-item">{{ $message }}</li>
                @endforeach
            </ul>
        @else
            <li class="list-group-item">{{ session('error') }}</li>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        @if(is_array(session('info')))
            <ul class="m-0 p-0">
                @foreach(session('info') as $message)
                    <li class="list-group-item">{{ $message }}</li>
                @endforeach
            </ul>
        @else
            <li class="list-group-item">{{ session('info') }}</li>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('status'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">

        @if(is_array(session('status')))
            <ul class="m-0 p-0">
                @foreach(session('status') as $message)
                    <li class="list-group-item">{{ $message }}</li>
                @endforeach
            </ul>
        @else
            <li class="list-group-item">{{ session('status') }}</li>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
