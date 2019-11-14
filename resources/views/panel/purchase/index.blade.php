@extends('layouts.panel')
@section('header')
    <title>panel-Purchase</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Transactions</h1>
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
    @if(count($purchases))
        <div class="row justify-content-between">
            <div class="col-12">
                        <span class="pull-left">
                            <a {{ Request::fullUrlIs(url('*order')) ? 'class=active-index' : '' }} href="{{ route('purchase.index') }}">All</a> -
                            <a {{ Request::fullUrlIs(url('*status=1*')) ? 'class=active-index' : '' }} href="{{ Request::fullUrlWithQuery(['status'=>1]) }}">Success</a> -
                            <a {{ Request::fullUrlIs(url('*status=2*')) ? 'class=active-index' : '' }} href="{{ Request::fullUrlWithQuery(['status'=>2]) }}">Pending</a> -
                            <a {{ Request::fullUrlIs(url('*status=3*')) ? 'class=active-index' : '' }} href="{{ Request::fullUrlWithQuery(['status'=>3]) }}">canceled</a>
                        </span>
                <table class="table border table-striped">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td><b>User Email</b></td>
                            <td><b>Discount Code</b></td>
                            <td><b>Pay Time</b></td>
                            <td><b>Total Price</b></td>
                            <td><b>Status</b></td>
                            <td><b>Bank Name</b></td>
                            <td><b>Referral ID</b></td>
                            <td><b>More</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->id }}</td>
                                <td>{{ $purchase->user['email'] }}</td>
                                <td>{{ $purchase->discount['code'] }}</td>
                                <td>{{ $purchase->pay_time }}</td>
                                <td>{{ $purchase->total_price }}</td>
                                <td>{{ $purchase->orderStatus }}</td>
                                <td>{{ $purchase->bank }}</td>
                                <td>{{ $purchase->ref_id }}</td>
                                <td><a href="{{route('purchase.show',['purchase'=>$purchase->id])}}" class="btn btn-warning">show <i class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                {{ $purchases->render() }}
                @else
                    <h2>Nothing to show</h2>
                @endif
            </div>
        </div>

@endsection