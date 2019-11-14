@extends('layouts.panel')
@section('header')
    <title>panel-Discount Code</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Create Discount Code</h1>
        </div>
        <div class="col-sm-12 col-md-4">
            <form action="">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="search...">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit" style="border-radius: 0 3px 3px 0"><i
                                    class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="row justify-content-start">
        <div class="col-12 col-md-6">
            <form action="{{ route('discount.store') }}" method="post">
                {{ csrf_field() }}
                <h3>New Discount Code</h3>
                <div class="form-group">
                    <label class="col-form-label" for="code">Code :</label>
                    <input class="form-control" type="text" id="code" name="code" value="{{ old('code') }}" placeholder="please enter your code">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="value">Value :</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="value" name="value" value="{{ old('value') }}" placeholder="please enter your value">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_date">Start From :</label>
                    <input type="text" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                </div>
                <div class="form-group">
                    <label for="expire_date">Expire Date :</label>
                    <input type="text" id="expire_date" name="expire_date" class="form-control" value="{{ old('expire_date') }}">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="number">Number of Discount :</label>
                    <input class="form-control" type="text" id="number" name="number" placeholder="please enter number of discount" value="{{ old('number') }}">
                </div>
                <button type="submit" class="btn btn-success">create</button>
                <a href="{{route('discount.index')}}" class="btn btn-info">return</a>

            </form>
        </div>
    </div>
@endsection


