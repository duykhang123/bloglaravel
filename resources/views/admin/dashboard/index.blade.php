@extends('admin.layout')
@section('main-content')
    <div class="page-header zvn-page-header clearfix">
        @include('admin.component.title', ['title' => 'Dashboard'])
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card overflowhidden">
                <div class="body">
                    <h3>{{\App\Models\ProductModel::where('status',1)->count()}} <i class="fa fa-sitemap float-right"></i></h3>
                    <span>Total Products</span>
                </div>
                <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                    <div class="progress-bar" data-transitiongoal="64" aria-valuenow="64" style="width: 64%;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card overflowhidden">
                <div class="body">
                    <h3>{{\App\Models\User::where('status',1)->count()}} <i class="fa fa-user-plus float-right"></i></h3>
                    <span>New Customers</span>
                </div>
                <div class="progress progress-xs progress-transparent custom-color-purple m-b-0">
                    <div class="progress-bar" data-transitiongoal="67" aria-valuenow="67" style="width: 67%;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card overflowhidden">
                <div class="body">
                    <h3>2,318 <i class="fa fa-dollar float-right"></i></h3>
                    <span>Net Profit</span>
                </div>
                <div class="progress progress-xs progress-transparent custom-color-yellow m-b-0">
                    <div class="progress-bar" data-transitiongoal="89" aria-valuenow="89" style="width: 89%;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card overflowhidden">
                <div class="body">
                    <h3>{{\App\Models\ProductCategoryModel::where('status',1)->count()}}<i class="fa fa-briefcase float-right"></i></h3>
                    <span>Total Category</span>
                </div>
                <div class="progress progress-xs progress-transparent custom-color-green m-b-0">
                    <div class="progress-bar" data-transitiongoal="68" aria-valuenow="68" style="width: 68%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Order</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @include($controllerName . 'list')
                </div>
            </div>
        </div>
    </div>
@endsection
