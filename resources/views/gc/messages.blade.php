@if (count($errors)>0)
    @foreach ($errors->all() as $err)
        <div class="alert alert-danger">
            {{$err}}
        </div>
    @endforeach
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
        {{session('warning')}}
    </div>
@endif