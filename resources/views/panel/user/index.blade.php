@extends('layouts.panel')
@section('header')
    <title>panel-User</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>User</h1>
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
    @if(count($users))
        <div class="row justify-content-between">
            <div class="col-12">
                <form action="{{ route('user.destroy', ['user' => 'destroy']) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <h3>List Of Users</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td><b>id</b></td>
                            <td><b>fullName</b></td>
                            <td><b>email</b></td>
                            <td><b>mobile</b></td>
                            <td><b>gender</b></td>
                            <td><b>created_at</b></td>
                            <td><b>setting</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="a-center" id="icheck"><input type="checkbox" name="selected[]" value="{{ $user['id'] }}"></td>
                                <td>{{$user->id}}</td>
                                <td>{{$user->full_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->mobile}}</td>
                                <td>{{$user['genderStatus']}}</td>
                                <td>{{$user->created_at}}</td>
                                <td><a href="{{route('user.edit',['user'=>$user->id])}}" class="btn btn-warning">Edit & more detail <i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{route('user.show',['user'=>$user->id])}}" class="btn btn-success">orders <i class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-danger" onclick="confirm('are you sure to delete') ? submit() : false;">Delete  <i class="fa fa-trash"></i></button>
                </form>
                {{ $users->render() }}
                @else
                    <h2>Nothing to show</h2>
                @endif
            </div>
        </div>

@endsection