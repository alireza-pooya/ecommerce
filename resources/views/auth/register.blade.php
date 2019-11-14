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
                <form method="POST" action="{{ route('register.store') }}">
                    {{ csrf_field() }}
                    <h2 class="text-center m-5" style="font-size: 40px; font-weight: bold"><b>Register</b></h2>
                    <div class="col-8 center mb-3 inputWithIcon">
                        <input type="text" name="full_name" class="form-control height" placeholder="Your name" value="{{ old('full_name') }}">
                        <i class="fa fa-user fa-lg" aria-hidden="true"></i>
                    </div>
                    <div class="col-8 center mb-3 inputWithIcon">
                        <input type="text" name="email" class="form-control height" placeholder="Email" value="{{ old('email') }}">
                        <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                    </div>
                    <div class="col-8 center mb-3 inputWithIcon">
                        <input type="password" name="password" class="form-control height" placeholder="Password">
                        <i class="fa fa-lock fa-lg" aria-hidden="true"></i>
                    </div>
                    <div class="col-8 center inputWithIcon">
                        <input type="password" name="password_confirmation" class="form-control height"
                               placeholder="Re-enter password">
                        <i class="fa fa-lock fa-lg" aria-hidden="true"></i>
                    </div>
                    <div class="col-12 col-md-5 offset-2 mt-2">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gender1" name="gender" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="gender1">woman</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gender2" name="gender" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="gender2">man</label>
                        </div>
                    </div>
                    <div class="col-8 center mt-5">
                        <button class="btn btn-dark form-control text-white height shadow "><strong>Create Account</strong></button>
                    </div>
                    <div class="text-center text-dark mt-5 "><h4>Already have an account? </h4></div>

                    <div class="text-center mb-5">
                        <h4><a href="{{ route('login') }}"><u>Sign-In</u></a></h4>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
