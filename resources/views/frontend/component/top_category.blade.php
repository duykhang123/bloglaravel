<div class="top_catagory_area mt-50 clearfix">
    <div class="container">
        <div class="row">
            <!-- Single Catagory -->
            @if (!empty($product_category))
                @foreach ($product_category as $key => $item)
                    <div class="col-12 col-md-4">
                        <div class="single_catagory_area mt-50">
                            <a href="{{route('product.category',$item->slug)}}">
                                <img src="{{ $item->getImage() }} " alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>
</div>
