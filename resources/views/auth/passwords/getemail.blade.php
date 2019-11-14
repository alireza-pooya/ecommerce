@extends('layouts.homebase')
@section('header')
    {!! htmlScriptTagJsApiV3(['action' => 'homepage']) !!}
@endsection
@section('content')
    <div class="container">
        <div class="row no-gutters justify-content-center">

            <div class="col-12 col-md-8 form-bg  shadow mt-5" style="min-height: 500px">
            <div class="col-11 mt-2">
                @include('layouts.messages')
                @include('layouts.errors')
            </div>
                <form method="POST" action="{{ route('resetpassword') }}">
                    {{ csrf_field() }}
                    <h2 class="text-center m-5" style="font-size: 40px; font-weight: bold"><b>Password Recovery</b></h2>
                    <div class="col-8 center mb-3 inputWithIcon">
                        <input type="text" name="email" id="email" class="form-control height" placeholder="Email" value="{{ old('email') }}">
                        <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                    </div>
                    <div class="text-center mb-5 mt-5">
                        <button class="btn btn-success col-4">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
