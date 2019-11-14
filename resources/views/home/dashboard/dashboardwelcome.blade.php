@extends('home.dashboard')
@section('body')
    <div class="container">
        @include('layouts.errors')
        @include('layouts.messages')
        <div class="jumbotron mt-5 text-center" style="z-index: 0 ; margin: 20% 0">
            <h1>Welcome {{ Auth()->user()->full_name }}</h1>

            you can edit your profile <br>
            add new address <br>
            and change your password
        </div>
    </div>
@endsection

