@extends('layouts.panel')
@section('header')
    <title>panel-Discount Code</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Discount Code</h1>
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
    @if(count($discounts))
        <div class="row justify-content-between">
            <div class="col-12">
                <form action="{{ route('product.property.destroy', ['discount' => 'destroy']) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <h3>List Of Brands</h3>
                    <table class="table border table-striped">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td><b>Code</b></td>
                            <td><b>value</b></td>
                            <td><b>start date</b></td>
                            <td><b>expire date</b></td>
                            <td><b>number</b></td>
                            <td><b>setting</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($discounts as $discount)
                            <tr>
                                <td class="a-center" id="icheck"><input type="checkbox" name="selected[]" value="{{ $discount['id'] }}"></td>
                                <td>{{$discount->code}}</td>
                                <td>{{$discount->value}}</td>
                                <td>{{$discount->start_date}}</td>
                                <td>{{$discount->expire_date}}</td>
                                <td>{{$discount->number}}</td>
                                <td><a href="{{route('discount.edit',['discount'=>$discount->id])}}" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-danger" onclick="confirm('are you sure to delete') ? submit() : false;">delete  <i class="fa fa-trash"></i></button>
                </form>
                {{ $discounts->render() }}
                @else
                    <h2>Nothing to show</h2>
                @endif
            </div>
        </div>

@endsection