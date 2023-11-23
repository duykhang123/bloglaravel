@php
    use App\Helper\Template;
@endphp
<form action="#" method="post" id="admin_Form">
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
                @foreach ($order as $key => $value)
                    @php
                        $class = $i % 2 ? 'even pointer' : 'odd pointer';
                        $id = $value->id;
                        $name = $value->name;
                        $email = $value->email;
                        $payment_method = $value->payment_method;
                        $payment_status = $value->payment_status;
                        $total_amount = $value->total_amount;
                        $condition = $value->condition;
                        // $link = route($controllerName . 'changeStatus', ['status' => $value->status]);
                        //$linkEdit = route($controllerName . 'edit', ['id' => $id]);
                        //$status = Template::showStatus($value->status, $id, $link);
                        $updated_at = $value->updated_at;
                        $created_at = $value->created_at;

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
                                <div class="zvn-box-btn-filter"><a href="{{route($controllerName . 'edit',$id)}}" type="button"
                                        class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Edit">
                                        <i class="fa fa-pencil-square"></i>
                                    <a href="{{ route($controllerName . 'deleteOnly', $id) }}" data-title-modal="Are you sure you want to delete <?= $name ?>?" class="my-confirm btn btn-icon btn-danger btn-delete"
                                        data-original-title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @endforeach

            @endif

        </table>
    </div>
</form>
@section('css')
<link href="{{ asset('admin/css/main.css') }}" rel="stylesheet">
@endsection