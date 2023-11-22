@php
    $products = App\Models\ProductModel::where(['status' => 1, 'condition' => 'new'])
        ->orderBy('id', 'DESC')
        ->limit(4)
        ->get();
@endphp
<!-- Quick View Modal Area -->
<div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="quickview_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="quickview_pro_img">
                                    <img class="first_img" src="img/product-img/new-1-back.png" alt="">
                                    <img class="hover_img" src="img/product-img/new-1.png" alt="">
                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span class="badge-new">New</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="quickview_pro_des">
                                    <h4 class="title">Boutique Silk Dress</h4>
                                    <div class="top_seller_product_rating mb-15">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="price">$120.99 <span>$130</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita
                                        quibusdam aspernatur, sapiente consectetur accusantium perspiciatis
                                        praesentium eligendi, in fugiat?</p>
                                    <a href="#">View Full Product Details</a>
                                </div>
                                <!-- Add to Cart Form -->
                                <form class="cart" method="post">
                                    <div class="quantity">
                                        <input type="number" class="qty-text" id="qty" step="1"
                                            min="1" max="12" name="quantity" value="1">
                                    </div>
                                    <button type="submit" name="addtocart" value="5" class="cart-submit">Add
                                        to
                                        cart</button>
                                    <!-- Wishlist -->
                                    <div class="modal_pro_wishlist">
                                        <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                    </div>
                                    <!-- Compare -->
                                    <div class="modal_pro_compare">
                                        <a href="compare.html"><i class="icofont-exchange"></i></a>
                                    </div>
                                </form>
                                <!-- Share -->
                                <div class="share_wf mt-30">
                                    <p>Share with friends</p>
                                    <div class="_icon">
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View Modal Area -->
@if (!empty($products))

    <section class="new_arrivals_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading new_arrivals">
                        <h5>New Arrivals</h5>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="new_arrivals_slides owl-carousel">
                        @foreach ($products as $key => $value)
                            <!-- Single Product -->
                            <div class="single-product-area">
                                <div class="product_image">
                                    <!-- Product Image -->
                                    <img class="normal_img" src="{{ $value->getImage() }}" alt="">
                                    <img class="hover_img" src="img/product-img/new-1.png" alt="">

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
                                                class="icofont-shopping-cart"></i> Add to Cart</a>
                                    </div>

                                    <!-- Quick View -->
                                    <div class="product_quick_view">
                                        <a href="#" class="icofont-eye-alt" data-toggle="modal"
                                            data-target="#quickview"><i></i> Quick View</a>
                                    </div>

                                    <p class="brand_name">
                                        {{ App\Models\BrandModel::where('id', $value->brand_id)->value('name') }}</p>
                                    <a href="{{ route('product.detail', $value->slug) }}">{{ $value->name }}</a>
                                    <h6 class="product-price">
                                        {{ App\Helper\Template::currency_converter($value->price) }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </section>
@endif

@section('script')
    <script>
        // function changeModalId(valueId) {
        //     var modalId = "quickview-" + valueId;
        //     $("#quickview").attr("id", modalId); // Change the id of the modal
        //     $("#quickview").attr("aria-labelledby", modalId); // Update other attributes if needed
        //     $("#quickview").attr("data-target", "#" + modalId); // Update the data-target attribute

        //     // If you're using Bootstrap, you might need to manually open the modal after changing the id
        //     $("#" + modalId).modal("show");
        // }
    </script>
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
