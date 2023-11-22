@php
    use App\Template;
    use App\Models\ProductCategoryModel as MainModel;

    $categoryDefault = ['default' => '---Select Category Product---'];
    $categories = MainModel::where('status', 1)
        ->orderBy('id', 'DESC')
        ->get()
        ->pluck('name', 'id')
        ->toArray();

    $arrCategory = $categoryDefault + $categories;

    $brandDefault = ['default' => "---Select Brand---"];

    $brand = App\Models\BrandModel::where('status', 1)->orderBy('id','DESC')->get()->pluck('name','id')->toArray();
    $select_brand = Form::select('form[brand_id]', $brandDefault + $brand, $item['brand_id'], ['class' => 'form-control']);

    $select_status = Form::select('form[status]', config('myconfig.template.status'), $item['status'], ['class' => 'form-control']);

    $select_special = Form::select('form[special]', config('myconfig.template.special'), $item['special'], ['class' => 'form-control']);

    $select_size = Form::select('form[size]', config('myconfig.template.size'), $item['size'], ['class' => 'form-control']);
    $select_condition = Form::select('form[condition]', config('myconfig.template.condition'), $item['condition'], ['class' => 'form-control']);



    $select_category = Form::select('form[p_category_id]', $arrCategory, $item['p_category_id'], ['class' => 'form-control']);
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['name'] }}" type="text" name="form[name]" id="name"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Slug <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['slug'] }}" type="text" name="form[slug]" id="slug"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['price'] }}"  type="text" name="form[price]" id="price"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sale_off">Sale Off <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ $item['sale_off'] }}"  type="text" name="form[sale_off]" id="sale_off"
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Special <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! $select_special !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! $select_category !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Brand <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! $select_brand !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Size <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! $select_size !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Condition <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! $select_condition !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="avatar">Picture <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="form[picture]" onchange="loadFile(event)"
                                    class="form-control col-md-7 col-xs-12">
                                <img src="{{ $item->getImage() }}" style="width: 150px" id="output" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="avatar">Gallary <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input multiple type="file" name="gallary[]" onchange="readURL(this)"
                                    class="form-control col-md-7 col-xs-12">
                                <div class="images"></div>
                                @if (isset($item->gallary))
                                @php
                                    $gallary = unserialize($item->gallary);
                                @endphp
                                    @foreach ($gallary as $img)
                                        <img src="{{ asset('admin/img/product/thumb/' . $img) }}" style="width: 150px" id="output" />
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mô tả <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="form[description]" id="description">{{ $item['description'] }}</textarea>
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
                                    <textarea class="form-control" name="form[meta_title]" rows="2" id="meta_title" placeholder="">{{ $item['meta_title'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_desc">Meta Description</label>
                                    <textarea class="form-control" name="form[meta_description]" rows="3" id="meta_description" placeholder="">{{ $item['meta_description'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <textarea class="form-control" name="form[meta_keyword]" rows="3" id="meta_keyword" placeholder="">{{ $item['meta_keyword'] }}</textarea>
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
