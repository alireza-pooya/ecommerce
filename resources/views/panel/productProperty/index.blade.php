@extends('layouts.panel')
@section('header')
    <title>panel-Product-property</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-4">
            <h1>Product-Property</h1>
        </div>
        <div class="col-sm-12 col-md-4">
            <form action="">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="search...">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit" style="border-radius: 0 3px 3px 0"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="row justify-content-between">
        <div class="col-12 col-md-5 justify-content-lg-start">
            <form class="shadow-sm bg-light p-5" action="{{ route('product.property.store',['product'=>$product->slug]) }}" method="post">
                {{ csrf_field() }}
                <h3>Add properties to product</h3>
                <hr>
                <div class="form-group">
                    <label>select property :</label>
                    <select class="select2 form-control" tabindex="-1" name="property_id">
                        <option {{ (!old("property_id") ? "selected":"") }} value=""></option>
                        @foreach($properties as $property)
                            <option {{ (old("property_id") == $property['id'] ? "selected":"") }} value="{{ $property['id'] }}">{{ $property['name'] }}</option>
                        @endforeach
                    </select>
                    <span class="focus-border"></span>
                </div>
                <div class="form-group">
                    <div class="mt-5">
                        <label>Add Value to product</label>
                    </div>
                    <textarea class="form-control" name="value" id="value" cols="32" rows="5">{{ old('value') }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">add property to product</button>
                <a href="{{ route('product.index') }}" class="btn btn-info">return</a>
            </form>
        </div>
        <div class="col-12 col-md-5">
            <form action="{{ route('product.property.destroy', ['product' => $product->slug]) }}" method="post">
                {{ csrf_field() }}
                <table class="table border table-striped text-center">
                <h3>List Of properties</h3>
                <thead>
                <tr>
                    <td>#</td>
                    <td><b>property</b></td>
                    <td><b>value</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($product->properties as $property)
                    <tr>
                        <td class="a-center" id="icheck"><input type="checkbox" name="selected[]" value="{{ $property->id }}"></td>
                        <td>{{$property->name}}</td>
                        <td>{{$property->pivot->value}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-danger" onclick="confirm('are you sure to delete') ? submit() : false;">delete  <i class="fa fa-trash"></i></button>
            </form>
            {{ $properties->render() }}
        </div>
        <div class="col-12 col-md-4 offset-md-5 mt-5">
            <a href="{{ route('store.index',['product'=>$product->slug]) }}" class="btn btn-secondary btn-lg">Continue to store</a>

        </div>
    </div>

@endsection