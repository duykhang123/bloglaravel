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
                    <th class="column-title">Danh Mục</th>
                    <th class="column-title">Thương hiệu</th>
                    <th class="column-title">Hình ảnh</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Nổi bật</th>
                    <th class="column-title">Size</th>
                    <th class="column-title">Condition</th>
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

                        $linkSpecial = route($controllerName . 'changeSpecial', ['special' => $value->special]);
                        $special = Template::showSpecial($value->special, $id, $linkSpecial);
                        $picture = $value->getImage();
                        $size = $value->size;
                        $condition = $value->condition;

                        $updated_at = $value->updated_at;
                        $created_at = $value->created_at;
                        $categoryName = $value->categories->name ?? '';
                        $brandName = $value->brands->name ?? '';

                        $i++;
                    @endphp
                    <tbody>
                        <tr class="{{ $class }}">
                            <td class=""><input name="cid[]" value="{{ $id }}" type="checkbox"></td>
                            <td class="">{{ $id }}</td>
                            <td width="10%"><a href="{{ $linkEdit }}">{{ $name }}</a></td>
                            <td>{{ $categoryName }}</td>
                            <td>{{ $brandName }}</td>
                            <td width="10%"><img style="width: 150px" src="{{ $picture }}" alt="admin"
                                    class="zvn-thumb"></td>
                            <td>{!! $status !!}</td>
                            <td>{!! $special !!}</td>
                            <td>{{ strtoupper($size) }}</td>
                            <td>
                                @if ($condition == 'new')
                                    <span class="badge badge-success">{{ strtoupper($condition) }}</span>
                                @elseif($condition == 'popular')
                                    <span class="badge badge-warning">{{ strtoupper($condition) }}</span>
                                @else
                                    <span class="badge badge-primary">{{ strtoupper($condition) }}</span>
                                @endif

                            </td>
                            <td>
                                <p><i class="fa fa-user"></i> hailan</p>
                                <p><i class="fa fa-clock-o"></i>{{ $created_at }}</p>
                            </td>
                            <td>
                                <p><i class="fa fa-user"></i> admin</p>
                                <p><i class="fa fa-clock-o"></i> {{ $updated_at }}</p>
                            </td>

                            <td class="last">
                                <div class="zvn-box-btn-filter">
                                    <a href="{{ route($controllerName . 'form', ['id' => $id]) }}" type="button"
                                        class="btn btn-icon btn-info btn-delete" data-toggle="tooltip"
                                        data-placement="top" data-original-title="Add Attribute">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a href="{{ route($controllerName . 'edit', ['id' => $id]) }}" type="button"
                                        class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Edit">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
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
{{ $items->links('vendor.pagination.bootstrap-4') }}


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
