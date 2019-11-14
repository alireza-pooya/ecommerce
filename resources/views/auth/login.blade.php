@extends('layouts.homebase')
@section('content')
    <div class="container">
        <div class="row no-gutters justify-content-center">
            <div class="col-12 col-md-6 shadow form-bg mt-5">
                <div class="col-11 mt-2">
                    @include('layouts.messages')
                    @include('layouts.errors')
                </div>
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <h2 class="text-center m-5" style="font-size: 40px; font-weight: bold"><b>LOGIN</b></h2>
                    <div class="col-8 center mb-3 inputWithIcon">
                        <input type="text" class="form-control height" name="email" placeholder="email">
                        <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                    </div>
                    <div class="col-8 center inputWithIcon">
                        <input type="password" class="form-control height" name="password" placeholder="password">
                        <i class="fa fa-lock fa-lg" aria-hidden="true"></i>
                    </div>
                    <div class="col-12 col-md-5 offset-2 mt-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input"
                                   id="customCheck1" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                        </div>
                    </div>

                    <div class="col-8 center mt-5">
                        <button class="btn btn-dark form-control text-white height shadow "><strong>Login</strong></button>
                    </div>
                   <div class="mt-2 text-center">
                       <a href="{{ route('getemail') }}">forgot your password?</a>
                   </div>

                    <div class="text-center text-dark mt-5"><h4>Or Login With</h4></div>
                    <div class="text-center mb-5">
                        <a class="btn btn-google bg-secondary d-inline-block width mt-2" href="{{ route('google') }}"><img style="height: 25px" src="{{ url('images/login/google.png') }}" alt="GOOGLE">google
                        </a>
                    </div>
                    <div class="text-center mb-5">
                        <h4>Not a member? <a href="{{ route('register') }}"><u>Sign up now</u></a></h4>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
