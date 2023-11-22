@php
    use App\Helper\Template;
@endphp
<form action="#" method="post" id="admin_Form">
    @csrf
    <div class="table-responsive">

        <table class="table table-striped jambo_table bulk_action list-content">
            <thead>
                <tr class="headings">
                    <th class="column-title"><input type="checkbox" id="check-all"></th>
                    <th class="column-title">ID</th>
                    <th class="column-title">Tên</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>

            @if ($items->count() > 0)
                @php
                    $i = 1;
                @endphp
                @foreach ($items as $key => $value)
                    @php
                        $class = $i % 2 ? 'even pointer' : 'odd pointer';
                        $id = $value->id;
                        $name = $value->name;
                        $description = $value->description;
                        $link = route($controllerName . 'changeStatus', ['status' => $value->status]);
                        $linkEdit = route($controllerName . 'edit', ['id' => $id]);
                        $status = Template::showStatus($value->status, $id, $link);
                        $updated_at = $value->updated_at;
                        $created_at = $value->created_at;
                        $i++;
                    @endphp
                    <tbody>
                        <tr class="{{ $class }}">
                            <td class=""><input name="cid[]" value="{{ $id }}" type="checkbox"></td>
                            <td class="">{{ $id }}</td>
                            <td width="10%"><a href="{{ $linkEdit }}">{{ $name }}</a></td>
                            <td>{!! $status !!}</td>
                            <td>
                                <p><i class="fa fa-user"></i> hailan</p>
                                <p><i class="fa fa-clock-o"></i>{{ $created_at }}</p>
                            </td>
                            <td>
                                <p><i class="fa fa-user"></i> admin</p>
                                <p><i class="fa fa-clock-o"></i> {{ $updated_at }}</p>
                            </td>

                            <td class="last">
                                <div class="zvn-box-btn-filter"><a href="/form/1" type="button"
                                        class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Edit">
                                        <i class="fa fa-pencil-square"></i>
                                    </a><a href="/delete/1" type="button" class="btn btn-icon btn-danger btn-delete"
                                        data-toggle="tooltip" data-placement="top" data-original-title="Delete">
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
