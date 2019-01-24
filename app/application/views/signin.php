<?php if($header_account) echo $header_account;?>


    <body class="account-pages">

        <!-- Begin page -->
        <div class="accountbg" style="background: url('assets/images/bg-1.jpg');background-size: cover;background-position: center;"></div>

        <div class="wrapper-page account-page-full">

            <div class="card">
                <div class="card-block">

                    <div class="account-box">

                        <div class="card-box p-5">
                            <h2 class="text-uppercase text-center pb-4">
                                <a href="index.php" class="text-success">
                                    <span><img src="<?php echo base_url(); ?>assets/images/logo.jpeg" alt="" height="35"></span>
                                </a>
                            </h2>

                            <form class="" action="<?php echo base_url(); ?>Auth/login" method="POST">

                                <div class="form-group m-b-20 row">
                                    <div class="col-12">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" required="" placeholder="Enter your username">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                                    </div>
                                </div>

                               <!--  <div class="form-group row m-b-20">
                                    <div class="col-12">

                                        <div class="checkbox checkbox-custom">
                                            <input id="remember" type="checkbox" checked="">
                                            <label for="remember">
                                                Remember me
                                            </label>
                                        </div>

                                    </div>
                                </div> -->

                                <div class="form-group row text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign In</button>
                                    </div>
                                </div>

                            </form>

                            <div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted">Don't have an account? Sign Up <a href="<?php echo base_url(); ?>Auth/register?type=umkm" class="text-custom m-l-5"><b>UMKM</b></a> or <a href="<?php echo base_url(); ?>Auth/register?type=partner" class="text-success m-l-5"><b>Agent</b></a></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

         <!-- Modal -->
        <div class="modal fade" id="modal_gagal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content panel-danger">
                    <div class="modal-header panel-heading">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="modal-title" id="myModalLabel">Login failed</h3>
                    </div>
                    <div class="modal-body panel-heading">
                        <h4 id="mssg" style="color: red;">
                        <?php echo $this->session->flashdata('message'); ?>
                        </h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal -->
        <div class="modal fade" id="modal_success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content panel-success">
                    <div class="modal-header panel-heading">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="modal-title" id="myModalLabel">Register Success</h3>
                    </div>
                    <div class="modal-body panel-heading">
                        <h4 id="mssg" style="color: blue;">
                        <?php echo $this->session->flashdata('message'); ?>
                        </h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <?php if($footer_account) echo $footer_account;?>