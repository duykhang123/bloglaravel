@extends('frontend.layout')
@section('frontend-content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Checkout</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Checkout Step Area -->
    <div class="checkout_steps_area">
        <a class="complated" href="checkout-1.html"><i class="icofont-check-circled"></i> Login</a>
        <a class="active" href="checkout-2.html"><i class="icofont-check-circled"></i> Billing</a>
        <a href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
        <a href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
        <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
    </div>

    <!-- Checkout Area -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="checkout_details_area clearfix">
                        <h5 class="mb-4">Billing Details</h5>
                        <form action="{{ route('checkout1.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">Name</label>
                                    <input type="text" class="form-control" id="first_name" placeholder="First Name"
                                        value="{{ $user->name }}" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Full Name</label>
                                    <input type="text" class="form-control" id="last_name" placeholder="Last Name"
                                        value="{{ $user->fullname }}" name="fullname" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" class="form-control" id="email_address"
                                        placeholder="Email Address" name="email" value="{{ $user->email }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" class="form-control" name="phone" id="phone_number" min="0"
                                        value="{{ $user->phone }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" name="country" id="country" value="{{ $user->country }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="street_address">Street address</label>
                                    <input type="text" class="form-control" id="street_address"
                                        placeholder="Street Address" name="address" value="{{ $user->address }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="city">Town/City</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Town/City"
                                        value="{{ $user->city }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state" id="state" placeholder="State"
                                        value="{{ $user->state }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="postcode">Postcode/Zip</label>
                                    <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode / Zip"
                                        value="{{ $user->postcode }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="order-notes">Order Notes</label>
                                    <textarea class="form-control" id="order-notes" name="note" cols="30" rows="10"
                                        placeholder="Notes about your order, e.g. special notes for delivery.">{{ $user->note }}</textarea>
                                </div>
                            </div>

                            <!-- Different Shipping Address -->
                            <div class="different-address mt-50">
                                <div class="ship-different-title mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Ship to a same
                                            address?</label>
                                    </div>
                                </div>
                                <div class="row shipping_input_field">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">Name</label>
                                        <input type="text" class="form-control" id="sfirst_name"
                                            placeholder="First Name" name="sname" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">Full Name</label>
                                        <input type="text" class="form-control" id="slast_name"
                                            placeholder="Last Name" name="sfullname" value="{{ $user->fullname }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" class="form-control" id="semail_address"
                                            placeholder="Email Address" name="semail" value="{{ $user->email }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="number" class="form-control" name="sphone" id="sphone_number" min="0"
                                            value="{{ $user->phone }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" name="scountry" id="scountry"
                                            value="{{ $user->scountry }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="street_address">Street address</label>
                                        <input type="text" class="form-control" name="saddress" id="sstreet_address"
                                            placeholder="Street Address" value="{{ $user->saddress }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city">Town/City</label>
                                        <input type="text" class="form-control" name="scity" id="scity"
                                            placeholder="Town/City" value="{{ $user->scity }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control"  name="sstate" id="sstate" placeholder="State"
                                            value="{{ $user->sstate }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="postcode">Postcode/Zip</label>
                                        <input type="text" class="form-control" name="spostcode" id="spostcode"
                                            placeholder="Postcode / Zip" value="{{ $user->spostcode }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="order-notes">Order Notes</label>
                                        <textarea class="form-control" id="sorder-notes" name="note" cols="30" rows="10"
                                            placeholder="Notes about your order, e.g. special notes for delivery.">{{ $user->note }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="sub_total" value="{{\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal()}}">
                            <input type="hidden" name="total_amount" value="{{\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal()}}">
                            <div class="col-12">
                                <div class="checkout_pagination d-flex justify-content-end mt-50">
                                    <a href="{{route('cart.index')}}" class="btn btn-primary mt-2 ml-2">Go Back</a>
                                    <button type="submit" class="btn btn-primary mt-2 ml-2">Continue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Checkout Area -->
@endsection

@section('script')
    <script>
        $('#customCheck1').on('change', function(e) {
            e.preventDefault();
            if (this.checked) {
                $('#sfirst_name').val($('#first_name').val());
                $('#slast_name').val($('#last_name').val());
                $('#scountry').val($('#country').val());
                $('#semail_address').val($('#email_address').val());
                $('#sphone_number').val($('#phone_number').val());
                $('#sstreet_address').val($('#street_address').val());
                $('#scity').val($('#city').val());
                $('#sstate').val($('#state').val());
                $('#spostcode').val($('#postcode').val());
            } else {
                $('#sfirst_name').val('');
                $('#slast_name').val('');
                $('#scountry').val('');
                $('#semail_address').val('');
                $('#sphone_number').val('');
                $('#sstreet_address').val('');
                $('#scity').val('');
                $('#sstate').val('');
                $('#spostcode').val('');
            }
        })
    </script>
@endsection
