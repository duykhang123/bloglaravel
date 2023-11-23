@extends('frontend.layout')
@section('frontend-content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>About Us</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">About Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->
    @if (!empty($list_about))
        <!-- About Us Area -->
        <section class="about_us_area section_padding_100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="about_us_content pl-0 pl-lg-5">
                        <h5>{{ $list_about->name }}
                        </h5>
                        <p>{{ $list_about->description }}</p>
                        {!! $list_about->content !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us Area -->


    @endif
@endsection
