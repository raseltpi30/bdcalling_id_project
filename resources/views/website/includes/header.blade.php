<!-- Start Header area  -->
<header class="header-area">
    <div class="container">
        <div class="header-top">
            <div class="nav menu-1">
                <ul>
                    <li><a href="">buy</a></li>
                    <li><a href="">sell</a></li>
                    <li><a href="">services</a></li>
                </ul>

            </div>
            <div class="logo">
                <div class="logo-side">
                    <a href=""><img
                            src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6621148aee02d0fde5537ee1_Hertiage%20Nest%20-%20Final%20LOGO%20(1)%201.png"
                            alt="Logo here"></a>
                </div>
                <div class="mobile-menu-btns">
                    <a href="#" class="menu_icon"><i class="fa-solid fa-bars"></i></a>
                </div>
            </div>
            <div class="menus">
                <nav class="nav menu menu-2">
                    <ul>
                        <li><a href="">Manage Rentgals</a></li>
                        @if (Session::get('customer_id'))
                            <li><a href="{{route('customer.logout')}}">{{ Session::get('customer_name') }}</a></li>
                        @else
                            <li><a href="{{ route('customer.login') }}">login</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
</header>
<!-- Start Header area  -->
