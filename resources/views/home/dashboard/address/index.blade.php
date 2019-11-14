@extends('home.dashboard')
@section('body')

    <div class="container mt-5 ">
        <div class="col-12 text-center"><h3><b>{{ Auth::user()->full_name }} Addresses</b></h3></div>
        @include('layouts.errors')
        @include('layouts.messages')
        @if(count($user->addresses))
        @foreach($user->addresses as $userAddress)
            <div class="row  shadow form-bg mt-3 p-4">
                <form action="{{ route('address.destroy',['userAddress'=>$userAddress->id]) }}" class="col-12" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="country"><b>country :</b></label>
                        <span>{{ $userAddress['country'] }}</span>
                    </div>
                </div>
                <div class="col-12  col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="city"><b>city :</b></label>
                        <span>{{ $userAddress['city'] }}</span>
                    </div>
                </div>
                <div class="col-12  col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="street"><b>district :</b></label>
                        <span>{{ $userAddress['street'] }}</span>
                    </div>
                </div>
                <div class="col-12  col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="zip_code"><b>zip code :</b></label>
                        <span>{{ $userAddress['zip_code'] }}</span>
                    </div>
                </div>
                <div class="col-12  col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="phone_number"><b>phone number :</b></label>
                        <span>{{ $userAddress['phone_number'] }}</span>
                    </div>
                </div>
                <div class="col-12 col-md-8 offset-md-1 mt-3">
                    <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    <a href="{{ route('address.edit',['userAddress'=>$userAddress->id]) }}" class="btn btn-warning"><i class="fa fa-pencil-square"></i> edit</a>
                </div>
                </form>
            </div>
        @endforeach
            @else
            <h1 class="text-center mt-5">There is no Address</h1>
            @endif
    </div>
@endsection

