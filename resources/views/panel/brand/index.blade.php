@extends('layouts.panel')
@section('header')
    <title>panel-Brand</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-4">
            <h1>Brand</h1>
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

            <form class="shadow-sm bg-light p-5" action="{{route('brand.store')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="mb-5">
                        <h3>Add New Brand</h3>
                        <hr>
                    </div>

                    <label for="name">brand name :</label>
                    <input type="text" id="name" name="name" placeholder="please enter your new brand" class="form-control" value="{{ old('name') }}">
                </div>
                <button type="submit" class="btn btn-success">submit</button>
            </form>
        </div>
        <div class="col-12 col-md-4">
            <h3>List Of Brands</h3>
            <table class="table border table-striped">
                <thead>
                <tr>
                    <td>#</td>
                    <td><b>name</b></td>
                    <td><b>setting</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($brands as $brand)
                    <tr>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->name}}</td>
                        <td><a href="{{route('brand.edit',['brand'=>$brand->id])}}" class="btn btn-warning">edit  <i class="fa fa-pencil-square-o"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $brands->render() }}
        </div>

    </div>

@endsection