@if (!empty($product))
    @foreach ($product as $key => $value)
        <div class="col-9 col-sm-6 col-md-4 col-lg-3">
            <div class="single-product-area mb-30">
                <div class="product_image">
                    <!-- Product Image -->
                    {{-- <img class="normal_img" src="img/product-img/new-1-back.png"
                                                    alt="">
                                                <img class="hover_img" src="img/product-img/new-1.png" alt=""> --}}
                    <img class="normal_img" src="{{ $value->getImage() }}" alt="">

                    <!-- Product Badge -->
                    <div class="product_badge">
                        <span>{{ $value->condition }}</span>
                    </div>

                    <!-- Wishlist -->
                    <div class="product_wishlist">
                        <a href="javascript:void(0)" class="add_to_wishlist" data-quantity="1" data-id="{{$value->id}}" id="add_to_wishlist_{{$value->id}}"><i class="icofont-heart"></i></a>
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
                        <a href="#" data-quantity="1" data-product-id="{{$value->id}}" class="add_to_cart" id="add_to_cart_{{$value->id}}"><i class="icofont-shopping-cart"></i> Add to
                            Cart</a>
                    </div>

                    <!-- Quick View -->
                    <div class="product_quick_view">
                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="icofont-eye-alt"></i>
                            Quick View</a>
                    </div>

                    <p class="brand_name">{{ App\Models\BrandModel::where('id', $value->brand_id)->value('name') }}</p>
                    <a href="{{ route('product.detail', $value->slug) }}">{{ $value->name }}</a>
                    <h6 class="product-price">${{ $value->price }}</h6>
                </div>
            </div>
        </div>
    @endforeach
@endif
