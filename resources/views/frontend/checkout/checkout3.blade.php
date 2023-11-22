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

    <div class="checkout_steps_area">
        <a class="complated" href="checkout-1.html"><i class="icofont-check-circled"></i> Login</a>
        <a class="complated" href="checkout-2.html"><i class="icofont-check-circled"></i> Billing</a>
        <a class="complated" href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
        <a class="active" href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
        <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
    </div>

    <!-- Checkout Area -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <form action="{{route('checkout3.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="checkout_details_area clearfix">
                            <div class="payment_method">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                    <!-- Single Payment Method -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="five">
                                            <h6 class="panel-title">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="payment_method" value="cod" class="custom-control-input" id="customCheck2">
                                                    <label class="custom-control-label" for="customCheck2"><i
                                                            class="icofont-cash-on-delivery-alt"></i>
                                                        Cash on Delivery</label>
                                                </div>
                                            </h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="checkout_pagination d-flex justify-content-end mt-30">
                            <a href="{{route('checkout2.store')}}" class="btn btn-primary mt-2 ml-2">Go Back</a>
                            <button type="submit" class="btn btn-primary mt-2 ml-2">Final Step</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Checkout Area End -->
@endsection
