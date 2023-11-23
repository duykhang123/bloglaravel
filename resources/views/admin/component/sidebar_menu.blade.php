<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li class="{{$linkView == 'dashboard' ? 'current-page' : ''}}"><a href="{{route('admin.dashboard.index')}}"><i class="fa fa-home"></i> Home</a></li>
            <li class="{{$linkView == 'banner' ? 'current-page' : ''}}"><a href="{{route('admin.banner.index')}}"><i class="fa fa-sliders"></i> Silders</a></li>
            <li class="{{$linkView == 'user' ? 'current-page' : ''}}"><a href="{{route('admin.user.index')}}"><i class="fa fa-user"></i> User</a></li>
            <li class="{{$linkView == 'brand' ? 'current-page' : ''}}"><a href="{{route('admin.brand.index')}}"><i class="fa fa fa-building-o"></i> Thương hiệu</a></li>
            <li class="{{$linkView == 'productcategory' ? 'current-page' : ''}}"><a href="{{route('admin.productcategory.index')}}" ><i class="fa fa fa-building-o"></i> Danh mục sản phẩm</a></li>
            <li class="{{$linkView == 'order' ? 'current-page' : ''}}"><a href="{{route('admin.order.index')}}" ><i class="fa fa fa-building-o"></i> Order</a></li>
            <li class="{{$linkView == 'currency' ? 'current-page' : ''}}"><a href="{{route('admin.currency.index')}}" ><i class="fa fa fa-building-o"></i> Currency</a></li>
            <li class="{{$linkView == 'coupon' ? 'current-page' : ''}}"><a href="{{route('admin.coupon.index')}}" ><i class="fa fa fa-building-o"></i> Coupon</a></li>
            <li class="{{$linkView == 'product' ? 'current-page' : ''}}"><a href="{{route('admin.product.index')}}" ><i class="fa fa fa-building-o"></i> Sản phẩm</a></li>
            <li class="{{$linkView == 'shipping' ? 'current-page' : ''}}"><a href="{{route('admin.shipping.index')}}" ><i class="fa fa fa-building-o"></i> Shipping</a></li>
            <li class="{{$linkView == 'category' ? 'current-page' : ''}}"><a href="{{route('admin.category.index')}}" ><i class="fa fa fa-building-o"></i> Category</a></li>
            <li class="{{$linkView == 'post' ? 'current-page' : ''}}"><a href="{{route('admin.post.index')}}"><i class="fa fa-newspaper-o"></i> Article</a></li>
            <li class="{{$linkView == 'aboutus' ? 'current-page' : ''}}"><a href="{{route('admin.aboutus.form')}}"><i class="fa fa-newspaper-o"></i> About Us</a></li>
            <li class="{{$linkView == 'smtp' ? 'current-page' : ''}}"><a href="{{route('admin.smtp.form')}}" ><i class="fa fa fa-building-o"></i> Smtp Setting</a></li>
        </ul>
    </div>
</div>
