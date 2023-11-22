<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.component.header')
    <style>
        .ck-editor__editable_inline {
            height: 450px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    @include('admin.component.sidebar_title');
                    @include('admin.component.sidebar_menu');
                </div>
            </div>
            <div class="top_nav">
                @include('admin.component.sidebar_top')
            </div>
            <div class="right_col" role="main">
                @yield('main-content')
            </div>
            <footer>
                @include('admin.component.footer')
            </footer>
        </div>
    </div>
    @include('admin.component.script')
</body>

</html>
