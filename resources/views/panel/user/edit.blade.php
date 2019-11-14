@extends('layouts.panel')
@section('header')
    <title>panel-Edit User</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Edit User</h1>
        </div>
    </div>
    @include('layouts.messages')
    @include('layouts.errors')
    <form action="{{ route('user.update',['user'=>$user->id]) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-form-label" for="full_name">full name :</label>
                    <input class="form-control" type="text" id="full_name" name="full_name"
                           value="{{ $user['full_name'] }}">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="email">email :</label>
                    <input class="form-control" type="text" id="email" name="email"
                           value="{{ $user['email'] }}">
                </div>
                <div class="form-group">
                    <label for="mobile">mobile :</label>
                    <input type="text" id="mobile" name="mobile" class="form-control"
                           value="{{ $user['mobile'] }}">
                </div>
                <div class="form-group">
                    <label for="password">password :</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="IF NEEDED">
                </div>
                <div class="form-group mb-0">
                    <label class="col-form-label" for="password_confirmation"><b>repeat new password :</b></label>
                    <input class="form-control" type="password" id="password_confirmation"  placeholder="Re-enter password" name="password_confirmation">
                </div>
                <div class="col-12 col-md-5 mt-2 mb-3">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="gender1" name="gender" class="custom-control-input" value="0"{{ ( $user['gender']  == 0 ?  "checked" : '') }}>
                        <label class="custom-control-label" for="gender1">woman</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="gender2" name="gender" class="custom-control-input" value="1"{{ ( $user['gender']  == 1 ?  "checked" : '') }}>
                        <label class="custom-control-label" for="gender2">man</label>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <button type="submit" class="btn btn-warning">edit</button>
                    <a href="{{route('user.index')}}" class="btn btn-info">return</a>
                </div>

            </div>
        </div>
        <hr>
        @foreach($user->addresses as $userAddress)
            <div class="row justify-content-center">
                <div class="col-12 mt-3 "><h1>User Address</h1></div>
                <div class="col-12">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="country"><b>country :</b></label>
                        {{ $userAddress['country'] }}
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="city"><b>city :</b></label>
                        {{ $userAddress['city'] }}
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="street"><b>district :</b></label>
                        {{ $userAddress['street'] }}
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="zip_code"><b>zip code :</b></label>
                        {{ $userAddress['zip_code'] }}
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="phone_number"><b>phone number :</b></label>
                        {{ $userAddress['phone_number'] }}
                    </div>
                </div>
                @endforeach

            </div>
    </form>
@endsection
