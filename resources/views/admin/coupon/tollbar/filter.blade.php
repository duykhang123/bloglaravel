@php
    use App\Template;

    $select_status = Form::select('select_filter', config('myconfig.template.status'), $params['select_filter']['status'], ['class' => 'form-control']);

    $select_filter = [
        'all' => 'All',
        'id' => 'Id',
        'name' => 'Tên',
        'description' => 'Mô tả',
    ];

@endphp

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Bộ lọc</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-md-6"><a href="?select_filter=default" type="button" class="btn btn-primary">
                        All <span class="badge bg-white">{{$items->count()}}</span>
                    </a><a href="?select_filter=1" type="button" class="btn btn-success">
                        Active <span class="badge bg-white">{{$items->where('status',1)->count()}}</span>
                    </a><a href="?select_filter=0" type="button" class="btn btn-success">
                        Inactive <span class="badge bg-white">{{$items->where('status',0)->count()}}</span>
                    </a>
                </div>
                <form id="adminForm" action="{{ route($controllerName . 'index') }}">

                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button id="option-select" type="button" class="btn btn-default dropdown-toggle btn-active-field"
                                    data-toggle="dropdown" aria-expanded="false">
                                    Search by {{$select_filter[$params['search']['field']]}} <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    @foreach ($select_filter as $key => $value)
                                        <li><a href="javascript:changeField('{{ $key }}','{{$value}}')" class="select-field"
                                                value="{{ $key }}">{{ $value }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <input type="text" class="form-control" name="search_value" value="{{$params['search']['value']}}">
                            <span class="input-group-btn">
                                <a href="javascript:clearForm()" class="btn btn-success"
                                    style="margin-right: 0px">Xóa tìm kiếm</a>
                                <button id="btn-search" type="submit" class="btn btn-primary">Tìm
                                    kiếm</button>
                            </span>
                            <input type="hidden" name="search_field" value="{{$params['search']['field']}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        {!! $select_status !!}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
