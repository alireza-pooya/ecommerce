@extends('home.dashboard')
@section('body')

    <div class="container mt-5 ">
        <div class="col-12 text-center"><h3><b>change Password</b></h3></div>
        <form action="{{ route('profile.password.update',['user'=>$user->id]) }}" method="post">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="row  shadow form-bg mt-3 p-4">
                @include('layouts.messages')
                @include('layouts.errors')
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="password"><b>new password :</b></label>
                        <input class="form-control" type="password" id="password"  placeholder=" password" name="password">
                    </div>
                </div>
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="password_confirmation"><b>repeat new password :</b></label>
                        <input class="form-control" type="password" id="password_confirmation"  placeholder="Re-enter password" name="password_confirmation">
                    </div>
                </div>
                <div class="col-12 col-md-6 offset-md-6 mt-4">
                    <button class="btn btn-success">save changes</button>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-info">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection

