@extends('frontend.layout')
@section('frontend-content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Account</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <!-- My Account Area -->
    <section class="my-account-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="my-account-navigation mb-50">
                        @include('frontend.user.account-menu')
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <p>The following addresses will be used on the checkout page by default.</p>

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                <h6 class="mb-3">Billing Address</h6>
                                <address>
                                    {{ $user->country }} <br>
                                    {{ $user->city }} <br>
                                    {{ $user->state }} <br>
                                    {{ $user->address }} <br>
                                    {{ $user->postcode }}
                                </address>
                                <a href="#" data-toggle="modal" data-target="#editAddress"
                                    class="btn btn-primary btn-sm">Edit Address</a>
                                <!-- Modal -->
                                <div class="modal fade" id="editAddress" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('user.editAddresses') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input name="address" type="text" class="form-control"
                                                            id="address" value="{{ $user->address }}" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country">Country</label>
                                                        <input name="country" type="text" class="form-control"
                                                            id="country" value="{{ $user->country }}" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input name="city" type="text" class="form-control"
                                                            id="city" value="{{ $user->city }}" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="postcode">Postcode</label>
                                                        <input name="postcode" type="number" class="form-control"
                                                            id="postcode" value="{{ $user->postcode }}" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="state">State</label>
                                                        <input name="state" type="text" class="form-control"
                                                            id="state" value="{{ $user->state }}" required="">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h6 class="mb-3">Shipping Address</h6>
                                <address>
                                    {{ $user->scountry }} <br>
                                    {{ $user->scity }} <br>
                                    {{ $user->sstate }} <br>
                                    {{ $user->saddress }} <br>
                                    {{ $user->spostcode }}
                                </address>
                                <a href="#" data-toggle="modal" data-target="#editShippingAddress"
                                    class="btn btn-primary btn-sm">Edit Shipping Address</a>
                                <div class="modal fade" id="editShippingAddress" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('user.editShippingAddresses') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="saddress">Shipping Address</label>
                                                        <input name="saddress" type="text" class="form-control"
                                                            id="saddress" value="{{ $user->saddress }}" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="scountry">Shipping Country</label>
                                                        <input name="scountry" type="text" class="form-control"
                                                            id="scountry" value="{{ $user->scountry }}" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="scity">Shipping City</label>
                                                        <input name="scity" type="text" class="form-control"
                                                            id="scity" value="{{ $user->scity }}" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="spostcode">Shipping Postcode</label>
                                                        <input name="spostcode" type="number" class="form-control"
                                                            id="spostcode" value="{{ $user->spostcode }}"
                                                            required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sstate">Shipping State</label>
                                                        <input name="sstate" type="text" class="form-control"
                                                            id="sstate" value="{{ $user->sstate }}" required="">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->
@endsection
