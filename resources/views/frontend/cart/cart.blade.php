@extends('frontend.layout')
@section('frontend-content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Cart</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Cart Area -->
    <div class="cart_area section_padding_100_70 clearfix">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12">
                    <div class="cart-table">
                        <div class="table-responsive" id="cart_list">
                            @include('frontend.component._cart_item')
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="cart-apply-coupon mb-30">
                        <h6>Have a Coupon?</h6>
                        <p>Enter your coupon code here &amp; get awesome discounts!</p>
                        <!-- Form -->
                        <div class="coupon-form">
                            <form action="{{ route('coupon.add') }}" id="coupon-form" method="POST">
                                @csrf
                                <input type="text" name="code" class="form-control"
                                    placeholder="Enter Your Coupon Code">
                                <button type="submit" class="coupon-btn btn btn-primary">Apply Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="cart-total-area mb-30">
                        <h5 class="mb-3">Cart Totals</h5>
                        <div class="table-responsive">
                            <table class="table mb-3">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>${{ Cart::subtotal() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Save Amount</td>
                                        @if (session()->has('coupon'))
                                            <td>${{ session()->get('coupon')['sub'] }}</td>
                                        @else
                                            <td>0</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        @if (session()->has('coupon'))
                                            <td>${{number_format((float) str_replace(',','',Cart::subtotal())-session()->get('coupon')['value'],2)}}</td>
                                        @else
                                            <td>${{ Cart::subtotal() }}</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('checkout1') }}" class="btn btn-primary d-block">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->
@endsection

@section('script')
    <script>
        $(document).on('click', '.delete_to_cart', function(e) {
            e.preventDefault();
            var cart_id = $(this).data('cart-id');

            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.delete') }}";
            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    cart_id: cart_id,
                    _token: token,
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);

                        Swal.fire({
                            title: "Ok!",
                            text: data['message'],
                            icon: "success"
                        });
                    }

                }
            })
        })
    </script>

    <script>
        $(document).on('click', '.qty-text', function(e) {
            var id = $(this).data('id');

            var spinner = $(this),
                input = spinner.closest("div.quantity").find('input[type="number"]');

            if (input.val() == 1) {
                return false
            }
            if (input.val() != 1) {
                var newVal = parseFloat(input.val());
                $('#qty-input-' + id).val(newVal);
            }
            var productQuantity = $("#update-cart-" + id).data('product-quantity');
            update_cart(id, productQuantity)
        });

        function update_cart(id, productQuantity) {
            var rowId = id;
            var product_qty = $("#qty-input-" + rowId).val();
            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.update') }}";
            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    product_qty: product_qty,
                    rowId: rowId,
                    productQuantity: productQuantity,
                    _token: token,
                },
                success: function(data) {
                    $('body #header-ajax').html(data['header']);
                    $('body #cart_list').html(data['cart_list']);
                    Swal.fire({
                        title: "Ok!",
                        text: data['message'],
                        icon: "success"
                    });
                }
            })
        }
    </script>

    <script>
        $(document).on('click', '.coupon-btn', function(e) {
            e.preventDefault();
            var code = $('input[name=code]').val();
            var token = "{{ csrf_token() }}";
            var path = "{{ route('coupon.add') }}";
            $('#coupon-form').submit();
            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    code: code,
                    _token: token,
                },
                beforeSend: function() {
                    $('.coupon-btn').html(
                        '<i class="fa fa-spinner fa-spin"></i> Loading.....');
                },
                success: function(data) {
                    console.log(data)

                }
            })
        })
    </script>
@endsection
