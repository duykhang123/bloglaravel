@extends('frontend.layout')
@section('frontend-content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Wishlist</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Wishlist Table Area -->
    <div class="wishlist-table section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table wishlist-table">
                        <div class="table-responsive">
                            @include('frontend.component._wishlist')
                        </div>
                    </div>

                    <div class="cart-footer text-right">
                        <div class="back-to-shop">
                            <a href="#" class="btn btn-primary">Add All Item</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Table Area -->
@endsection
@section('script')
    <script>
        $('.move-to-cart').on('click', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.move.cart') }}";

            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    rowId: rowId,
                    _token: token,
                },
                beforeSend: function() {
                    $(this).html(
                        '<i class="fa fa-spinner fa-spin"></i> Moving to cart.....');
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        Swal.fire({
                            title: "Ok!",
                            text: data['message'],
                            icon: "success"
                        });
                    } else {
                        Swal.fire({
                            title: "Opps!",
                            text: data['message'],
                            icon: "Something went wrong"
                        });
                    }

                }
            })
        })
    </script>
    <script>
        $('.delete_wishlist').on('click', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.delete.cart') }}";

            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    rowId: rowId,
                    _token: token,
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        Swal.fire({
                            title: "Ok!",
                            text: data['message'],
                            icon: "success"
                        });
                    } else {
                        Swal.fire({
                            title: "Opps!",
                            text: data['message'],
                            icon: "Something went wrong"
                        });
                    }

                }
            })
        })
    </script>
@endsection
