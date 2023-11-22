<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductReviewModel as MainModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function productReview(Request $request){
        $request->validate(
            [
                'form.rate' => 'required|numeric',
                'form.reason' => 'required|string',
                'form.review' => 'required|string',
            ],
        );
        $params = $request->all();
        $mainModel = new MainModel();
        $mainModel->saveItem($params);
        return back()->with('success','Thanks for your feedback');
    }
}
