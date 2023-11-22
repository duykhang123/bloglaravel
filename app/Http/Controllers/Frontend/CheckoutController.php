<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CouponModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\ShippingModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout1()
    {
        $user = auth()->user();
        return view('frontend.checkout.checkout1', compact('user'));
    }

    public function checkout1Store(Request $request)
    {
        Session::put('checkout', [
            "name" => $request->name,
            "fullname" => $request->fullname,
            "email" => $request->email,
            "phone" => $request->phone,
            "country" => $request->country,
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "postcode" => $request->postcode,
            "note" => $request->note,
            "sname" => $request->sname,
            "sfullname" => $request->sfullname,
            "semail" => $request->semail,
            "sphone" => $request->sphone,
            "scountry" => $request->scountry,
            "saddress" => $request->saddress,
            "scity" => $request->scity,
            "sstate" => $request->sstate,
            "spostcode" => $request->spostcode,
            "sub_total" => $request->sub_total,
            "total_amount" => $request->total_amount,
        ]);


        $shippings = ShippingModel::where('status', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.checkout.checkout2', compact('shippings'));
    }

    public function checkout2Store(Request $request)
    {
        Session::push('checkout', [
            "delivery_charge" => $request->delivery_charge,
        ]);

        return view('frontend.checkout.checkout3');
    }


    public function checkout3Store(Request $request)
    {
        Session::push('checkout', [
            "payment_method" => $request->payment_method,
            "payment_status" => '1',
        ]);

        return view('frontend.checkout.checkout4');
    }


    public function checkoutStore()
    {
        $order = new OrderModel();

        $order['user_id'] = auth()->user()->id;
        $order['order_number'] = Str::upper('ORD-' . Str::random(8));
        $order['sub_total'] = Session::get('checkout')['sub_total'];
        if (Session::has('coupon')) {
            $order['coupon'] = Session::get('coupon')['value'];
        } else {
            $order['coupon'] = 0;
        }
        $order['total_amount'] = Session::get('checkout')['sub_total'] + Session::get('checkout')[0]['delivery_charge'] - $order['coupon'];

        $order['payment_method'] = Session::get('checkout')[1]['payment_method'];
        $order['payment_status'] = Session::get('checkout')[1]['payment_status'];
        $order['condition'] = 'pending';
        $order['delivery_charge'] = Session::get('checkout')[0]['delivery_charge'];

        $order['name'] = Session::get('checkout')['name'];
        $order['fullname'] = Session::get('checkout')['fullname'];
        $order['email'] = Session::get('checkout')['email'];
        $order['phone'] = Session::get('checkout')['phone'];
        $order['country'] = Session::get('checkout')['country'];
        $order['address'] = Session::get('checkout')['address'];
        $order['city'] = Session::get('checkout')['city'];
        $order['state'] = Session::get('checkout')['state'];

        $order['note'] = Session::get('checkout')['note'];
        $order['sname'] = Session::get('checkout')['sname'];
        $order['sfullname'] = Session::get('checkout')['sfullname'];
        $order['semail'] = Session::get('checkout')['semail'];
        $order['sphone'] = Session::get('checkout')['sphone'];
        $order['saddress'] = Session::get('checkout')['saddress'];
        $order['scountry'] = Session::get('checkout')['scountry'];
        $order['scity'] = Session::get('checkout')['scity'];
        $order['postcode'] = Session::get('checkout')['postcode'];
        $order['spostcode'] = Session::get('checkout')['spostcode'];
        $order['sstate'] = Session::get('checkout')['sstate'];


        $status = $order->save();

        foreach (Cart::instance('shopping')->content() as $item) {
            $product_id[] = $item->id;
            $product = ProductModel::find($item->id);
            $quantity = $item->qty;
            $order->products()->attach($product, ['quantity' => $quantity]);
        }

        if ($status) {
            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            Session::forget('checkout');
            return redirect()->route('complete', $order['order_number']);
        } else {
            return redirect()->route('checkout1')->with('error', 'Please try again');
        }
    }

    public function complete($order)
    {
        $order = $order;
        return view('frontend.checkout.complete', compact('order'));
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $price = intval((float)str_replace(',', '', $data['vnpay']));
        $vnp_TmnCode = "ACWF0ZNG"; //Mã website tại VNPAY 
        $vnp_HashSecret = "HAVHCSSZAGSAFEZQXEFJXVFVDUSSCCOF"; //Chuỗi bí mật
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/return-vnpay";
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $price * 100;
        
        $vnp_BankCode = 'NCB';
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

}
