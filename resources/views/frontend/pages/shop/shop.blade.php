@extends('frontend.layout')
@section('frontend-content')
    @php
        use App\Helper\Template;
    @endphp
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Shop Grid</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Shop Grid</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <form action="{{ route('shop.filter') }}" method="POST">
                <div class="row">
                    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
                        <div class="shop_sidebar_area">

                            <!-- Single Widget -->

                            @csrf
                            <div class="widget catagory mb-30">
                                <h6 class="widget-title">Product Categories</h6>
                                <div class="widget-desc">
                                    @if (!empty($_GET['category']))
                                        @php
                                            $filter_cats = explode(',', $_GET['category']);
                                        @endphp
                                    @endif
                                    <!-- Single Checkbox -->
                                    @if (!empty($cats))
                                        @foreach ($cats as $item => $value)
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" @if (!empty($filter_cats) && in_array($value->slug, $filter_cats)) checked @endif
                                                    class="custom-control-input" id="{{ $value->slug }}" name="category[]"
                                                    onchange="this.form.submit()" value="{{ $value->slug }}">
                                                <label class="custom-control-label"
                                                    for="{{ $value->slug }}">{{ $value->name }} <span
                                                        class="text-muted">({{ count($value->products) }})</span></label>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>


                            <!-- Single Widget -->
                            <div class="widget price mb-30">
                                <h6 class="widget-title">Filter by Price</h6>
                                <div class="widget-desc">
                                    <div class="slider-range">
                                        <div id="slider-range" data-min="{{ Template::minPrice() }}"
                                            data-max="{{ Template::maxPrice() }}" data-unit="$"
                                            class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                            data-value-min="{{ Template::minPrice() }}"
                                            data-value-max="{{ Template::maxPrice() }}" data-label-result="Price:">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all"
                                                tabindex="0"></span>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all"
                                                tabindex="0"></span>
                                        </div>
                                        <div class="d-flex mt-2">
                                            @if (!empty($_GET['price']))
                                                @php
                                                    $price = explode('-', $_GET['price']);

                                                @endphp
                                            @endif
                                            <input type="hidden" id="price_range"
                                                value="@if (!empty($_GET['price'])) {{ $_GET['price'] }} @endif"
                                                name="price_range">
                                            {{-- <div class="range-price">Price: ${{ Template::minPrice() }} -
                                                ${{ Template::maxPrice() }}</div> --}}
                                            <input style="border: 0;width: 60%;"
                                                value="@if (!empty($_GET['price'])) {{ $price[0] }} @else ${{ Template::minPrice() }} @endif - @if (!empty($_GET['price'])) {{ $price[1] }} @else ${{ Template::maxPrice() }} @endif"
                                                type="text" readonly id="amount">
                                            <button type="submit"
                                                class="btn btn-sm btn-primary float-right">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Single Widget -->
                            <div class="widget brands mb-30">
                                <h6 class="widget-title">Filter by brands</h6>
                                <div class="widget-desc">
                                    <!-- Single Checkbox -->
                                    @if (!empty($_GET['brand']))
                                        @php
                                            $filter_brand = explode(',', $_GET['brand']);
                                        @endphp
                                    @endif
                                    @if (!empty($brands))
                                        @foreach ($brands as $item => $value)
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" @if (!empty($filter_brand) && in_array($value->slug, $filter_brand)) checked @endif
                                                    class="custom-control-input" id="{{ $value->slug }}" name="brand[]"
                                                    onchange="this.form.submit()" value="{{ $value->slug }}">
                                                <label class="custom-control-label"
                                                    for="{{ $value->slug }}">{{ $value->name }} <span
                                                        class="text-muted">({{ count($value->products) }})</span></label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Single Widget -->
                            <div class="widget rating mb-30">
                                <h6 class="widget-title">Average Rating</h6>
                                <div class="widget-desc">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i
                                                    class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star"
                                                    aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i> <span
                                                    class="text-muted">(103)</span></a></li>

                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i
                                                    class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star"
                                                    aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i> <span
                                                    class="text-muted">(78)</span></a></li>

                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i
                                                    class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star"
                                                    aria-hidden="true"></i> <i class="fa fa-star-o"
                                                    aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i> <span
                                                    class="text-muted">(47)</span></a></li>

                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i
                                                    class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o"
                                                    aria-hidden="true"></i> <i class="fa fa-star-o"
                                                    aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i> <span
                                                    class="text-muted">(9)</span></a></li>

                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i
                                                    class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o"
                                                    aria-hidden="true"></i> <i class="fa fa-star-o"
                                                    aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i> <span
                                                    class="text-muted">(3)</span></a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Single Widget -->
                            {{-- <div class="widget size mb-30">
                                <h6 class="widget-title">Filter by Size</h6>
                                <div class="widget-desc">
                                    <ul>
                                        <li><a href="#">XS</a></li>
                                        <li><a href="#">S</a></li>
                                        <li><a href="#">M</a></li>
                                        <li><a href="#">L</a></li>
                                        <li><a href="#">XL</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                        <!-- Shop Top Sidebar -->
                        <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                            <div class="view_area d-flex">
                                <div class="grid_view">
                                    <a href="shop-grid-left-sidebar.html" data-toggle="tooltip" data-placement="top"
                                        title="Grid View"><i class="icofont-layout"></i></a>
                                </div>
                                <div class="list_view ml-3">
                                    <a href="shop-list-left-sidebar.html" data-toggle="tooltip" data-placement="top"
                                        title="List View"><i class="icofont-listine-dots"></i></a>
                                </div>
                            </div>
                            <select id="sortBy" name="sortBy" onchange="this.form.submit()" class="small right">
                                <option value="">Default</option>
                                <option value="priceAsc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceAsc') selected @endif>Price - Lower To
                                    Higher
                                </option>
                                <option value="priceDesc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceDesc') selected @endif>Price - Higher
                                    To Lower
                                </option>
                                <option value="titleAsc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleAsc') selected @endif>Title - Lower To
                                    Higher
                                </option>
                                <option value="titleDesc" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleDesc') selected @endif>Title - Higher
                                    To Lower
                                </option>
                            </select>
                        </div>

                        <div class="shop_grid_product_area">
                            <div class="row justify-content-center">
                                <!-- Single Product -->
                                @if (!empty($products))
                                    @foreach ($products as $key => $value)
                                        <div class="col-9 col-sm-12 col-md-6 col-lg-4">
                                            <div class="single-product-area mb-30">
                                                <div class="product_image">
                                                    <!-- Product Image -->
                                                    <img class="normal_img" src="{{ $value->getImage() }}"
                                                        alt="">

                                                    <!-- Product Badge -->
                                                    <div class="product_badge">
                                                        <span>{{ $value->condition }}</span>
                                                    </div>

                                                    <!-- Wishlist -->
                                                    <div class="product_wishlist">
                                                        <a href="javascript:void(0)" class="add_to_wishlist"
                                                            data-quantity="1" data-id="{{ $value->id }}"
                                                            id="add_to_wishlist_{{ $value->id }}"><i
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
                                                        <a href="#" data-quantity="1"
                                                            data-product-id="{{ $value->id }}" class="add_to_cart"
                                                            id="add_to_cart_{{ $value->id }}"><i
                                                                class="icofont-shopping-cart"></i> Add to
                                                            Cart</a>
                                                    </div>

                                                    <!-- Quick View -->
                                                    <div class="product_quick_view">
                                                        <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                class="icofont-eye-alt"></i> Quick View</a>
                                                    </div>

                                                    <p class="brand_name">
                                                        {{ App\Models\BrandModel::where('id', $value->brand_id)->value('name') }}
                                                    </p>
                                                    <a
                                                        href="{{ route('product.detail', $value->slug) }}">{{ $value->name }}</a>
                                                    <h6 class="product-price">${{ $value->price }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        {{ $products->appends($_GET)->links('vendor.pagination.customs') }}



                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection

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

    <script>
        $(document).ready(function() {
            if ($('#slider-range').length > 0) {
                const max_price = parseInt($('#slider-range').data('max')) || 500;
                const min_price = parseInt($('#slider-range').data('min')) || 0;
                const currency = ($('#slider-range')).data('currency') || '';
                let price_range = min_price + '-' + max_price;

                if ($('#price_range').length > 0 && $('#price_range').val()) {
                    price_range = $('#price_range').val().trim();
                }

                let price = price_range.split('-');

                $('#slider-range').slider({
                    range: true,
                    min: min_price,
                    max: max_price,
                    values: price,
                    slide: function(event, ui) {
                        $('#amount').val('$' + ui.values[0] + "-" + '$' + ui.values[1]);
                        $('#price_range').val(ui.values[0] + "-" + ui.values[1]);
                    }
                })
            }
        })
    </script>
@endsection
