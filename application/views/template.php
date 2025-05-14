

<!DOCTYPE html>
<html lang="en" data-menu-color="dark">
<head>
    <meta charset="utf-8" />
<title><?php echo $this->config->item('site_name'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
<meta content="Techzaa" name="author" />

<!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo-atas.jpeg') ?>">
<!-- Daterangepicker css -->
    <link href="<?= base_url('assets/css/vendor/daterangepicker.css'); ?>" rel="stylesheet" type="text/css" />

<!-- Vector Map css -->
    <link href="<?= base_url('assets/css/jquery-jvectormap-1.2.2.css'); ?>" rel="stylesheet" type="text/css" />

<!-- Theme Config Js -->
    <script src="<?php echo base_url('assets/js/config.js');?>"></script>

<!-- Flatpickr Timepicker css -->
    <link href="<?= base_url('assets/css/vendor/flatpickr.min.css'); ?>" rel="stylesheet" type="text/css" />

<!-- Bootstrap Timepicker css -->
    <link href="<?= base_url('assets/css/vendor/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" type="text/css" />

<!-- Icons css -->
    <link href="<?= base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />

<!-- App css -->
    <link href="<?= base_url('assets/css/app.min.css'); ?>" rel="stylesheet" type="text/css" id="app-style" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
<!-- Datatables css -->
    <link href="<?= base_url('assets/css/vendor/dataTables.bootstrap5.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/vendor/responsive.bootstrap5.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/vendor/fixedColumns.bootstrap5.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/vendor/fixedHeader.bootstrap5.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/vendor/buttons.bootstrap5.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/vendor/select.bootstrap5.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/vendor/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/jquery.tagsinput.css'); ?>" rel="stylesheet" type="text/css" />
<!-- sweetalert css -->
    <script src="<?php echo base_url('assets/sweetalert/sweetalert2@11.js');?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert/sweetalert.css'); ?>">
    <script src="<?php echo base_url('assets/sweetalert/sweetalert.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-2.1.1.js'); ?>"></script>
<!-- Bootstrap Datepicker css -->
    <link href="<?= base_url('assets/css/vendor/bootstrap-datepicker.min.css'); ?>" rel="stylesheet" type="text/css" />
<!-- Bootstrap Timepicker css -->
    <link href="<?= base_url('assets/css/vendor/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
    <!-- Begin page -->
    <div class="wrapper">

        
<!-- ========== Topbar Start ========== -->
<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="index.php" class="logo-light">
                    <span class="logo-lg">
                        <img src="<?php echo base_url('assets/images/logo/logo.png') ?>" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="<?php echo base_url('assets/images/logo/logo-sm.png') ?>" alt="small logo">
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="index.php" class="logo-dark">
                    <span class="logo-lg">
                        <img src="<?php echo base_url('assets/images/logo/logo-dark.png') ?>" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="<?php echo base_url('assets/images/logo/logo-sm.png') ?>" alt="small logo">
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="ri-menu-line"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

            
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode">
                    <i class="ri-moon-line fs-22"></i>
                </div>
            </li>
            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <span class="d-lg-block">
                        <h5 class="my-0 fw-normal"><?php echo $this->session->userdata('nama_user'); ?> <i
                                class="ri-arrow-down-s-line d-sm-inline-block align-middle"></i></h5>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0"><?php echo $this->session->userdata('role'); ?></h6>
                    </div>
                    <!-- item-->
                    <a href="<?php echo base_url("login/doLogout"); ?>" class="dropdown-item">
                        <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                        <span>Logouts</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- ========== Topbar End ========== -->
<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="index.php" class="logo logo-light">
        <span class="logo-lg">
            <img src="<?php echo base_url('assets/images/logo-putih.png') ?>" alt="logo" class="img-fluid rounded h-100" style="height: 50px;">
        </span>
        <span class="logo-sm">
            <img src="<?php echo base_url('assets/images/logo-sm.png') ?>" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.php" class="logo logo-dark">
        <span class="logo-lg">
            <img src="<?php echo base_url('assets/images/logo-tengah.png') ?>" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="<?php echo base_url('assets/images/logo-sm.png') ?>" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-title">Main</li>
            <?php $menu = $this->uri->segment('1'); $submenu = $this->uri->segment('2');?>
            <li <?php if($menu == "dashboard"){ echo "class='side-nav-item menuitem-active'";} ?> class="side-nav-item">
                <a href="<?php echo base_url("dashboard"); ?>" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            <?php if($this->session->userdata('role') == 'SUPERADMIN'){ ?>
                <li <?php if($menu == "performa" || $menu == "tiktok"){ echo "class='side-nav-item menuitem-active'"; } ?> >
                    <a data-bs-toggle="collapse" href="#sidebarMultiLevel" aria-expanded="false" aria-controls="sidebarMultiLevel" class="side-nav-link">
                        <i class="ri-database-2-line"></i>
                        <span> Data </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMultiLevel">
                        <ul class="side-nav-second-level">
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false" aria-controls="sidebarSecondLevel">
                                    <span> Shopee </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSecondLevel">
                                    <ul class="side-nav-third-level">
                                        <li <?php if($menu == "performa"){ echo "class='side-nav-item'";} ?>>
                                            <a href="<?php echo base_url('performa') ?>"> Data Performa</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li <?php if($menu == "shopee" || $menu == "tiktok"){ echo "class='side-nav-item menuitem-active'"; } ?> class="side-nav-item">
                <a data-bs-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="setting" class="side-nav-link">
                    <i class="ri-settings-3-line"></i>
                    <span> Setting </span>
                    <span class="menu-arrow"></span>
                </a>
                    <div class="collapse" id="setting">
                        <ul class="side-nav-second-level">
                            <li <?php if($menu == "shopee"){ echo "class='side-nav-item'";} ?>><a href="<?php echo base_url('shopee') ?>"> Shopee</a></li>
                            <li <?php if($menu == "tiktok"){ echo "class='side-nav-item'";} ?>><a href="<?php echo base_url('tiktok') ?>">Tik Tok</a></li>
                    </div>
                </li>
                <li <?php if($menu == "user"){ echo "class='side-nav-item menuitem-active'";} ?> class="side-nav-item">
                    <a href="<?php echo base_url("user"); ?>" class="side-nav-link">
                        <i class="bi bi-person-vcard"></i>
                        <span> User </span>
                    </a>
                </li>
            <?php } ?> 
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
                    <?= $contents; ?>
            <!-- content -->

            <!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <script>document.write(new Date().getFullYear())</script> <?php echo $this->config->item('site_name'); ?> developed by <a href="https://emcorpstudio.com">Emcorp Studio</a>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
    <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
        <h5 class="text-white m-0">Theme Settings</h5>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div data-simplebar class="h-100">
            <div class="p-3">
                <h5 class="mb-3 fs-16 fw-bold">Color Scheme</h5>

                <div class="row">
                    <div class="col-4">
                        <div class="form-check form-switch card-switch mb-1">
                            <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-light" value="light">
                            <label class="form-check-label" for="layout-color-light">
                                <img src="assets/images/layouts/light.png" alt="" class="img-fluid">
                            </label>
                        </div>
                        <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                    </div>

                    <div class="col-4">
                        <div class="form-check form-switch card-switch mb-1">
                            <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-dark" value="dark">
                            <label class="form-check-label" for="layout-color-dark">
                                <img src="assets/images/layouts/dark.png" alt="" class="img-fluid">
                            </label>
                        </div>
                        <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                    </div>
                </div>

                <div id="layout-width">
                    <h5 class="my-3 fs-16 fw-bold">Layout Mode</h5>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check form-switch card-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-layout-mode" id="layout-mode-fluid" value="fluid">
                                <label class="form-check-label" for="layout-mode-fluid">
                                    <img src="assets/images/layouts/light.png" alt="" class="img-fluid">
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Fluid</h5>
                        </div>

                        <div class="col-4">
                            <div id="layout-boxed">
                                <div class="form-check form-switch card-switch mb-1">
                                    <input class="form-check-input" type="checkbox" name="data-layout-mode" id="layout-mode-boxed" value="boxed">
                                    <label class="form-check-label" for="layout-mode-boxed">
                                        <img src="assets/images/layouts/boxed.png" alt="" class="img-fluid">
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Boxed</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="my-3 fs-16 fw-bold">Topbar Color</h5>

                <div class="row">
                    <div class="col-4">
                        <div class="form-check form-switch card-switch mb-1">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-light" value="light">
                            <label class="form-check-label" for="topbar-color-light">
                                <img src="assets/images/layouts/light.png" alt="" class="img-fluid">
                            </label>
                        </div>
                        <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                    </div>

                    <div class="col-4">
                        <div class="form-check form-switch card-switch mb-1">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-dark" value="dark">
                            <label class="form-check-label" for="topbar-color-dark">
                                <img src="assets/images/layouts/topbar-dark.png" alt="" class="img-fluid">
                            </label>
                        </div>
                        <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                    </div>
                </div>

                <div>
                    <h5 class="my-3 fs-16 fw-bold">Menu Color</h5>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check form-switch card-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-light" value="light">
                                <label class="form-check-label" for="leftbar-color-light">
                                    <img src="assets/images/layouts/sidebar-light.png" alt="" class="img-fluid">
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check form-switch card-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-dark" value="dark">
                                <label class="form-check-label" for="leftbar-color-dark">
                                    <img src="assets/images/layouts/light.png" alt="" class="img-fluid">
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                        </div>
                    </div>
                </div>

                <div id="sidebar-size">
                    <h5 class="my-3 fs-16 fw-bold">Sidebar Size</h5>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check form-switch card-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-default" value="default">
                                <label class="form-check-label" for="leftbar-size-default">
                                    <img src="assets/images/layouts/light.png" alt="" class="img-fluid">
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Default</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check form-switch card-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-compact" value="compact">
                                <label class="form-check-label" for="leftbar-size-compact">
                                    <img src="assets/images/layouts/compact.png" alt="" class="img-fluid">
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Compact</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check form-switch card-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-small" value="condensed">
                                <label class="form-check-label" for="leftbar-size-small">
                                    <img src="assets/images/layouts/sm.png" alt="" class="img-fluid">
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Condensed</h5>
                        </div>


                        <div class="col-4">
                            <div class="form-check form-switch card-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-full" value="full">
                                <label class="form-check-label" for="leftbar-size-full">
                                    <img src="assets/images/layouts/full.png" alt="" class="img-fluid">
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Full Layout</h5>
                        </div>
                    </div>
                </div>

                <div id="layout-position">
                    <h5 class="my-3 fs-16 fw-bold">Layout Position</h5>

                    <div class="btn-group checkbox" role="group">
                        <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed" value="fixed">
                        <label class="btn btn-soft-primary w-sm" for="layout-position-fixed">Fixed</label>

                        <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                        <label class="btn btn-soft-primary w-sm ms-0" for="layout-position-scrollable">Scrollable</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-footer border-top p-3 text-center">
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
            </div>
            <div class="col-6">
                <a href="https://1.envato.market/velonic" target="_blank" role="button" class="btn btn-primary w-100">Buy Now</a>
            </div>
        </div>
    </div>
</div>
<!-- Vendor js -->
    <script src="<?php echo base_url('assets/js/vendor.min.js'); ?>"></script>
<!-- Daterangepicker js -->
    <script src="<?php echo base_url('assets/js/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/daterangepicker.js'); ?>"></script>

<!-- Vector Map js -->
    <script src="<?php echo base_url('assets/js/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<!-- Dashboard App js -->
    <!-- <script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script> -->
    <script src="<?php echo base_url('assets/js/source/dashboard.js'); ?>"></script>
<!-- App js -->
    <script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>
<!-- Datatables js -->
    <script src="<?php echo base_url('assets/js/vendor/datatable.init.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/dataTables.bootstrap5.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/responsive.bootstrap5.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/fixedColumns.bootstrap5.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/dataTables.fixedHeader.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/buttons.bootstrap5.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/buttons.flash.min.js'); ?>"></script>
    <!-- <script src="assets/js/vendor/buttons.php5.min.js"></script> -->
    <script src="<?php echo base_url('assets/js/vendor/buttons.print.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/dataTables.keyTable.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/dataTables.select.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/select2.min.js'); ?>"></script>
    
<!-- Dropzone File Upload js -->
    <script src="<?php echo base_url('assets/js/vendor/dropzone.min.js'); ?>"></script>
<!-- File Upload Demo js -->
    <script src="<?php echo base_url('assets/js/vendor/fileupload.init.js'); ?>"></script>
<!-- Bootstrap Datepicker Plugin js -->
    <script src="<?php echo base_url('assets/js/vendor/bootstrap-datepicker.min.js'); ?>"></script>
<!-- Apex Charts js -->
    <script src="<?php echo base_url('assets/js/apexcharts.min.js'); ?>"></script>
<!-- Apex Chart Area Demo js -->
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <script src="https://apexcharts.com/samples/assets/series1000.js"></script>
    <script src="https://apexcharts.com/samples/assets/github-data.js"></script>
    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<!-- Apex Chart Candlestick Demo js -->
    <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.8.17/dayjs.min.js"></script>

    <script src="<?php echo base_url('assets/js/source/apex.init.js'); ?>"></script>

<!-- Flatpickr Timepicker Plugin js -->
    <script src="<?php echo base_url('assets/js/vendor/flatpickr.min.js'); ?>"></script>
    
<!-- Bootstrap Timepicker Plugin js -->
    <script src="<?php echo base_url('assets/js/vendor/bootstrap-timepicker.min.js'); ?>"></script>

<!-- Timepicker Demo js -->
    <script src="<?php echo base_url('assets/js/vendor/timepicker.init.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/jquery.tagsinput.js'); ?>"></script>
    
    <!-- Input Mask Plugin js -->
    <script src="<?php echo base_url('assets/js/vendor/jquery.mask.min.js'); ?>"></script>

</body>

</html>