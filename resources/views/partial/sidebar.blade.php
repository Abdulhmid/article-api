<?php $segment = GLobalHelper::indexUrl();; ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li class="header">Menu</li>
            <li class="{!! $segment == '' ? 'active' : '' !!}">
                <a href="{!! url('/home') !!}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{!! $segment == 'news' ? 'active' : '' !!}">
                <a href="{!! url('news') !!}">
                    <i class="fa fa-user"></i> <span>Berita</span>
                </a>
            </li>
            <li class="{!! $segment == 'products' ? 'active' : '' !!}">
                <a href="{!! url('products') !!}">
                    <i class="fa fa-car"></i> <span>Produk</span>
                </a>
            </li>
            <li class="{!! $segment == 'users' ? 'active' : '' !!}">
                <a href="{!! url('users') !!}">
                    <i class="fa fa-newspaper-o"></i> <span>Pengguna</span>
                </a>
            </li>

            <li class="header">Master</li>
            <li class="{!! $segment == 'groups' ? 'active' : '' !!}">
                <a href="{!! url('groups') !!}">
                    <i class="fa fa-users"></i> <span>Groups</span>
                </a>
            </li>
            <li class="{!! $segment == 'product-category' ? 'active' : '' !!}">
                <a href="{!! url('product-category') !!}">
                    <i class="fa  fa-flag"></i> <span>Kategori Produk</span>
                </a>
            </li>

            <li class="header">Setting</li>

            <li class="{!! $segment == 'config' ? 'active' : '' !!}">
                <a href="{!! url('config') !!}">
                    <i class="fa fa-user-secret"></i> <span>Tokayu Konfigurasi</span>
                </a>
            </li>
            <li class="{!! $segment == 'menu' ? 'active' : '' !!}">
                <a href="{!! url('menu') !!}">
                    <i class="fa fa-wrench"></i> <span>Menu</span>
                </a>
            </li>
            <li class="{!! $segment == 'app-version' ? 'active' : '' !!}">
                <a href="{!! url('app-version') !!}">
                    <i class="fa fa-mobile-phone"></i> <span>App Version</span>
                </a>
            </li>
            {{--<li class="{!! $segment == 'module-access' ? 'active' : '' !!}" style="display:none">--}}
                {{--<a href="{!! url('module-access') !!}">--}}
                    {{--<i class="fa fa-unlock"></i> <span>Group ACL</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>