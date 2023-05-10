<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('admin') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">ADMIN</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">ADMIN</span>        
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('AdminLTE/dist/img/user3-128x128.jpg') }}" class="user-image" alt="{{ ucfirst(Auth::user()->name) }}">
                        <span class="hidden-xs">{{ ucfirst(Auth::user()->name) }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('AdminLTE/dist/img/user3-128x128.jpg') }}" class="img-circle" alt="{{ ucfirst(Auth::user()->name) }} Avatar">
                            <p>
                                {{ ucfirst(Auth::user()->name) }} - {{ isset($groups[Auth::user()->group]) ? $groups[Auth::user()->group] : 'Admin'}}
                                <small>{{ trans('lang.register') }}: {{ date('d/m/Y', strtotime(Auth::user()->created_at))}}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('admin/profile/' . Auth::user()->id) }}" class="btn btn-default btn-flat">{{ trans('lang.profile') }}</a>
                                 <a href="{{ url('admin/user/change-password/' . Auth::user()->id)}}" class="btn btn-default btn-flat">{{ trans('lang.change_password') }}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/admin/auth/logout') }}" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> {{ trans('lang.exit') }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </nav>
</header>