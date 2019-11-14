@extends('layouts.panel')
@section('header')
    <title>panel-Comment</title>
@endsection
@section('content')
    <h1 class="mb-5 shadow-sm bg-light p-3">Edit Comment</h1>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="col-12">
        <table class="col-6 justify-content-start table noBorder">
            <tr>
                <td><label for="name" class="title">Rating: </label></td>
                <td><span id="name">
                        @for($i=0 ; $i < $comment->rating ; $i++)
                            <small class="d-inline-block" style="font-size: 30px; color: orange">&#9733; </small>
                        @endfor
                    </span></td>
            </tr>
            <tr>
                <td><label for="name" class="title">User Name: </label></td>
                <td><span id="name">{{ ( $comment->user->full_name ?  $comment->user->full_name : 'empty')  }}</span>
                </td>
            </tr>
            <tr>
                <td><label for="email" class="title">Product name: </label></td>
                <td><span id="email">{{ ($comment->product->name ? $comment->product->name : 'empty') }}</span></td>
            </tr>
            <tr>
                <td><label for="mobile" class="title">Title: </label></td>
                <td><span id="mobile">{{ ($comment->title ? $comment->title : "empty") }}</span></td>
            </tr>
        </table>
        <div>
            <label for="body" class="title">comment: </label>
        </div>
        <div>
            <span id="body">{{ ($comment->body ? $comment->body : "empty") }}</span>
        </div>
        <form action="{{route('comment.update',['comment'=>$comment->id])}}" class="pt-2" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-12  mt-5 mb-5">
                <div class="custom-control custom-radio custom-control-inline mr-5">
                    <input type="radio" id="approved1" name="approved" class="custom-control-input"
                           value="0"{{ ( $comment['approved']  == 0 ?  "checked" : '') }}>
                    <label class="custom-control-label" for="approved1"> <i class="fa fa-thumbs-down"></i> not approved
                    </label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="approved2" name="approved" class="custom-control-input"
                           value="1"{{ ( $comment['approved']  == 1 ?  "checked" : '') }}>
                    <label class="custom-control-label" for="approved2"> <i class="fa fa-thumbs-up"></i>
                        approved</label>
                </div>
            </div>
            <button type="submit" class="btn btn-warning">send response</button>
            <a href="{{route('comment.index')}}" class="btn btn-info">return</a>
        </form>
    </div>

@endsection