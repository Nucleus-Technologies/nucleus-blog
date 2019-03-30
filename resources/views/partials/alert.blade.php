@if (\Illuminate\Support\Facades\Session::has('error'))
    <div class="alert alert-danger">
        <div class="row msg">
            <p>{{ \Illuminate\Support\Facades\Session::get('error') }}</p>
        </div>
    </div>
@elseif (\Illuminate\Support\Facades\Session::has('success'))
    <div class="alert alert-success">
        <div class="row msg">
            <p>{{ \Illuminate\Support\Facades\Session::get('success') }}</p>
        </div>
    </div>
@elseif (\Illuminate\Support\Facades\Session::has('message'))
    <div class="alert alert-info">
        <div class="row msg">
            <p>{{ \Illuminate\Support\Facades\Session::get('message') }}</p>
        </div>
    </div>
@elseif (\Illuminate\Support\Facades\Session::has('info'))
    <div class="alert alert-info">
        <div class="row msg">
            <p>{{ \Illuminate\Support\Facades\Session::get('info') }}</p>
        </div>
    </div>
@endif
