@php
    $user = Auth::user();
@endphp
@auth
    <li class="user-title"><span>Hello,</span>{{$user->fullname}}</li>
    <li><a href="{{route('user.dashboard')}}">My Account</a></li>
    <li><a href="{{route('user.order')}}">Orders List</a></li>
    <li><a href="wishlist.html">Wishlist</a></li>
    <li><a href="{{ route('login.logout') }}"><i class="icofont-logout"></i> Logout</a></li>
@else
    <li><a href="{{ route('user.auth') }}">Login & Register</a></li>
@endauth
