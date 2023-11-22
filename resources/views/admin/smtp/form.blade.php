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
                <li class="zvn-breadcrumb-item">Sửa
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
            <div class="col-md-12">
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
                            <div class="row">
                                <input type="hidden" name="types[]" value="MAIL_DRIVER">
                                <div class="col-md-3">
                                    <label for="">Type</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="form[MAIL_DRIVER]" id="" class="form-control"
                                        onchange="checkMailDriver()">
                                        <option value="sendmail" @if (env('MAIL_DRIVER') == 'sendmail') selected @endif>Sendmail
                                        </option>
                                        <option value="smtp" @if (env('MAIL_DRIVER') == 'smtp') selected @endif>Smtp
                                        </option>
                                        <option value="mailgun" @if (env('MAIL_DRIVER') == 'mailgun') selected @endif>Mailgun
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="smtp">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MAIL_HOST">
                                <div class="col-md-3">
                                    <label for="">MAIL HOST</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="form[MAIL_HOST]"
                                        value="{{ env('MAIL_HOST') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MAIL_PORT">
                                <div class="col-md-3">
                                    <label for="">MAIL POST</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="form[MAIL_PORT]"
                                        value="{{ env('MAIL_PORT') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                                <div class="col-md-3">
                                    <label for="">MAIL ENCRYPTION</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="form[MAIL_ENCRYPTION]"
                                        value="{{ env('MAIL_ENCRYPTION') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                <div class="col-md-3">
                                    <label for="">MAIL USERNAME</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="form[MAIL_USERNAME]"
                                        value="{{ env('MAIL_USERNAME') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                <div class="col-md-3">
                                    <label for="">MAIL PASSWORD</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="form[MAIL_PASSWORD]"
                                        value="{{ env('MAIL_PASSWORD') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                                <div class="col-md-3">
                                    <label for="">MAIL FROM ADDRESS</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="form[MAIL_FROM_ADDRESS]"
                                        value="{{ env('MAIL_FROM_ADDRESS') }}">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div id="mailgun">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                                <div class="col-md-3">
                                    <label for="">MAILGUN DOMAIN</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="form[MAILGUN_DOMAIN]"
                                        value="{{ env('MAILGUN_DOMAIN') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                                <div class="col-md-3">
                                    <label for="">MAILGUN SECRET</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="form[MAILGUN_SECRET]"
                                        value="{{ env('MAILGUN_SECRET') }}">
                                </div>
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


@section('script')
    <script>
        $(document).ready(function() {
            checkMailDriver();
        })

        function checkMailDriver() {
            if ($('select[name="form[MAIL_DRIVER]"]').val() == 'mailgun') {
                $('#mailgun').show();
                $('#smtp').hide();
            } else {
                $('#smtp').show();
                $('#mailgun').hide();
            }
        }
    </script>
@endsection
