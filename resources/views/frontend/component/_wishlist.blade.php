<table class="table table-bordered mb-30">
    <thead>
        <tr>
            <th scope="col"><i class="icofont-ui-delete"></i></th>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Quantity</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @if (!empty(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content()))
            @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $item)
                <tr>
                    <th scope="row">
                        <i class="icofont-close delete_wishlist" data-id="{{ $item->rowId }}"></i>
                    </th>
                    <td>
                        <img src="{{ $item->model->getImage() }}" alt="Product">
                    </td>
                    <td>
                        <a
                            href="{{ route('product.detail', $item->model->slug) }}">{{ $item->name }}</a>
                    </td>
                    <td>${{ $item->price }}</td>
                    <td>
                        <div class="quantity">
                            <input type="number" data-id="{{ $item->rowId }}" class="qty-text"
                                id="qty-input-{{ $item->rowId }}" step="1" min="1"
                                max="99" name="quantity" value="{{ $item->qty }}">
                            <input type="hidden" data-id="{{ $item->rowId }}"
                                data-product-quantity="{{ $item->id }}"
                                id="update-cart-{{ $item->rowId }}">
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" data-id="{{ $item->rowId }}"
                            class="move-to-cart btn btn-primary btn-sm">Add to Cart</a></td>
                </tr>
            @endforeach
        @else
            false
        @endif

    </tbody>
</table>