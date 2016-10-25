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
            <li class="{!! $segment == 'modules' ? 'active' : '' !!}">
                <a href="{!! url('modules') !!}">
                    <i class="fa fa-users"></i> <span>Modules</span>
                </a>
            </li>

            <li class="header">Setting</li>

            <li class="{!! $segment == 'config' ? 'active' : '' !!}">
                <a href="{!! url('modules/access') !!}">
                    <i class="fa fa-user-secret"></i> <span>Konfigurasi ACL</span>
                </a>
            </li>
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>