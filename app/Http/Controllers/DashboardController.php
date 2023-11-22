<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use Illuminate\Http\Request;

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
}
