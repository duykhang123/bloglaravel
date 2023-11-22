@php
    use App\Template;
    $select_type = Form::select('form[type]', config('myconfig.template.coupon'), $item['type'], ['class' => 'form-control']);
    $select_status = Form::select('form[status]', config('myconfig.template.status'), $item['status'], ['class' => 'form-control']);
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
    @elseif (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif



    <form id="demo-form2" method="POST" action="{{ route($controllerName . 'edit', ['id' => $item['id']]) }}"
        enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
        @csrf
        <div class="row">
            <div class="col-md-8">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Code <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['code'] }}" type="text" name="form[code]" id="name"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Value <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['value'] }}" type="text" name="form[value]" id="name"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Type <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! $select_type !!}
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
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-offset-3">
                                <a class="btn btn-danger" href="{{ route($controllerName . 'index') }}">Quay về</a>
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
