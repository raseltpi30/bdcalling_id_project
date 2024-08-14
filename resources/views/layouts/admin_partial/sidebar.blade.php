<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link text-center">
        <img src="" alt="Logo" class="img-circle" style="margin-right:10px">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="text-center">
                <a href="#" class="">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.home') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Setting Module
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('country.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Country</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('city.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>City</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('PropertyType.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Property Type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('PropertySize.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Property Size</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aminities</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- offer for project  --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Property
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('property.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Property</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('property.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Property</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.userManage') }}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">User Mange</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.bidManage') }}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Bid Manage</p>
                    </a>
                </li>

                <li class="nav-header">POFILE</li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" id="logout" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.password.change') }}" id="password" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Password Change</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
