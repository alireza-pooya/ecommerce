@extends('layouts.homebase')
@section('content')
    <div class="container mt-5">
        <div class="mb-5 shadow-sm form-bg">
            <div class="row no-gutters justify-content-center mt-5">
                <div class="col-10 justify-content-center mb-5">

                    <div class="col-12 justify-content-center mb-5">
                        <h1 class="text-center pt-5"><b>Choose your Address</b></h1>
                    </div>
                    <div class="col-12 justify-content-center mb-5">
                        @include('layouts.messages')
                        @include('layouts.errors')
                        <h3><b>Sending To ...</b></h3>
                        <hr>
                        @if(count($user->addresses))
                            <form action="{{ route('Bank') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="discountCode" value="{{ $discountCode }}">
                                <div class="row justify-content-between">
                                    @foreach($user->addresses as $address)
                                        <div class="col-12 col-md-5">
                                            <div class="form-group p-2">
                                                <div class="custom-control custom-radio custom-control-inline mb-2">
                                                    <input type="radio" id="{{ $address['id'] }}" name="address" checked
                                                           class="custom-control-input" value="{{ $address['id'] }}">
                                                    <label class="custom-control-label" for="{{ $address['id'] }}">This Address</label>
                                                </div>
                                                <div style="border: dashed 2px gray">
                                                    <div class="col-12 col-md-10 offset-md-1 pl-1">
                                                        <div class="form-group mb-0">
                                                            <label class="col-form-label" for="country"><b>country :</b></label>
                                                            <span>{{ $address['country'] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12  col-md-10 offset-md-1 pl-1">
                                                        <div class="form-group mb-0">
                                                            <label class="col-form-label" for="city"><b>city :</b></label>
                                                            <span>{{ $address['city'] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12  col-md-10 offset-md-1 pl-1">
                                                        <div class="form-group mb-0">
                                                            <label class="col-form-label" for="street"><b>district :</b></label>
                                                            <span>{{ $address['street'] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12  col-md-10 offset-md-1 pl-1">
                                                        <div class="form-group mb-0">
                                                            <label class="col-form-label" for="zip_code"><b>zip code :</b></label>
                                                            <span>{{ $address['zip_code'] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12  col-md-10 offset-md-1 pl-1">
                                                        <div class="form-group mb-0">
                                                            <label class="col-form-label" for="phone_number"><b>phone number :</b></label>
                                                            <span>{{ $address['phone_number'] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="{{ route('cart') }}" class="btn btn-warning">Back To Cart</a>
                                <button class="btn btn-success col-4">Payment</button>
                            </form>

                        @else
                            <a href="{{ route('address.create') }}"><h3 class="text-center alert alert-danger">Please
                                    Add your Address</h3></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="clearfix"></div>
@endsection

