@extends('layouts.panel')
@section('header')
    <title>panel-Purchase</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Transaction </h1>
            <h3>User :<b> {{ $purchase->user->email }}</b></h3>
        </div>
    </div>
        <div class="row no-gutters">
            <div class="col-12">
                <div class="row no-gutters">
                    <div class="col-12 col-md-3">
                        <label class="col-form-label" for="created_at"><b>Date created :</b> </label>
                    </div>
                    <div class="col-12 col-md-8">
                        {{ $purchase['created_at'] }}
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="col-form-label" for="created_at"><b>pay time :</b> </label>
                    </div>
                    <div class="col-12 col-md-8">
                        {{ $purchase['pay_time'] }}
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="col-form-label" for="created_at"><b>status :</b> </label>
                    </div>
                    <div class="col-12 col-md-8">
                        {{ $purchase['orderStatus'] }}
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="col-form-label" for="created_at"><b>total Price :</b> </label>
                    </div>
                    <div class="col-12 col-md-8">
                        {{ $purchase['total_price'] }}
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="col-form-label" for="created_at"><b>bank name :</b> </label>
                    </div>
                    <div class="col-12 col-md-8">
                        {{ $purchase['bank'] }}
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="col-form-label" for="created_at"><b>referral id :</b> </label>
                    </div>
                    <div class="col-12 col-md-8">
                        {{ $purchase['ref_id'] }}
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="col-form-label" for="created_at"><b>Address :</b> </label>
                    </div>
                    <div class="col-12 col-md-8">
                        {{ $address['country'] . "_".$address['city'] ."_". $address['street'] ."_"." zip code: ". $address['zip_code']."_" ."phoneNumber: ".$address['phone_number']}}
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="col-form-label" for="created_at"><b>user name :</b> </label>
                    </div>
                    <div class="col-12 col-md-8">
                        {{ $purchase->user['full_name']}}
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="col-form-label" for="created_at"><b>user mobile :</b> </label>
                    </div>
                    <div class="col-12 col-md-8">
                        {{ $purchase->user['mobile']}}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-md-offset-4">
                <a href="{{ route('purchase.index') }}" class="btn btn-info">return</a>
            </div>
        </div>

@endsection