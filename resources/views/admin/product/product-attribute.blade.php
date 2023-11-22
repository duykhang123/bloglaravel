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


    <div class="row">
        <div class="col-md-8">
            <form id="demo-form2" method="POST" action="{{ route($controllerName . 'attribute', $product->id) }}"
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
                        <div id="product-attribute" class="content"
                            data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                            <div class="row">
                                <div class="col-md-12"><button type="button" id="btnAdd-1" class="btn btn-primary"> <i
                                            class="fa fa-plus"></i></button></div>
                            </div>
                            <div class="row group">
                                <div class="col-md-2">
                                    <label for="">Size</label>
                                    <input class="form-control" name="size[]" type="text">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Original Price</label>
                                    <input class="form-control" name="original_price[]" step="any" type="number">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Offer Price</label>
                                    <input class="form-control" name="price[]" step="any" type="number">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btnRemove"><i
                                            class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
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
            </form>
        </div>
        <div class="col-md-4">
            <div class="table-responsive">

                <table style="width: 100%" class="table table-striped jambo_table bulk_action list-content">
                    <thead>
                        <tr class="headings">
                            <th class="column-title">ID</th>
                            <th class="column-title">Size</th>
                            <th class="column-title">Original Price</th>
                            <th class="column-title">Offer Price</th>
                            <th class="column-title">Action</th>
                        </tr>
                    </thead>

                    @if ($attribute->count() > 0)
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($attribute as $key => $value)
                            @php
                                $class = $i % 2 ? 'even pointer' : 'odd pointer';
                                $id = $value->id;
                                $size = $value->size;
                                $original_price = $value->original_price;
                                $price = $value->price;

                                $i++;
                            @endphp
                            <tbody>
                                <tr class="{{ $class }}">
                                    <td>{{ $id }}</td>
                                    <td class="text-center">{{ $size }}</td>
                                    <td class="text-center">{{ $original_price }}</td>
                                    <td class="text-center">{{ $price }}</td>


                                    <td class="last">
                                        <div class="zvn-box-btn-filter">
                                            <form action="{{ route($controllerName . 'deleteOnly', $id) }}" method="post">
                                                @csrf
                                                <a href="" type="button"
                                                    class="dltBtn btn btn-icon btn-danger btn-delete" data-toggle="tooltip"
                                                    data-placement="top" data-id="{{ $id }}"
                                                    data-original-title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    @endif



                </table>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function(e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        })
    </script>
@endsection
