@extends('layouts.homebase')
@section('content')
    <div class="container mt-5">
        <div class="mb-5 shadow-sm form-bg">
            <div class="row no-gutters justify-content-center mt-5">
                <div class="col-10 justify-content-center mb-5">
                    @include('layouts.messages')
                    @include('layouts.errors')
                    @if($bank == 1)
                    <div class="col-12 justify-content-center mb-5 mt-5 alert alert-success">
                        <h1 class="text-center p-5"><b>your payment was successfully</b></h1>
                    </div>
                        @else
                        <div class="col-12 justify-content-center mb-5 mt-5 alert alert-danger">
                            <h1 class="text-center p-5"><b>your payment was unsuccessful</b></h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection

