<?php
$lms=['transaction-fee','transaction'];
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $site_setting->business_name??"" }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat text-sm" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{  route('dashboard') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('file.main_dashboard') }}
                        </p>
                    </a>
                </li>
                @include('includes.sidebar.mtms')
                <li class="nav-item has-treeview @if(in_array(Request::segment(1),$lms)) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa fa-chart-bar"></i>
                        <p>
                            Accounts
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('staff-salaries.index')}}" class="nav-link @if(Request::segment(1)=='profit-report') active @endif">
                                <i class="nav-icon fas fa-angle-double-right fa-xs"></i>
                                <p>Staff Salaries</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('expenses.index')}}" class="nav-link @if(Request::segment(1)=='profit-report') active @endif">
                                <i class="nav-icon fas fa-angle-double-right fa-xs"></i>
                                <p>Expenses</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @include('includes.sidebar.setting')
            </ul>
            </li>
            @can('profit_report')
                <li class="nav-item has-treeview @if(in_array(Request::segment(1),$lms)) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa fa-file"></i>
                        <p>
                            Reports
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('profit.report')}}" class="nav-link @if(Request::segment(1)=='profit-report') active @endif">
                                <i class="nav-icon fas fa-angle-double-right fa-xs"></i>
                                <p>Profit Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>