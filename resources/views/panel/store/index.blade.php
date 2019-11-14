@extends('layouts.panel')
@section('header')
    <title>panel-Store</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-4">
            <h1>Store</h1>
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
    <div class="row justify-content-between">
        <div class="col-12 col-md-5 justify-content-lg-start">
            <form class="shadow-sm bg-light p-5" action="{{ route('store.store',['product'=>$product->slug]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="mb-5">
                        <h3>Quantity & color & size</h3>
                        <hr>
                    </div>
                    <div class="row no-gutters justify-content-between">
                        <div class="col-12 col-md-4">
                            <label for="">Color : </label>
                            <select class="select2 form-control" tabindex="-1" name="color">
                                <option {{old("color") ? "selected" : ''}} value=""></option>
                                @foreach(config('color') as  $key => $color)
                                    <option value="{{$key}}"
                                            {{ Request()->color == $key ? 'selected' : ''}} style="background-color: {{ $color }}">{{ $key }}</option>
                                @endforeach
                            </select>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="size">Size :</label>
                            <input class="form-control" type="text" id="size" name="size"
                                   placeholder="Ex : 12 px _or_ 43 inch">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="quantity">quantity :</label>
                        <input class="form-control" type="text" id="quantity" name="quantity"
                               value="{{ old('quantity') }}"
                               placeholder="please enter quantity">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">submit</button>
            </form>
        </div>
        <div class="col-12 col-md-6">
            <table class="table border table-striped">
                <h3>{{ $product->name }} Stores</h3>
                <thead>
                <tr>
                    <td><b>color</b></td>
                    <td><b>size</b></td>
                    <td><b>quantity</b></td>
                    <td><b>delete</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($stores as $store)
                    <form action="{{ route('store.destroy',['store'=>$store->id]) }}" method="post">
                        {{ csrf_field() }}
                        <tr>
                            <td><span style="background-color: {{$store->color}} ; width: 100px;height: 25px;float: left"></span></td>
                            <td>{{$store->size}}</td>
                            <td>{{$store->quantity}}</td>
                            <td>
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
            {{ $stores->render() }}
        </div>
        <div class="col-12 col-md-4">
            <a href="{{ route('product.index') }}" class="btn btn-info">back to product list</a>
        </div>
    </div>

@endsection