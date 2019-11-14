@extends('layouts.panel')
@section('header')
    <title>panel-Edit Discount Code</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Edit Discount Code</h1>
        </div>
    </div>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="row justify-content-start">
        <div class="col-12 col-md-6">
            <form action="{{ route('discount.update',['discount'=>$discount->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <h3>Edit</h3>
                <div class="form-group">
                    <label class="col-form-label" for="code">Code :</label>
                    <input class="form-control" type="text" id="code" name="code" value="{{ $discount['code'] }}">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="value">Value :</label>
                    <input class="form-control" type="text" id="value" name="value" value="{{ $discount['value'] }}">
                </div>
                <div class="form-group">
                    <label for="start_date">Start From :</label>
                    <input type="text" id="start_date" name="start_date" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="expire_date">Expire Date :</label>
                    <input type="text" id="expire_date" name="expire_date" class="form-control" value="{{ $discount['expire_date'] }}">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="number">Number of Discount :</label>
                    <input class="form-control" type="text" id="number" name="number" placeholder="please enter number of discount" value="{{ $discount['number'] }}">
                </div>
                <button type="submit" class="btn btn-warning">edit</button>
                <a href="{{route('discount.index')}}" class="btn btn-info">return</a>
            </form>
        </div>
    </div>


@endsection
