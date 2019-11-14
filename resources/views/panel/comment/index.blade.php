@extends('layouts.panel')
@section('header')
    <title>panel-Comment</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Comments</h1>
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
    @if(count($comments))
        <div class="row justify-content-between">
            <div class="col-12">
                    <h3>List Of Brands</h3>
                    <table class="table border table-striped">
                        <thead>
                        <tr>
                            <td><b>name</b></td>
                            <td><b>product name</b></td>
                            <td><b>title</b></td>
                            <td><b>comment</b></td>
                            <td><b>date</b></td>
                            <td><b>setting</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$comment->user->full_name}}</td>
                                <td>{{$comment->product->name}}</td>
                                <td>{{$comment->title}}</td>
                                <td>{{\Illuminate\Support\Str::limit($comment['body'],30) }}</td>
                                <td>{{$comment->created_at}}</td>
                                <td><a href="{{route('comment.edit',['comment'=>$comment->id])}}" class="@if($comment->approved == 0) btn btn-warning @else btn btn-success @endif">@if($comment->approved == 0) waiting to approved <i class="fa fa-thumbs-down"> @else Approved <i class="fa fa-thumbs-up">@endif </i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                {{ $comments->render() }}
                @else
                    <h2>Nothing to show</h2>
                @endif
            </div>
        </div>

@endsection