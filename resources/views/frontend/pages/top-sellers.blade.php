<div role="tabpanel" class="tab-pane fade show active" id="top-sellers">
    <div class="top_sellers_area">
        <div class="row">
            @if (count($best_sellings) > 0)
                @foreach ($best_sellings as $key => $value)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single_top_sellers">
                            <div class="top_seller_image">
                                <img class="normal_img" src="{{ $value->getImage() }}" alt="Top-Sellers">
                            </div>
                            <div class="top_seller_desc">
                                <h5>{{ $value->name }}</h5>
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

                                <!-- Info -->
                                <div class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                    <!-- Add to cart -->

                                    <div class="ts_product_add_to_cart">
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"
                                            data-quantity="1" data-product-id="{{ $value->id }}" class="add_to_cart"
                                            id="add_to_cart_{{ $value->id }}"><i
                                                class="icofont-shopping-cart"></i></a>
                                    </div>

                                    <!-- Wishlist -->
                                    <div class="ts_product_wishlist">
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top"
                                            class="add_to_wishlist" data-quantity="1" data-id="{{ $value->id }}"
                                            id="add_to_wishlist_{{ $value->id }}"><i class="icofont-heart"></i></a>
                                    </div>

                                    <!-- Compare -->
                                    <div class="ts_product_compare">
                                        <a href="compare.html" data-toggle="tooltip" data-placement="top"
                                            title="Compare"><i class="icofont-exchange"></i></a>
                                    </div>

                                    <!-- Quick View -->
                                    <div class="ts_product_quick_view">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                class="icofont-eye-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>
</div>
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
