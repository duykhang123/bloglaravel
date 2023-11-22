<section class="featured_product_area">
    <div class="container">
        <div class="row">
            <!-- Featured Offer Area -->
            <div class="col-12 col-lg-6">
                @if (!empty($banner_backgroud))
                    @foreach ($banner_backgroud as $item)
                        <div class="featured_offer_area d-flex align-items-center"
                            style="background-image: url({{$item->getImage()}});">
                            <div class="featured_offer_text">
                                <p>{{$item->name}}</p>
                                <h2>{{$item->description}}</h2>
                                <a href="#" class="btn btn-primary btn-sm mt-3">Shop Now</a>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

            <!-- Featured Product Area -->
            <div class="col-12 col-lg-6">
                <div class="section_heading featured">
                    <h5>Featured Products</h5>
                </div>
                @if (!empty($special_product))

                    <!-- Featured Product Slides -->
                    <div class="featured_product_slides owl-carousel">
                        <!-- Single Product -->
                        @foreach ($special_product as $key => $value)
                            <div class="single-product-area">
                                <div class="product_image">
                                    <!-- Product Image -->
                                    <img class="normal_img" src="{{ $value->getImage() }}" alt="">

                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span>{{ $value->condition }}</span>
                                    </div>

                                    <!-- Wishlist -->
                                    <div class="product_wishlist">
                                        <a href="javascript:void(0)" class="add_to_wishlist" data-quantity="1"
                                            data-id="{{ $value->id }}" id="add_to_wishlist_{{ $value->id }}"><i
                                                class="icofont-heart"></i></a>
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
                                        <a href="#" data-quantity="1" data-product-id="{{ $value->id }}"
                                            class="add_to_cart" id="add_to_cart_{{ $value->id }}"><i
                                                class="icofont-shopping-cart"></i> Add to
                                            Cart</a>
                                    </div>

                                    <!-- Quick View -->
                                    <div class="product_quick_view">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                class="icofont-eye-alt"></i> Quick View</a>
                                    </div>

                                    <a href="{{ route('product.detail', $value->slug) }}">{{ $value->name }}</a>
                                    <h6>{{ App\Helper\Template::currency_converter($value->price) }}</h6>
                                    <div class="top_seller_product_rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if (round($value->reviews->avg('rate')) > $i)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endif

            </div>
        </div>
    </div>
</section>
@section('script')
    <script>
        $(document).on('click', '.add_to_cart', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var product_qty = $(this).data('quantity');

            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.store') }}";
            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    _token: token,
                },
                beforeSend: function() {
                    $('#add_to_cart_' + product_id).html(
                        '<i class="fa fa-spinner fa-spin"></i> Loading.....');
                },
                complete: function() {
                    $('#add_to_cart_' + product_id).html(
                        '<i class="icofont-shopping-cart"></i>Add to Cart');
                },
                success: function(data) {
                    $('body #header-ajax').html(data['header']);
                    Swal.fire({
                        title: "Ok!",
                        text: data['message'],
                        icon: "success"
                    });
                }
            })
        })
    </script>

    <script>
        $(document).on('click', '.add_to_wishlist', function(e) {
            e.preventDefault();
            var product_id = $(this).data('id');
            var product_qty = $(this).data('quantity');

            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.store') }}";
            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    _token: token,
                },
                beforeSend: function() {
                    $('#add_to_wishlist' + product_id).html(
                        '<i class="fa fa-spinner fa-spin"></i>');
                },
                complete: function() {
                    $('#add_to_wishlist' + product_id).html(
                        '<i class="icofont-heart"></i>Add to Cart');
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_count').html(data['wishlist_count']);
                        Swal.fire({
                            title: "Ok!",
                            text: data['message'],
                            icon: "success"
                        });
                    } else if (data['present']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_count').html(data['wishlist_count']);
                        Swal.fire({
                            title: "Opps!",
                            text: data['message'],
                            icon: "warning"
                        });
                    } else {
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_count').html(data['wishlist_count']);
                        Swal.fire({
                            title: "Sorry!",
                            text: 'You can add that product',
                            icon: "success"
                        });
                    }

                }
            })
        })
    </script>
@endsection
