<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CouponModel;
use App\Models\ProductModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlistIndex()
    {
        return view('frontend.pages.wishlist');
    }

    public function wishlistStore(Request $request)
    {
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');
        $product = ProductModel::getProductByCart($product_id);
        $price = $product[0]['price'];

        $wishlist_array = [];

        foreach (Cart::instance('wishlist')->content() as $item) {
            $wishlist_array[] = $item->id;
        }

        if (in_array($product_id, $wishlist_array)) {
            $response['present'] = true;
            $response['message'] = "Item was ready to your wishlist";
        } else {
            $result = Cart::instance('wishlist')->add($product_id, $product[0]['name'], $product_qty, $price)->associate('App\Models\ProductModel');
            if ($result) {
                $response['status'] = true;
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
                $response['message'] = "Item was add to your wishlist";
            }
        }

        if ($request->ajax()) {
            $header = view('frontend.component.top_header')->render();
            $response['header'] = $header;
        }

        return json_encode($response);
    }

    public function wishlistMoveCart(Request $request)
    {
        $item = Cart::instance('wishlist')->get($request->input('rowId'));
        Cart::instance('wishlist')->remove($request->input('rowId'));
        $result = Cart::instance('shopping')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\ProductModel');
        if ($result) {
            $response['status'] = true;
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item have been move to cart";
        }
        if ($request->ajax()) {
            $header = view('frontend.component.top_header')->render();
            $wishlist = view('frontend.component._wishlist')->render();
            $response['wishlist_list'] = $wishlist;
            $response['header'] = $header;
        }
        return $response;
    }

    public function wishlistDelete(Request $request){
        $id = $request->input('rowId');
        Cart::instance('wishlist')->remove($id);
        $response['status'] = true;
        $response['cart_count'] = Cart::instance('shopping')->count();
        $response['message'] = "Cart successfully removed";
        if ($request->ajax()) {
            $header = view('frontend.component.top_header')->render();
            $wishlist = view('frontend.component._wishlist')->render();
            $response['wishlist_list'] = $wishlist;
            $response['header'] = $header;
        }
        return $response;
    }
}
