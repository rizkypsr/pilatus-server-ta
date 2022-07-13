<template>
    <div class="sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">

                <!-- Right navbar links -->
                <ul class="ml-auto navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <Link :href="route('admin.dashboard')" class="text-center brand-link">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
                </Link>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="pb-3 mt-3 mb-3 text-center user-panel">
                        <div class="info">
                            <a href="#" class="">Alexander Pierce</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">

                            <li class="nav-item">
                                <Link :href="route('admin.dashboard')" class="nav-link"
                                    :class="route().current('admin.dashboard') && 'active'">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('users.index')" class="nav-link"
                                    :class="route().current('users.index') && 'active'">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Users
                                </p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('products.index')" class="nav-link"
                                    :class="route().current('products.index') && 'active'">
                                <i class="nav-icon fas fa-shopping-bag"></i>
                                <p>
                                    Produk
                                </p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('categories.index')" class="nav-link"
                                    :class="route().current('categories.index') && 'active'">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                    Kategori
                                </p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('orders.index')" class="nav-link"
                                    :class="route().current('orders.index') && 'active'">
                                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                <p>
                                    Transaksi
                                </p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('reports.index')" class="nav-link"
                                    :class="route().current('reports.index') && 'active'">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Laporan
                                </p>
                                </Link>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <slot name="header"></slot>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')">Home</Link>
                                    </li>
                                    <slot name="breadcrumb">
                                    </slot>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        <slot></slot>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.2.0
                </div>
            </footer>
        </div>
    </div>
</template>