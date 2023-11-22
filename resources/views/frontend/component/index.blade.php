@extends('frontend.layout')
@section('frontend-content')
    <!-- Welcome Slides Area -->
    @include('frontend.component.banner')
    <!-- Welcome Slides Area -->

    <!-- Top Catagory Area -->
    @include('frontend.component.top_category')
    <!-- Top Catagory Area -->



    <!-- New Arrivals Area -->
    @include('frontend.pages.index-product')
    <!-- New Arrivals Area -->

    <!-- Featured Products Area -->
    @include('frontend.pages.special-product')
    <!-- Featured Products Area -->

    <!-- Best Rated/Onsale/Top Sale Product Area -->
    <section class="best_rated_onsale_top_sellares section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tabs_area">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="product-tab">
                            <li class="nav-item">
                                <a href="#top-sellers" class="nav-link active" data-toggle="tab" role="tab">Top
                                    Sellers</a>
                            </li>
                            <li class="nav-item">
                                <a href="#best-rated" class="nav-link" data-toggle="tab" role="tab">Best
                                    Rated</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            @include('frontend.pages.top-sellers')

                            @include('frontend.pages.top-rated')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Best Rated/Onsale/Top Sale Product Area -->

    <!-- Offer Area -->
    <section class="offer_area">
        <div class="container">
            <div class="row">
                <!-- Beach Offer -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="beach_offer_area mb-4 mb-md-0">
                        <img src="{{ asset('frontend/img/product-img/beach.png') }}" alt="beach-offer">
                        <div class="beach_offer_info">
                            <p>Upto 70% OFF</p>
                            <h3>Beach Item</h3>
                            <a href="#" class="btn btn-primary btn-sm mt-15">SHOP NOW</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Apparels Offer -->
                    <div class="apparels_offer_area">
                        <img src="{{ asset('frontend/img/product-img/apparels.jpg') }}" alt="Beach-Offer">
                        <div class="apparels_offer_info d-flex align-items-center">
                            <div class="apparels-offer-content">
                                <h4>Apparel &amp; <br><span>Garments</span></h4>
                                <a href="#" class="btn">Buy Now <i class="icofont-rounded-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Deals of the Week -->
                    <div class="weekly_deals_area mt-30">
                        <img src="{{ asset('frontend/img/product-img/weekly-offer.jpg') }}" alt="weekly-deals">
                        <div class="weekly_deals_info">
                            <h4>Deals of the Week</h4>
                            <div class="deals_timer">
                                <ul data-countdown="2021/02/14 14:21:38">
                                    <!-- Please use event time this format: YYYY/MM/DD hh:mm:ss -->
                                    <li><span class="days">00</span>days</li>
                                    <li><span class="hours">00</span>hours</li>
                                    <li class="d-block blank-timer"></li>
                                    <li><span class="minutes">00</span>min</li>
                                    <li><span class="seconds">00</span>sec</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Elect Offer -->
                            <div class="elect_offer_area mt-30 mt-lg-0">
                                <img src="{{ asset('frontend/img/product-img/elect.jpg') }}" alt="Elect-Offer">
                                <div class="elect_offer_info d-flex align-items-center">
                                    <div class="elect-offer-content">
                                        <h4>Electronics</h4>
                                        <a href="#" class="btn">Buy Now <i class="icofont-rounded-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Backpack Offer -->
                            <div class="backpack_offer_area mt-30">
                                <img src="{{ asset('frontend/img/product-img/backpack.jpg') }}" alt="Backpack-Offer">
                                <div class="backpack_offer_info">
                                    <h4>Backpacks</h4>
                                    <a href="#" class="btn">Buy Now <i class="icofont-rounded-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Offer Area End -->

    <!-- Popular Brands Area -->
    <section class="popular_brands_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular_section_heading mb-50">
                        <h5>Popular Brands</h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="popular_brands_slide owl-carousel">
                        @if (!empty($banner_slider))
                            @foreach ($banner_slider as $key => $item)
                                <div class="single_brands">
                                    <img src="{{$item->getImage()}}" alt="">
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Popular Brands Area -->

    <!-- Special Featured Area -->
    <section class="special_feature_area pt-5">
        <div class="container">
            <div class="row">
                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-ship"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Free Shipping</h6>
                            <p>For orders above $100</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-box"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Happy Returns</h6>
                            <p>7 Days free Returns</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-money"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>100% Money Back</h6>
                            <p>If product is damaged</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-live-support"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Dedicated Support</h6>
                            <p>We provide support 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Special Featured Area -->
@endsection
