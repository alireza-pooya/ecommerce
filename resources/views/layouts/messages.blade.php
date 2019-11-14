@if($message = session('message'))
    <div class="col-12">
        <div class="alert alert-success">
            <i>{{$message}}</i>
        </div>
    </div>
@endif