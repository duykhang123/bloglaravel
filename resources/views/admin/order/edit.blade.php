@php
    use App\Template;
    $select_status = Form::select('form[status]', config('myconfig.template.status'), $order['status'], ['class' => 'form-control']);
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



    <form id="demo-form2" method="POST" action="{{ route($controllerName . 'edit', ['id' => $order['id']]) }}"
        enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
        @csrf
        <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action list-content">
                <thead>
                    <tr class="headings">
                        <th class="column-title">ID</th>
                        <th class="column-title">Name</th>
                        <th class="column-title">Email</th>
                        <th class="column-title">Payment Method</th>
                        <th class="column-title">Payment status</th>
                        <th class="column-title">Total</th>
                        <th class="column-title">Status</th>
                        <th class="column-title">Action</th>
                    </tr>
                </thead>
                @if ($order->count() > 0)
                    @php
                        $i = 1;
                    @endphp
                    @php
                        $class = $i % 2 ? 'even pointer' : 'odd pointer';
                        $id = $order->id;
                        $name = $order->name;
                        $email = $order->email;
                        $payment_method = $order->payment_method;
                        $payment_status = $order->payment_status;
                        $total_amount = $order->total_amount;
                        $condition = $order->condition;
                        // $link = route($controllerName . 'changeStatus', ['status' => $order->status]);
                        //$linkEdit = route($controllerName . 'edit', ['id' => $id]);
                        //$status = Template::showStatus($order->status, $id, $link);
                        $updated_at = $order->updated_at;
                        $created_at = $order->created_at;

                        $i++;
                    @endphp
                    <tbody>
                        <tr class="{{ $class }}">
                            <td class="">{{ $id }}</td>
                            <td width="10%"><a href="#">{{ $name }}</a></td>
                            <td>{{ $email }}</td>
                            <td>{{ $payment_method == 'cod' ? 'Cash on Delivery' : $payment_method }}</td>
                            <td>{{ $payment_status }}</td>
                            <td>{{ $total_amount }}</td>
                            <td>
                                <span
                                    class="badge @if ($condition == 'pending') badge-info
                                        @elseif($condition == 'processing')
                                        badge-primary
                                        @elseif($condition == 'delivered')
                                        badge-success
                                        @else
                                        badge-danger @endif
                                    ">{{ $condition }}</span>
                            </td>

                            <td class="last">
                                <div class="zvn-box-btn-filter"><a href="/form/1" type="button"
                                        class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Edit">
                                        <i class="fa fa-download"></i>
                                    </a><a href="/delete/1" type="button" class="btn btn-icon btn-danger btn-delete"
                                        data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @endif

            </table>

            <table class="table table-striped jambo_table bulk_action list-content">
                <thead>
                    <tr class="headings">
                        <th class="column-title">ID</th>
                        <th class="column-title">Product Image</th>
                        <th class="column-title">Product</th>
                        <th class="column-title">Quantity</th>
                        <th class="column-title">Price</th>
                        <th class="column-title">Total Amount</th>
                    </tr>
                </thead>
                @foreach ($order->products as $item)
                    @php
                        $i = 1;
                    @endphp
                    @php
                        $class = $i % 2 ? 'even pointer' : 'odd pointer';
                        $id = $item->id;
                        $name = $item->name;
                        $image = $item->getImage();
                        $quantity = $item->pivot->quantity;
                        $price = $item->price;
                        $total_amount = $order->total_amount;

                        $i++;
                    @endphp
                    <tbody>
                        <tr class="{{ $class }}">
                            <td class="">{{ $id }}</td>
                            <td width="10%"><img style="width: 150px" src="{{ $image }}" alt="admin"
                                    class="zvn-thumb"></td>
                            <td><a href="#">{{ $name }}</a></td>
                            <td>{{ $quantity }}</td>
                            <td>{{ $price }}</td>
                            <td>{{ $total_amount }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </form>
    <div class="row">
        <div class="col-md-7">

        </div>
        <div class="col-md-5 border py-3">
            <p>
                <strong>Subtotal</strong>: ${{$order->sub_total}}
            </p>
            @if ($order->delivery_charge > 0)
            <p>
                <strong>Shipping cost</strong>: ${{$order->delivery_charge}}
            </p>
            @endif
            @if ($order->coupon > 0)
            <p>
                <strong>Coupon</strong>: ${{$order->coupon}}
            </p>
            @endif
            <p>
                <strong>Total</strong>: ${{$order->total_amount}}
            </p>
            <form action="{{route($controllerName . 'editCondition')}}" method="post">
                @csrf
                <strong>Status</strong>
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <select name="condition" id="condition" class="form-control">
                    <option value="pending" {{$order->condition == 'cancelled' || $order->condition == 'delivered' ? 'disabled' : ''}} {{$order->condition == 'pending' ? 'selected' : ''}}>Pending</option>
                    <option value="processing" {{$order->condition == 'cancelled' || $order->condition == 'delivered' ? 'disabled' : ''}}  {{$order->condition == 'processing' ? 'selected' : ''}}>Processing</option>
                    <option value="delivered" {{$order->condition == 'cancelled' ? 'disabled' : ''}} {{$order->condition == 'delivered' ? 'selected' : ''}}>Delivered</option>
                    <option value="cancelled" {{$order->condition == 'delivered' ? 'disabled' : ''}} {{$order->condition == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                </select>
                <button type="submit" class="btn btn-sm btn-success">Update</button>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <link href="{{ asset('admin/css/main.css') }}" rel="stylesheet">
@endsection
