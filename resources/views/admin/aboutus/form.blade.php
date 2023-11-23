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
    @endif

    <form id="demo-form2" method="POST" action="{{ route($controllerName . 'form') }}" enctype="multipart/form-data"
        data-parsley-validate class="form-horizontal form-label-left">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['name'] ?? '' }}" type="text" name="form[name]" id="name"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="return_customer">Return Customer <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['return_customer'] ?? '' }}" type="number" name="form[return_customer]" id="return_customer"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="years_of_experience">Years of experience <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['years_of_experience'] ?? '' }}" type="number" name="form[years_of_experience]" id="years_of_experience"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="happy_customer">Happy Customer <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['happy_customer'] ?? '' }}" type="number" name="form[happy_customer]" id="happy_customer"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="team_advisor">Team Advisor <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['team_advisor'] ?? '' }}" type="number" name="form[team_advisor]" id="team_advisor"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mô tả <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="form[description]" id="description">{{ $item['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">Bài viết <span class="required">*</span>
                            </label>
                            <div class="">
                                <textarea id="main-content" style="height: 274px; width: 481px;" name="form[content]">{{ $item['content'] ?? '' }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>SEO</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="card card-info">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <textarea class="form-control" name="form[meta_title]" rows="2" id="meta_title" placeholder="">{{ $item['meta_title'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_desc">Meta Description</label>
                                    <textarea class="form-control" name="form[meta_description]" rows="3" id="meta_description" placeholder="">{{ $item['meta_description'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <textarea class="form-control" name="form[meta_keyword]" rows="3" id="meta_keyword" placeholder="">{{ $item['meta_keyword'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="x_panel">
                    <div class="x_content">
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-offset-3">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
