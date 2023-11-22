<section class="welcome_area">
    <div class="welcome_slides owl-carousel">
        <!-- Single Slide -->
        @if (!empty($banner))
            @foreach ($banner as $key => $item)
                <div class="single_slide bg-img" style="background-image: url({{ $item->getImage() }});">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12 col-md-6">
                                <div class="welcome_slide_text">
                                    <p class="text-white" data-animation="fadeInUp" data-delay="0">
                                        {{ $item->description }}</p>
                                    <h2 class="text-white" data-animation="fadeInUp" data-delay="300ms">
                                        {{ $item->name }}</h2>
                                    <a href="#" class="btn btn-primary" data-animation="fadeInUp"
                                        data-delay="900ms">Add
                                        to
                                        cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @endif
    </div>
</section>
