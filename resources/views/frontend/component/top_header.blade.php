@php
    $user = Auth::user();

@endphp
<!-- Preloader -->


<!-- Top Header Area -->
<div class="top-header-area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-6">
                <div class="welcome-note">
                    <span class="popover--text" data-toggle="popover"
                        data-content="Welcome to Bigshop ecommerce template."><i class="icofont-info-square"></i></span>
                    <span class="text">Welcome to Bigshop ecommerce template.</span>
                </div>
            </div>
            <div class="col-6">
                <div class="language-currency-dropdown d-flex align-items-center justify-content-end">
                    <!-- Language Dropdown -->
                    <div class="language-dropdown">
                        <div class="dropdown">
                            <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                English
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                <a class="dropdown-item" href="#">Bangla</a>
                                <a class="dropdown-item" href="#">Arabic</a>
                            </div>
                        </div>
                    </div>

                    <!-- Currency Dropdown -->
                    <div class="currency-dropdown">
                        <div class="dropdown">
                            @php
                                App\Helper\Template::currency_load();
                                $currency_code = session('currency_code');
                                $currency_symbol = session('currency_symbol');

                                if ($currency_symbol == '') {
                                    $system_default_currency_info = session('system_default_currency_info');
                                    $currency_code = $system_default_currency_info->code;
                                    $currency_symbol = $system_default_currency_info->symbol;
                                }

                            @endphp
                            <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $currency_symbol }} {{ $currency_code }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                @foreach (\App\Models\CurrencyModel::where('status', 1)->get() as $item)
                                    <a class="dropdown-item" onclick="currency_change('{{ $item->code }}')"
                                        href="#">{{ $item->symbol }}
                                        {{ \Illuminate\Support\Str::upper($item->code) }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Menu -->
<div class="bigshop-main-menu">
    <div class="container">
        <div class="classy-nav-container breakpoint-off">
            <nav class="classy-navbar" id="bigshopNav">

                <!-- Nav Brand -->
                <a href="{{ route('home') }}" class="nav-brand"><img src="{{ asset('frontend/img/core-img/logo.png') }}"
                        alt="logo"></a>

                <!-- Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <!-- Menu -->
                <div class="classy-menu">
                    <!-- Close -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav -->
                    <div class="classynav">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a>
                            </li>
                            <li><a href="{{ route('shop') }}">Shop</a>
                            </li>
                            <li><a href="#">Blog</a>
                            </li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Hero Meta -->
                <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
                    <!-- Search -->
                    <div class="search-area">
                        <div class="search-btn"><i class="icofont-search"></i></div>
                        <!-- Form -->
                        <form action="{{ route('search') }}" method="get">
                            <div class="search-form">
                                <input type="search" id="search_text" name="query" class="form-control"
                                    placeholder="Search">
                                <button type="submit" class="btn btn-sm btn-primary float-right">Search</button>
                            </div>
                        </form>

                    </div>

                    <!-- Wishlist -->
                    <div class="wishlist-area">
                        <a href="{{ route('wishlist.index') }}" class="wishlist-btn"><i class="icofont-heart"></i></a>
                    </div>

                    <!-- Cart -->
                    <div class="cart-area">
                        <div class="cart--btn"><i class="icofont-cart"></i> <span
                                class="cart_quantity">{{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() }}</span>
                        </div>

                        <!-- Cart Dropdown Content -->
                        <div class="cart-dropdown-content">
                            <ul class="cart-list">
                                @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                    <li>
                                        <div class="cart-item-desc">
                                            <a href="{{ route('product.detail', $item->model->slug) }}" class="image">
                                                <img src="{{ $item->model->getImage() }}" class="cart-thumb"
                                                    alt="">
                                            </a>
                                            <div>
                                                <a
                                                    href="{{ route('product.detail', $item->model->slug) }}">{{ $item->name }}</a>
                                                <p>{{ $item->qty }} x - <span
                                                        class="price">{{ $item->price }}</span></p>
                                            </div>
                                        </div>
                                        <span class="dropdown-product-remove delete_to_cart"
                                            data-cart-id="{{ $item->rowId }}"><i class="icofont-bin"></i></span>
                                    </li>
                                @endforeach

                            </ul>
                            <div class="cart-pricing my-4">
                                <ul>
                                    <li>
                                        <span>Sub Total:</span>
                                        <span>${{ Cart::subtotal() }}</span>
                                    </li>
                                    @if (session()->has('coupon'))
                                        <li>
                                            <span>Save Amount:</span>
                                            <span>${{ session()->get('coupon')['sub'] }}</span>
                                        </li>
                                    @endif
                                    <li>
                                        <span>Total:</span>
                                        @if (session()->has('coupon'))
                                            <span>${{ number_format((float) str_replace(',', '', Cart::subtotal()) - session()->get('coupon')['value'], 2) }}</span>
                                        @else
                                            <span>${{ Cart::subtotal() }}</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="cart-box">
                                <a href="{{ route('cart.index') }}" class="btn btn-success">Cart</a>
                                <a href="{{ route('checkout1') }}" class="btn btn-primary">Checkout</a>
                            </div>
                        </div>
                    </div>


                    <!-- Account -->
                    <div class="account-area">
                        <div class="user-thumbnail">
                            @if (isset($user))
                                <img src="{{ $user->getImage() }}" alt="">
                            @else
                                <img src="{{ asset('frontend/img/bg-img/user.jpg') }}" alt="">
                            @endif

                        </div>
                        <ul class="user-meta-dropdown">
                            @include('frontend.component.menu-account')
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
