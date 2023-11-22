<!doctype html>
<html lang="en">

<head>
    @include('frontend.component.header')
</head>
{{-- @php
    dd(session()->all())
@endphp --}}

<body>
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <header class="header_area" id="header-ajax">
        <!-- Header Area -->
        @include('frontend.component.top_header')
        <!-- Header Area End -->
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('admin.component.nofication')
            </div>
        </div>
    </div>

    @yield('frontend-content')

    <!-- Footer Area -->
    @include('frontend.component.footer')
    <!-- Footer Area -->

    @include('frontend.component.script')

    <script>
        function currency_change(currency_code) {
            var token = "{{ csrf_token() }}";
            var path = "{{ route('currency.load') }}";
            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    currency_code: currency_code,
                    _token: token,
                },
                success: function(data) {
                    if (data['status']) {
                        location.reload();
                    } else {
                        alert('error');
                    }
                }
            })
        }
    </script>


    <script>
        $(document).on('click', '.delete_to_cart', function(e) {
            e.preventDefault();
            var cart_id = $(this).data('cart-id');

            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.delete') }}";
            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    cart_id: cart_id,
                    _token: token,
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
        $(document).ready(function() {
            var path = "{{ route('autosearch') }}";
            $("#search_text").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: path,
                        dataType: 'json',
                        data: {
                            term: request.term,
                        },
                        success: function(data) {
                            response(data)
                        }
                    })
                }
            });
        })
    </script>

</body>

</html>
