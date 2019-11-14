@extends('layouts.homebase')
@section('content')
    <div class="container mt-5">
        <div class="mb-5 shadow-lg form-bg">
            <h1 class="text-center pt-5"><b>Last Orders</b></h1>

            @include('layouts.messages')
            @include('layouts.errors')
            <div class="row no-gutters justify-content-center mt-5">
                <div class="col-10 justify-content-center img" >
                    <hr>
                    @if( count($orders))
                        <table class="table table-striped">
                            <tr class="bg-info">
                                <td><b>Product Name</b></td>
                                <td><b>Brand</b></td>
                                <td><b>Number</b></td>
                                <td><b>Price</b></td>
                                <td><b>Order Date</b></td>
                            </tr>
                            @foreach($orders as $order)
                                    <tr>
                                        <td><b>{{ $order->product->name }}</b></td>
                                        <td>{{ $order->product->brand->name }}</td>
                                        <td>{{ $order->number }}</td>
                                        <td><b>{{ $order->price }}</b> </td>
                                        <td>${{  $order->created_at}}</td>
                                    </tr>
                            @endforeach
                        </table>
                        <a href="{{ route('dashboard.index') }}" class="btn btn-info mb-5">return</a>
                    @else
                        <h1 class="text-center mt-5" style="margin-bottom: 10%">Your Order List is empty</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
