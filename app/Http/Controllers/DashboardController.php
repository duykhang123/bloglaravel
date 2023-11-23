<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    private $pathView = 'admin.dashboard.';

    private $linkView = 'dashboard';

    public function __construct()
    {
        view()->share("controllerName", $this->pathView);

        view()->share("linkView", $this->linkView);
    }

    public function index(){
        $order = OrderModel::orderBy('id','DESC')->get();
        return view($this->pathView.'index',compact('order'));
    }
    public function deleteOnly($id)
    {
        $mainModel = new OrderModel();
        $item = $mainModel->where('id', $id)->first();
        if (!empty($item)) {
            $mainModel->where('id', $id)->delete();
            Session::flash('success', 'Đã xóa thành công');
            return redirect()->back();
        } else {
            Session::flash('error', 'Vui lòng chọn phần tử muốn xóa');
            return redirect()->back();
        }
    }
}
