@extends('layouts.homebase')
@section('content')
    <div class="container mt-5">
        <div class="mb-5 shadow-sm form-bg">
            <h1 class="text-center pt-5"><b>Shopping Cart</b></h1>
            <div class="row no-gutters justify-content-center mt-5">
                <div class="col-10 justify-content-center mb-5">
                    <hr>
                    @include('layouts.messages')
                    @include('layouts.errors')
                    @if(count($stores))
                        <table class="table table-striped">
                            <tr class="bg-info">
                                <td><b>Product Name</b></td>
                                <td><b>Color</b></td>
                                <td><b>Number</b></td>
                                <td><b>Size</b></td>
                                <td><b>price</b></td>
                                <td><b>Entire Price</b></td>
                                <td><b>Delete</b></td>
                            </tr>
                            @foreach($stores as $store)
                                <form action="{{ route('cart.destroy',['store'=>$store->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    <tr>
                                        <td><b>{{ $store->product->name }}</b></td>
                                        <td>{{ $store->color }}</td>
                                        <td>{{ $store->qt }}</td>
                                        <td>{{ $store->size }}</td>
                                        <td class="text-wrap"><s>${{ $store->product->old_price }}</s><b>{{ $store->product->new_price }}</b></td>
                                        <td>${{  $store->totalEachProduct}}</td>
                                        <td><button class="btn btn-link"><span class="fa fa-trash"></span></button></td>
                                    </tr>
                                </form>
                            @endforeach
                            <form action="{{ route('checkout') }}" method="post">
                                {{ csrf_field() }}
                                <tr class="bg-info">
                                    <td><input class="form-control" type="text" name="discountCode" id="discountCode"
                                               placeholder="Discount Code"></td>
                                    <input type="hidden" id="totalPrice" value="{{ $totalPrice }}">
                                    <td><span onclick="discount()" class="btn btn-info" style="cursor: pointer"><b>Apply Code</b></span>
                                    </td>
                                    <td colspan="3" class="text-right"><b style="font-size: 25px">Total Price :</b></td>
                                    <td colspan="2" id="total" style="line-height: 2.5"><b>${{ $totalPrice }}</b></td>
                                </tr>
                                <tr>
                                    <td colspan="6" bgcolor="aliceblue"><h3 style="color: #0c5460"><b id="result"></b>
                                        </h3></td>
                                </tr>
                                <tr>
                                    <td colspan="6" bgcolor="aliceblue">
                                        <button class="btn btn-success">Proceed To Checkout</button>
                                    </td>
                                </tr>
                            </form>
                        </table>
                </div>
                @else
                    <h1 class="text-center mt-5" style="color: blue">Your cart is empty</h1>
                @endif
            </div>
        </div>
    </div>
    </div>
    <div class="clearfix"></div>
@endsection
@section('footer')
    <script>
        $(document).ready(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            discount = function () {
                var discountCode = $('#discountCode').val();
                var totalPrice = $('#totalPrice').val();
                $.ajax({
                    'url': '{{ route('calculate') }}',
                    'type': 'POST',
                    'data': {discountCode: discountCode},
                    success: function (response) { // What to do if we succeed
                        let percentage = response.data.percentage;
                        let FinalPrice = totalPrice;
                        if (percentage > 0) {
                            FinalPrice = totalPrice.replace(",", "");
                            FinalPrice = FinalPrice - ((percentage / 100) * FinalPrice);
                            $('#result').text('Your Code Applied');
                        } else {
                            $('#result').text('Your Code Not Valid');
                        }
                        $('#total').text("$" + FinalPrice);
                    },
                });
            }
        });
    </script>

@endsection
