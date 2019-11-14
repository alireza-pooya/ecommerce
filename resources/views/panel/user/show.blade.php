@extends('layouts.panel')
@section('header')
    <title>order Items</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Transactions</h1>
        </div>
    </div>
    @include('layouts.messages')
    @if(count($orderItems))
        <div class="row justify-content-between">
            <div class="col-12">
                <table class="table border table-striped">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td><b>Product</b></td>
                        <td><b>color</b></td>
                        <td><b>size</b></td>
                        <td><b>number</b></td>
                        <td><b>price</b></td>
                        <td><b>date</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderItems as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->color }}</td>
                            <td>{{ $order->size }}</td>
                            <td>{{ $order->number }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <h2>Nothing to show</h2>
                @endif
            </div>
        </div>

@endsection