<?php if($header_account) echo $header_account;?>
    
    <!-- Plugins css-->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" />

    <body class="account-pages">

        <!-- Begin page -->
        <div class="accountbg" style="background: url('assets/images/bg-2.jpg');background-size: cover;background-position: center;"></div>

        <div class="wrapper-page account-page-full">

            <div class="card">
                <div class="card-block">

                    <div class="account-box">

                        <div class="card-box p-5">
                            <h2 class="text-uppercase text-center pb-4">
                                <a href="index.php" class="text-success">
                                    <span><img src="assets/images/logo.jpeg" alt="" height="35"></span>
                                </a>
                            </h2>

                            <form class="form-horizontal" action="<?= base_url();?>Auth/newAccount" id="form-signup" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="type_user" value="<?php echo $type_user;?>">
                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="nama">Full Name</label>
                                        <input class="form-control" type="text" id="nama" name="nama" required="" placeholder="Michael Zenaty">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" id="user_name" name="user_name" required="" placeholder="Michael Zenaty">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="email">Email address</label>
                                        <input class="form-control" type="email" id="email" name="email" required="" placeholder="john@deo.com">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="passWord2">Retype Password</label>
                                        <input class="form-control" type="password" required placeholder="Enter your password" id="re_password" name="re_password">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="alamat">Alamat</label>
                                        <input class="form-control" type="text" id="alamat" name="alamat" required="" placeholder="Address">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="no_tlp">Telephone</label>
                                        <input class="form-control" maxlength="12" type="tel" id="no_tlp" name="no_tlp" required="" placeholder="Enter your number telephone">
                                    </div>
                                </div>

                                <?php if(isset($form_register_partner)) echo $form_register_partner;?>

                                <?php if(isset($form_register_umkm)) echo $form_register_umkm;?>

                                <div class="form-group row text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>

                            </form>

                            <div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted">Already have an account?  <a href="<?php echo base_url(); ?>Auth" class="text-dark m-l-5"><b>Sign In</b></a></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php if($footer_account) echo $footer_account;?>