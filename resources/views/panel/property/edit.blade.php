@extends('layouts.panel')
@section('header')
    <title>Brand-panel</title>
@endsection
@section('content')
    <h1 class="mb-5 shadow-sm bg-light p-3">Edit Property</h1>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="col-12 col-md-4 justify-content-lg-start">
        <form action="{{route('property.update',['property'=>$property->id])}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="name">Property name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $property->name }}">
            </div>
            <button type="submit" class="btn btn-warning">edit</button>
            <a href="{{route('property.index')}}" class="btn btn-info">return</a>
        </form>
    </div>
@endsection