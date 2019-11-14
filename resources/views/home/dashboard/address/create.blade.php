@extends('home.dashboard')
@section('body')

    <div class="container mt-5  form-bg">
        <div class="row no-gutters d-flex justify-content-md-center">
            <div class="col-12 text-center mb-5"><h3><b>Create Address</b></h3></div>
            @include('layouts.errors')
            @include('layouts.messages')
            <form action="{{ route('address.store') }}" method="post" class="col-12 shadow">
                {{ csrf_field() }}
                <div class="p-3">
                    <div class="col-12 col-md-5 d-inline-block offset-md-1">
                        <div class="form-group">
                            <label class="col-form-label" for="country">country :</label>
                            <input class="form-control" type="text" id="country" name="country"
                                   value="{{ old('country') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-5 d-inline-block">
                        <div class="form-group">
                            <label class="col-form-label" for="city">city :</label>
                            <input class="form-control" type="text" id="city" name="city"
                                   value="{{ old('city') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-10 offset-md-1">
                        <div class="form-group">
                            <label class="col-form-label" for="street">district :</label>
                            <input class="form-control" type="text" id="street" name="street"
                                   value="{{ old('street') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-5 d-inline-block offset-md-1">
                        <div class="form-group">
                            <label class="col-form-label" for="zip_code">zip code :</label>
                            <input class="form-control" type="text" id="zip_code" name="zip_code"
                                   value="{{ old('zip_code') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-5 d-inline-block">
                        <div class="form-group">
                            <label class="col-form-label" for="phone_number">phone number :</label>
                            <input class="form-control" type="text" id="phone_number" name="phone_number"
                                   value="{{ old('phone_number') }}">
                        </div>
                    </div>
                    <div class="col-12 mb-5">
                        <button type="submit" class="btn btn-secondary">Add Address</button>
                    </div>
                </div>
            </form>


        </div>

    </div>


@endsection

