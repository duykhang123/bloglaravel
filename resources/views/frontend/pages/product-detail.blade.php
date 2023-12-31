@extends('frontend.layout')
@section('frontend-content')
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Product Details</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcumb Area -->
    <!-- Single Product Details Area -->
    <section class="single_product_details_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                            <!-- Carousel Inner -->
                            <div class="carousel-inner">
                                @if (isset($products->gallary))
                                    @php
                                        $gallary = unserialize($products->gallary);
                                    @endphp
                                    @foreach ($gallary as $key => $img)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <a class="gallery_img" href="{{ asset('admin/img/product/' . $img) }}"
                                                title="First Slide">
                                                <img class="d-block w-100" src="{{ asset('admin/img/product/' . $img) }}"
                                                    alt="First slide">
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="{{ $products->getImage() }}" title="First Slide">
                                            <img class="d-block w-100" src="{{ $products->getImage() }}" alt="First slide">
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Carosel Indicators -->
                            <ol class="carousel-indicators">
                                @if (isset($products->gallary))
                                    @php
                                        $gallary = unserialize($products->gallary);
                                    @endphp
                                    @foreach ($gallary as $key => $img)
                                        <li class="{{ $key == 0 ? 'active' : '' }}" data-target="#product_details_slider"
                                            data-slide-to="{{ $key }}"
                                            style="background-image: url({{ asset('admin/img/product/thumb/' . $img) }});">
                                        </li>
                                    @endforeach
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Single Product Description -->
                <div class="col-12 col-lg-6">
                    <div class="single_product_desc">
                        <h4 class="title mb-2">{{ $products->name }}</h4>
                        <div class="single_product_ratings mb-2">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="text-muted">(8 Reviews)</span>
                        </div>
                        <h4 class="price mb-4">${{ $products->price }} <span>$190</span></h4>

                        <!-- Overview -->
                        <div class="short_overview mb-4">
                            <h6>Overview</h6>
                            <p>{{ $products->description }}</p>
                        </div>

                        <!-- Color Option -->
                        {{-- <div class="widget p-0 color mb-3">
                            <h6 class="widget-title">Color</h6>
                            <div class="widget-desc d-flex">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label black" for="customRadio1"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label pink" for="customRadio2"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label red" for="customRadio3"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label purple" for="customRadio4"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label white" for="customRadio5"></label>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Size Option -->
                        <div class="widget p-0 size mb-3">
                            <h6 class="widget-title">Size</h6>
                            <div class="widget-desc" style="display: block">
                                @php
                                    $product_attr = \App\Models\ProductAttribute::where('product_id', $products->id)->get();
                                @endphp
                                <select name="size" id="">
                                    @foreach ($product_attr as $size)
                                        <option value="{{ $size->size }}">{{ $size->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Add to Cart Form -->
                        <form class="cart clearfix my-5 d-flex flex-wrap align-items-center" method="post">
                            <div class="quantity">
                                <input type="number" class="qty-text form-control" id="qty2" step="1"
                                    min="1" max="12" name="quantity" value="1">
                            </div>
                            <button type="submit" name="addtocart" value="5"
                                class="btn btn-primary mt-1 mt-md-0 ml-1 ml-md-3">Add to cart</button>
                        </form>

                        <!-- Others Info -->
                        <div class="others_info_area mb-3 d-flex flex-wrap">
                            <a class="add_to_wishlist" href="wishlist.html"><i class="fa fa-heart" aria-hidden="true"></i>
                                WISHLIST</a>
                            <a class="add_to_compare" href="compare.html"><i class="fa fa-th" aria-hidden="true"></i>
                                COMPARE</a>
                            <a class="share_with_friend" href="#"><i class="fa fa-share" aria-hidden="true"></i>
                                SHARE WITH FRIEND</a>
                        </div>

                        <!-- Size Guide -->
                        <div class="sizeguide">
                            <h6>Size Guide</h6>
                            <div class="size_guide_thumb d-flex">
                                <a class="size_guide_img" href="img/bg-img/size-1.png"
                                    style="background-image: url(img/bg-img/size-1.png);">
                                </a>
                                <a class="size_guide_img" href="img/bg-img/size-2.png"
                                    style="background-image: url(img/bg-img/size-2.png);">
                                </a>
                                <a class="size_guide_img" href="img/bg-img/size-3.png"
                                    style="background-image: url(img/bg-img/size-3.png);">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_details_tab section_padding_100_0 clearfix">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="product-details-tab">
                            <li class="nav-item">
                                <a href="#description" class="nav-link active" data-toggle="tab"
                                    role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a href="#reviews" class="nav-link" data-toggle="tab" role="tab">Reviews <span
                                        class="text-muted">({{ \App\Models\ProductReviewModel::where('product_id', $products->id)->count() }})</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#addi-info" class="nav-link" data-toggle="tab" role="tab">Additional
                                    Information</a>
                            </li>
                            <li class="nav-item">
                                <a href="#refund" class="nav-link" data-toggle="tab" role="tab">Return &amp;
                                    Cancellation</a>
                            </li>
                        </ul>
                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="description">
                                <div class="description_area">
                                    {!! $products->description !!}
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="reviews">
                                <div class="submit_a_review_area mt-50">
                                    <h4>Submit A Review</h4>
                                    @auth
                                        <form action="{{ route('product.review', $products->slug) }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <span>Your Ratings</span>
                                                <div class="stars">
                                                    <input type="radio" name="form[rate]" class="star-1" value="1"
                                                        id="star-1">
                                                    <label class="star-1" for="star-1">1</label>
                                                    <input type="radio" name="form[rate]" class="star-2" value="2"
                                                        id="star-2">
                                                    <label class="star-2" for="star-2">2</label>
                                                    <input type="radio" name="form[rate]" class="star-3" value="3"
                                                        id="star-3">
                                                    <label class="star-3" for="star-3">3</label>
                                                    <input type="radio" name="form[rate]" class="star-4" value="4"
                                                        id="star-4">
                                                    <label class="star-4" for="star-4">4</label>
                                                    <input type="radio" name="form[rate]" class="star-5" value="5"
                                                        id="star-5">
                                                    <label class="star-5" for="star-5">5</label>
                                                    <span></span>
                                                </div>
                                            </div>
                                            @error('rate')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            <div class="form-group">
                                                <label for="name">Nickname</label>
                                                <input type="text" class="form-control" id="name"
                                                    value="{{ auth()->user()->name }}" placeholder="Nazrul">
                                            </div>
                                            <input type="hidden" name="form[user_id]" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="form[product_id]" value="{{ $products->id }}">
                                            <div class="form-group">
                                                <label for="options">Reason for your rating</label>
                                                <select class="form-control small right py-0 w-100" name="form[reason]"
                                                    id="options">
                                                    <option value="quality"
                                                        {{ old('reason') == 'quality' ? 'selected' : '' }}>Quality</option>
                                                    <option value="value" {{ old('reason') == 'value' ? 'selected' : '' }}>
                                                        Value</option>
                                                    <option value="design" {{ old('reason') == 'design' ? 'selected' : '' }}>
                                                        Design</option>
                                                    <option value="price" {{ old('reason') == 'price' ? 'selected' : '' }}>
                                                        Price</option>
                                                    <option value="others" {{ old('reason') == 'others' ? 'selected' : '' }}>
                                                        Others</option>
                                                </select>
                                                @error('reason')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="comments">Comments</label>
                                                <textarea class="form-control" name="form[review]" id="comments" rows="5" data-max-length="150"></textarea>
                                            </div>
                                            @error('review')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            <button type="submit" class="btn btn-primary">Submit Review</button>
                                        </form>
                                    @else
                                        <p class="py-5">You need to loggin for writting review. <a
                                                href="{{ route('user.auth') }}">Click here!</a>to login</p>
                                        @endif

                                    </div>
                                    <div class="reviews_area">
                                        <ul class="mt-5">
                                            <li>
                                                @php
                                                    $review = \App\Models\ProductReviewModel::where('product_id', $products->id)
                                                        ->latest()
                                                        ->get();
                                                @endphp
                                                @if (count($review) > 0)
                                                    @foreach ($review as $item)
                                                        <div class="single_user_review mb-15">
                                                            <div class="review-rating">
                                                                @for ($i = 0; $i < 5; $i++)
                                                                    @if ($item->rate > $i)
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                    @else
                                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    @endif
                                                                @endfor
                                                                <span>for {{ $item->reason }}</span>
                                                            </div>
                                                            <div class="review-details">
                                                                <p>by <a
                                                                        href="#">{{ \App\Models\User::where('id', $item->user_id)->value('name') }}</a>
                                                                    on
                                                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                                                </p>
                                                                <p>{{ $item->review }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </li>
                                        </ul>
                                    </div>


                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="addi-info">
                                    <div class="additional_info_area">
                                        <h5>Additional Info</h5>
                                        <p>What should I do if I receive a damaged parcel?
                                            <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit
                                                impedit similique qui, itaque delectus labore.</span>
                                        </p>
                                        <p>I have received my order but the wrong item was delivered to me.
                                            <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam
                                                voluptatum beatae harum tempore, ab?</span>
                                        </p>
                                        <p>Product Receipt and Acceptance Confirmation Process
                                            <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum
                                                ducimus, temporibus soluta impedit minus rerum?</span>
                                        </p>
                                        <p class="mb-0">How do I cancel my order?
                                            <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum eius
                                                eum, minima!</span>
                                        </p>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="refund">
                                    <div class="refund_area">
                                        <h6>Return Policy</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa quidem, eos eius
                                            laboriosam voluptates totam mollitia repellat rem voluptate obcaecati quas fuga
                                            similique impedit cupiditate vitae repudiandae. Rem, tenetur placeat!</p>

                                        <h6>Return Criteria</h6>
                                        <ul class="mb-30 ml-30">
                                            <li><i class="icofont-check"></i> Package broken</li>
                                            <li><i class="icofont-check"></i> Physical damage in the product</li>
                                            <li><i class="icofont-check"></i> Software/hardware problem</li>
                                            <li><i class="icofont-check"></i> Accessories missing or damaged etc.</li>
                                        </ul>

                                        <h6>Q. What should I do if I receive a damaged parcel?</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit impedit
                                            similique qui, itaque delectus labore.</p>

                                        <h6>Q. I have received my order but the wrong item was delivered to me.</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam voluptatum
                                            beatae harum tempore, ab?</p>

                                        <h6>Q. Product Receipt and Acceptance Confirmation Process</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum ducimus, temporibus
                                            soluta impedit minus rerum?</p>

                                        <h6>Q. How do I cancel my order?</h6>
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum
                                            eius eum, minima!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Single Product Details Area End -->

        <!-- Related Products Area -->
        @if (!empty($products->rel_product))
            <section class="you_may_like_area section_padding_0_100 clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section_heading new_arrivals">
                                <h5>You May Also Like</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="you_make_like_slider owl-carousel">
                                <!-- Single Product -->
                                @foreach ($products->rel_product as $key => $item)
                                    @if ($item->id != $products->id)
                                        <div class="single-product-area">
                                            <div class="product_image">
                                                <!-- Product Image -->
                                                <img class="normal_img" src="{{ $item->getImage() }}" alt="">
                                                {{-- <img class="hover_img" src="img/product-img/new-1.png" alt=""> --}}

                                                <!-- Product Badge -->
                                                <div class="product_badge">
                                                    <span>New</span>
                                                </div>

                                                <!-- Wishlist -->
                                                <div class="product_wishlist">
                                                    <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                                </div>

                                                <!-- Compare -->
                                                <div class="product_compare">
                                                    <a href="compare.html"><i class="icofont-exchange"></i></a>
                                                </div>
                                            </div>

                                            <!-- Product Description -->
                                            <div class="product_description">
                                                <!-- Add to cart -->
                                                <div class="product_add_to_cart">
                                                    <a href="#"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                                </div>

                                                <!-- Quick View -->
                                                <div class="product_quick_view">
                                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                            class="icofont-eye-alt"></i> Quick View</a>
                                                </div>

                                                <p class="brand_name">
                                                    {{ App\Models\BrandModel::where('id', $item->brand_id)->value('name') }}
                                                </p>
                                                <a href="{{ route('product.detail', $item->slug) }}">{{ $item->name }}</a>
                                                <h6 class="product-price">{{ $item->price }}</h6>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endsection
    @section('css')
        <style>
            .nice-select {
                float: none;
            }

            .nice-select.open {
                width: 46%
            }

            .widget-size .widget-desc li {
                display: block
            }

            .nice-select.open .list {
                width: 100%
            }
        </style>
    @endsection
