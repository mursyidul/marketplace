<!DOCTYPE html>
<html lang="en" data-menu-color="dark">

<head>
    <meta charset="utf-8" />
    <title><?php echo $this->config->item('site_name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo-atas.jpeg'); ?>">
    <!-- Theme Config Js -->
    <script src="<?php echo base_url('assets/js/config.js');?>"></script>

    <!-- Icons css -->
    <link href="<?= base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?= base_url('assets/css/app.min.css'); ?>" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="<?php echo base_url('assets/images/auth-img.jpg');?>"  alt="" class="img-fluid rounded h-100">
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand mt-2">
                                        <center>
                                            <a href="#" class="logo-dark">
                                            <img src="<?php echo base_url('assets/images/logo-tengah.png');?>" alt="dark logo" height="50">
                                            </a>
                                        </center>
                                    </div>
                                    <div class="ms-4 me-4 my-auto">
                                        <?php if ($this->session->flashdata('error')) { ?>
                                            <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                                <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                        <?php } ?>
                                        <h4 class="fs-20">Register</h4>
                                        <p class="text-muted mb-3">Masukkan name, email, phone dan password anda
                                        </p>
                                        <!-- form -->
                                        <form role="form" action="<?php echo base_url("register/action") ?>" method="POST">
                                            <div class="mb-3">
                                                <label for="nameaddress" class="form-label">Username</label>
                                                <input class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" required>
                                                <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email</label>
                                                <input class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email" required>
                                                <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phoneaddress" class="form-label">Phone</label>
                                                <input class="form-control" type="number" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="Phone" required>
                                                <?php echo form_error('phone', '<small class="text-danger">', '</small>'); ?>
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password" name="password" class="form-control"
                                                        placeholder="Password" required>
                                                </div>
                                                <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Confirmation Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password" name="password_confirm" class="form-control"
                                                        placeholder="Konfirmasi Password" required>
                                                </div>
                                                <?php echo form_error('password_confirm', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Register</span> </button>
                                            </div>
                                        </form>
                                        <!-- end form-->
                                        <center>
                                        <br>
                                        <b><?php echo $this->config->item('site_name'); ?></b> <br>Developed by <a href="https://emcorpstudio.com">Emcorp Studio</a><br><br></center>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Don't have an account? <a href="<?php echo base_url("login"); ?>" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Login</b></a>
                    </p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

   <!--  <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>
                document.write(new Date().getFullYear())
            </script> <?php echo $this->config->item('site_name'); ?> developed by <a href="https://emcorpstudio.com">Emcorp Studio</a>
        </span>
    </footer> -->
    <!-- Vendor js -->
    <script src="<?php echo base_url('assets/js/vendor.min.js');?>"></script>
    <!-- App js -->
    <script src="<?php echo base_url('assets/js/app.min.js');?>"></script>

</body>

</html>