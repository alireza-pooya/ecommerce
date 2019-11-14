@extends('layouts.panel')
@section('header')
    <title>panel-Product</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Product</h1>
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
    @if(count($products))
        <div class="row justify-content-between">
            <div class="col-12">
                 <span class="pull-left">
                            <a {{ Request::fullUrlIs(url('*order')) ? 'class=active-index' : '' }} href="{{ route('product.index') }}">All</a> -
                            <a {{ Request::fullUrlIs(url('*status=1*')) ? 'class=active-index' : '' }} href="{{ Request::fullUrlWithQuery(['status'=>1]) }}">published</a> -
                            <a {{ Request::fullUrlIs(url('*status=2*')) ? 'class=active-index' : '' }} href="{{ Request::fullUrlWithQuery(['status'=>2]) }}">draft</a>
                </span>
                <table class="table border table-striped">
                    <thead>
                    <tr>
                        <td><b>name</b></td>
                        <td><b>brand</b></td>
                        <td><b>status</b></td>
                        <td><b>old price</b></td>
                        <td><b>new price</b></td>
                        <td><b>description</b></td>
                        <td><b>image</b></td>
                        <td><b>setting</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->brand->name}}</td>
                            <td>{{$product['productStatus']}}</td>
                            <td>{{$product->old_price}}</td>
                            <td>{{$product->new_price}}</td>
                            <td>{{\Illuminate\Support\Str::limit($product['description'],20) }}</td>
                            <td><img src="{{ url( $product->img ) }}" style="height: 100px ; width: 100px;" alt=""></td>
                            <td>
                                <a href="{{ route('product.edit',['product'=>$product->slug]) }}"
                                   class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a>
                                <a href="{{ route('product.property.index',['product'=>$product->slug]) }}"
                                   class="btn btn-success">Properties <i class="fa fa-wrench"></i></a>
                                <a href="{{ route('store.index',['product'=>$product->slug]) }}" class="btn btn-info">store
                                    <i class="fa fa-cogs"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $products->render() }}
                @else
                    <h2>Nothing to show</h2>
                @endif
            </div>
        </div>
@endsection