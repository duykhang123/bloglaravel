@php
    use App\Template;
    use App\Models\CategoryModel as MainModel;

    $categoryDefault = ['default' => '---Select Category---'];
    $categories = MainModel::where('status', 1)
        ->orderBy('id', 'DESC')
        ->get()
        ->pluck('name', 'id')
        ->toArray();

    $arrCategory = $categoryDefault + $categories;

    $select_status = Form::select('form[status]', config('myconfig.template.status'), null, ['class' => 'form-control']);
    $select_category = Form::select('form[category_id]', $arrCategory, null, ['class' => 'form-control']);
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
    @endif

    <form id="demo-form2" method="POST" action="{{ route($controllerName . 'save') }}" enctype="multipart/form-data"
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
                                <input type="text" name="form[name]" id="name"
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! $select_category !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="avatar">Picture <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="form[picture]" onchange="loadFile(event)"
                                    class="form-control col-md-7 col-xs-12">
                                <img style="width: 150px" id="output" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mô tả <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="form[description]" id="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">Bài viết <span class="required">*</span>
                            </label>
                            <div class="">
                                <textarea id="main-content" style="height: 274px; width: 481px;" name="form[content]"></textarea>
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
                                    <textarea class="form-control" name="form[meta_title]" rows="2" id="meta_title" placeholder=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_desc">Meta Description</label>
                                    <textarea class="form-control" name="form[meta_description]" rows="3" id="meta_description" placeholder=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <textarea class="form-control" name="form[meta_keyword]" rows="3" id="meta_keyword" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>TAG</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="input-group">
                            <label>Add Tag:</label>
                            <input id="txtTag" type="text" class="form-control">
                            <div class="input-group-append">
                                <a href="javascript:addTag('{{ route('admin.tag.addTag') }}')"
                                    class="btn btn-success">Add</a>
                            </div>
                        </div>
                        <div id="listTag">
                            @php
                                use App\Models\TagModel as Tag;
                                $tags = Tag::orderBy('id', 'DESC')->get();
                            @endphp
                            @foreach ($tags as $item)
                                <div class="checkbox">
                                    <label><input name="tag_id[]" value="{{ $item->id }}"
                                            type="checkbox">{{ $item->name }}</label>
                                    <a
                                        href="javascript:removeTag('{{ route('admin.tag.removeTag') }}','{{ $item->id }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            @endforeach
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
