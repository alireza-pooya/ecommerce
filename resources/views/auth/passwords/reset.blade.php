@extends('layouts.homebase')
@section('header')
    {!! htmlScriptTagJsApiV3(['action' => 'homepage']) !!}
@endsection
@section('content')
    <div class="container">
        <div class="row no-gutters justify-content-center">

            <div class="col-12 col-md-6 form-bg  shadow mt-5">
            <div class="col-11 mt-2">
                @include('layouts.messages')
                @include('layouts.errors')
            </div>
                <form method="POST" action="{{ route('set_password') }}">
                    {{ csrf_field() }}
                    <h2 class="text-center m-5" style="font-size: 40px; font-weight: bold"><b>Enter Password</b></h2>

                    <div class="col-8 center mb-3 inputWithIcon">
                        <input type="password" name="password" class="form-control height" placeholder="Password">
                        <i class="fa fa-lock fa-lg" aria-hidden="true"></i>
                    </div>

                    <div class="text-center mb-5">
                        <button class="btn btn-success col-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
