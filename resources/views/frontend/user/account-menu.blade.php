<ul>
    <li class="{{\Request::is('user/dashboard') ? 'active' : ''}}"><a href="{{route('user.dashboard')}}">Dashboard</a></li>
    <li class="{{\Request::is('user/order') ? 'active' : ''}}"><a href="{{route('user.order')}}">Orders</a></li>
    <li class="{{\Request::is('user/addresses') ? 'active' : ''}}"><a href="{{route('user.addresses')}}">Addresses</a></li>
    <li class="{{\Request::is('user/details') ? 'active' : ''}}"><a href="{{route('user.details')}}">Account Details</a></li>
    <li><a href="{{route('login.logout')}}">Logout</a></li>
</ul>