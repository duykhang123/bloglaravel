<?php

namespace App\Http\Controllers;

use App\Models\OrderModel as MainModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $pathView = 'admin.order.';

    private $linkView = 'order';

    public function __construct()
    {
        view()->share("controllerName", $this->pathView);

        view()->share("linkView", $this->linkView);
    }

    public function index(Request $request){
        $params['select_filter']['status'] = $request->input('select_filter', 'default');
        $params['search']['value'] = $request->input('search_value', '');
        $params['search']['field'] = $request->input('search_field', 'all');


        $mainModel = new MainModel();
        $items = $mainModel->listItem($params);

        $order = $mainModel->orderBy('id','DESC')->get();
        return view($this->pathView.'index',compact('order','items','params'));
    }

    public function edit($id,Request $request){
        $mainModel = new MainModel();
        $order = $mainModel->where('id',$id)->first();
        return view($this->pathView . 'edit',['id' => $id])->with('order', $order);


    }

    public function editCondition(Request $request){
        $order = MainModel::find($request->input('order_id'));
        if($order){
            if($request->input('condition') == 'delivered'){
                foreach($order->products as $item){
                    $product = ProductModel::where('id',$item->pivot->product_model_id)->first();
                    MainModel::where('id',$request->input('order_id'))->update(['payment_status'=>'paid']);
                }
            }
            $status = MainModel::where('id',$request->input('order_id'))->update(['condition'=>$request->input('condition')]);
            if($status){
                return back()->with('success','Order successfully updated');
            }else{
                return back()->with('error','Something went wrong');
            }
        }
    }
}
