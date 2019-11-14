@extends('layouts.homebase')
@section('content')
    <div class="container mt-5">
        <div class="mb-5 shadow-sm form-bg">
            <div class="row no-gutters justify-content-center mt-5">
                <div class="col-10 justify-content-center mb-5">
                    @include('layouts.messages')
                    @include('layouts.errors')
                    <div class="col-12 justify-content-center mb-5 mt-5 alert alert-success">
                        <form action="{{ route('returnBank') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="discount" value="{{ $discount_id }}">
                            <input type="hidden" name="order" value="{{ $order_id }}">
                            <h1 class="text-center p-5"><b>Bank Page</b></h1>
                            <div class="form-group text-center">
                                <div class="custom-control custom-radio custom-control-inline mb-2">
                                    <input type="radio" id="success" name="bank" checked class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="Success">Success</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mb-2">
                                    <input type="radio" id="failed" name="bank" class="custom-control-input" value="3">
                                    <label class="custom-control-label" for="failed">failed</label>
                                </div>
                            </div>
                            <button class="btn btn-info form-control mt-5">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection

