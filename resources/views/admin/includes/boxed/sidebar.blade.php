<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('AdminLTE/dist/img/user3-128x128.jpg') }}" class="img-circle"
                     alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ ucfirst(Auth::user()->name) }}</p>
                <?php $groups = \App\user::$groups;?>
                <span><i class="fa fa-circle text-success"></i> {{ isset($groups[Auth::user()->group]) ? $groups[Auth::user()->group] : '--'}}</span>

            </div>
        </div>
        <?php $currentPath = Route::getFacadeRoot()->current()->uri();?>
        <ul class="sidebar-menu">

            <li class="header">MENU</li>
            <li class="@if ($currentPath == 'admin/order') active @endif">
                <a href="{{ url('admin/order') }}">
                    <i class="fa fa-thumb-tack" aria-hidden="true"></i> <span>{{ trans('lang.orders') }}</span>
                </a>
            </li>
            <li class="treeview @if ($currentPath == 'admin/coupons') active @endif">
                <a href="{{ url('admin/coupons') }}">
                    <i class="fa fa-cog"></i> <span>Phiếu giảm giá</span> 
                </a>
            </li>
            <li class="treeview @if ($currentPath == 'admin/product' || $currentPath == 'admin/product/create' || $currentPath == 'admin/product-category') active @endif">
                <a href="{{ url('admin/product') }}">
                    <i class="fa fa-cubes"></i> <span>Sản phẩm</span> <i
                            class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu">                    
                    <li><a href="{{ url('admin/product') }}"><i class="fa fa-caret-right"></i> Danh sách</a></li>
                    <li><a href="{{ url('admin/product/create') }}"><i class="fa fa-caret-right"></i> Thêm mới</a></li>
                </ul>
            </li>

            <li class="treeview @if ($currentPath == 'admin/article' || $currentPath == 'admin/article/create') active @endif">
                <a href="{{ url('admin/article') }}">
                    <i class="fa fa-newspaper-o"></i> <span>{{ trans('lang.news') }}</span> <i
                            class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu">                    
                    <li><a href="{{ url('admin/article') }}"><i class="fa fa-caret-right"></i> {{ trans('lang.list') }}</a></li>
                    <li><a href="{{ url('admin/article/create') }}"><i class="fa fa-caret-right"></i> {{ trans('lang.add_new') }}</a></li>
                </ul>
            </li>
            <li class="treeview @if ($currentPath == 'admin/page') active @endif">
                <a href="{{ url('admin/page') }}">
                    <i class="fa fa-tags"></i> <span>Trang đơn</span>
                    <i class="fa pull-right"></i>
                </a>
            </li>
            <li class="treeview @if ($currentPath == 'admin/contact') active @endif">
                <a href="{{ url('admin/contact') }}">
                    <i class="fa fa-tags"></i> <span>Liên hệ</span>
                    <i class="fa pull-right"></i>
                </a>
            </li>                         
            <li class="treeview @if ($currentPath == 'admin/user') active @endif">
                <a href="{{ url('admin/user') }}">
                    <i class="fa fa-user"></i> <span>{{ trans('lang.users') }}</span>
                    <i class="fa pull-right"></i>
                </a>
            </li>
            <li class="treeview @if ($currentPath == 'admin/comment') active @endif">
                <a href="{{ url('admin/comment') }}">
                    <i class="fa fa-comment-o"></i> <span>Bình luận</span>
                </a>
            </li>
            <li class="treeview @if ($currentPath == 'admin/menu') active @endif">
                <a href="{{ url('admin/menu') }}">
                    <i class="fa fa-tags"></i> <span>{{ trans('lang.menus') }}</span> 
                </a>
            </li>
            <li class="treeview @if ($currentPath == 'admin/banner') active @endif">
                <a href="{{ url('admin/banner') }}">
                    <i class="fa fa-tags"></i> <span>Quảng cáo</span>
                </a>
            </li>
            <li class="treeview @if ($currentPath == 'sitemap-builder') active @endif">
                <a href="{{ url('sitemap-builder') }}">
                    <i class="fa fa-tags"></i> <span>Cập nhật sitemap</span>
                </a>
            </li>            
            <li class="treeview @if ($currentPath == 'admin/setting') active @endif">
                <a href="{{ url('admin/setting') }}">
                    <i class="fa fa-cog"></i> <span>{{ trans('lang.settings') }}</span> 
                </a>
            </li>
        </ul>
    </section>
</aside>