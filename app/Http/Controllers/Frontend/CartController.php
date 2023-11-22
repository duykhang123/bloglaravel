<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CouponModel;
use App\Models\ProductModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function cartIndex()
    {
        return view('frontend.cart.cart');
    }

    public function cartStore(Request $request)
    {
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');
        $product = ProductModel::getProductByCart($product_id);
        $price = $product[0]['price'];

        $cart_array = [];

        foreach (Cart::instance('shopping')->content() as $item) {
            $cart_array[] = $item->id;
        }

        $result = Cart::instance('shopping')->add($product_id, $product[0]['name'], $product_qty, $price)->associate('App\Models\ProductModel');

        if ($result) {
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item was add to your cart";
        }

        if ($request->ajax()) {
            $header = view('frontend.component.top_header')->render();
            $response['header'] = $header;
        }

        return json_encode($response);
    }

    public function cartDelete(Request $request)
    {
        $id = $request->input('cart_id');
        Cart::instance('shopping')->remove($id);
        $response['status'] = true;
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();
        $response['message'] = "Cart successfully removed";
        if ($request->ajax()) {
            $header = view('frontend.component.top_header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }

    public function cartUpdate(Request $request)
    {
        $this->validate($request, [
            'product_qty' => 'required|numeric',
        ]);
        $rowId = $request->input('rowId');
        $request_quantity = $request->input('product_qty');
        $productQuantity = $request->input('productQuantity');

        if ($request_quantity > $productQuantity) {
            $response['status'] = false;
        } elseif ($request_quantity < 1) {
            $message = "You can't add less than 1 quantity";
        } else {
            Cart::instance('shopping')->update($rowId, $request_quantity);
            $message = "Ok";
            $response['status'] = true;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
        }
        if ($request->ajax()) {
            $header = view('frontend.component.top_header')->render();
            $cart_list = view('frontend.component._cart_item')->render();
            $response['header'] = $header;
            $response['cart_list'] = $cart_list;
            $response['message'] = $message;
        }
        return $response;
    }

    public function couponAdd(Request $request){
        $coupon = CouponModel::where('code',$request->input('code'))->first();
        if(!$coupon){
            return back()->with('error','Invalid coupon code, please enter valid coupon code');
        }
        if($coupon){
            $total_price = Cart::instance('shopping')->subtotal();
            session()->put('coupon', [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'sub' => number_format($coupon->value,2),
                'value' => $coupon->discount($total_price),
            ]);
            return back()->with('success','Coupon successfully add');
        }
    }
}
