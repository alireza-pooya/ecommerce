@extends('home.dashboard')
@section('body')

    <div class="container mt-5 ">
        <div class="col-12 text-center"><h3>Edit Address</h3></div>
        <form action="{{ route('address.update',['address'=>$address->id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="row  shadow form-bg mt-3 p-4">
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="country"><b>country :</b></label>
                        <input class="form-control" type="text" id="country" name="country"
                               value="{{ $address['country'] }}">
                    </div>
                </div>
                <div class="col-12  col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="city"><b>city :</b></label>
                        <input class="form-control" type="text" id="city" name="city"
                               value="{{ $address['city'] }}">
                    </div>
                </div>
                <div class="col-12  col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="street"><b>district :</b></label>
                        <input class="form-control" type="text" id="street" name="street"
                               value="{{ $address['street'] }}">
                    </div>
                </div>
                <div class="col-12  col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="zip_code"><b>zip code :</b></label>
                        <input class="form-control" type="text" id="zip_code" name="zip_code"
                               value="{{ $address['zip_code'] }}">
                    </div>
                </div>
                <div class="col-12  col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="phone_number"><b>phone number :</b></label>
                        <input class="form-control" type="text" id="phone_number" name="phone_number"
                               value="{{ $address['phone_number'] }}">
                    </div>
                </div>
                <div class="col-12 col-md-6 offset-md-6 mt-2">
                    <button class="btn btn-success">save changes</button>
                    <a href="{{ route('address.index') }}" class="btn btn-info">Cancel</a>
                </div>
            </div>
        </form>
    </div>

@endsection

