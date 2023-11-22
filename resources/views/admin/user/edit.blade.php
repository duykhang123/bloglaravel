@php
    use App\Template;

    $select_status = Form::select('user[status]', config('myconfig.template.status'), $item['status'], ['class' => 'form-control']);
@endphp


@extends('admin.layout')
@section('main-content')
    <div class="page-header zvn-page-header">
        <div class="zvn-page-header-breadcrumb ">
            <ul class="zvn-breadcrumb-title clearfix">
                <li class="zvn-breadcrumb-item">
                    <a href="index.html">
                        Trang chủ
                    </a>
                </li>
                <li class="zvn-breadcrumb-item">Thêm mới
                </li>
            </ul>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade in zvn-alert  " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong><i class="fa fa-exclamation-triangle"></i> Xảy ra lỗi!</strong>
            @foreach ($errors->all() as $error)
                <p>- {{ $error }}</p>
            @endforeach
        </div>
    @elseif (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif



    <div class="row">
        <div class="col-md-8">
            <form id="demo-form2" method="POST" action="{{ route($controllerName . 'edit', ['id' => $item['id']]) }}"
                enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                @csrf
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thêm mới </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['name'] }}" type="text" name="user[name]" id="name"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fullname <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['fullname'] }}" type="text" name="user[fullname]" id="fullname"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['email'] }}" type="text" name="user[email]" id="email"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! $select_status !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="avatar">Picture <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="user[picture]" onchange="loadFile(event)"
                                    class="form-control col-md-7 col-xs-12">
                                <img src="{{ $item->getImage() }}" style="width: 150px" id="output" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-offset-3"><button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Password</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <form method="POST" action="{{ route($controllerName . 'edit', ['id' => $item['id']]) }}">
                    @csrf
                    <div class="card">
                        <input type="hidden" name="resetPass" value="1">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Reset password</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="x_panel">
                <div class="x_content">
                    <form method="POST" action="{{ route($controllerName . 'edit', ['id' => $item['id']]) }}">
                        @csrf
                        <div class="card card-danger">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" name="forgot[old_password]" class="form-control"
                                        id="old_password" placeholder="Old password...">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="forgot[new_password]" class="form-control"
                                        id="new_password" placeholder="New password...">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input type="password" name="forgot[confirm_password]" class="form-control"
                                        id="confirm_password" placeholder="Confirm new password...">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
