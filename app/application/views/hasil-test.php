<?php if($header_start) echo $header_start;?>

        <!-- Modal -->
        <link href="<?php echo base_url(); ?>assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">

<?php if($header_end) echo $header_end;?>


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#">Agent</a></li>
                                    <li class="breadcrumb-item active">Hasil test partner</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Hasil Test</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

               <!--  <div class="row">
                    <div class="col-sm-4">
                        <a href="#custom-modal" class="btn btn-custom waves-effect waves-light mb-4" data-animation="fadein" data-plugin="custommodal"
                           data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus"></i> Add Member</a>
                    </div>
                </div>-->
                <!-- end row --> 


                <div class="row card-box">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center ">
                            <div class="member-card pt-2 pb-2">
                                <div class="col-lg-12">
                                    <div class="thumb-lg member-thumb m-b-10 mx-auto">
                                        <img src="assets/images/users/avatar-2.jpg" class="rounded-circle img-thumbnail" alt="profile-image">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 class="m-b-5"><?php if(@$nama) echo $nama;?></h4>
                                    <p class="text-muted"><?php if(@$username) echo $username;?><span> | </span> <span> Partner </span></p>
                                    <h4 class="m-b-5"><?php if(@$no_tlp) echo $no_tlp;?></h4>
                                </div>

                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-6">
                                            <div class="mt-3">
                                                <h4 class="m-b-0"><?php if(@$nilai) echo $nilai;?></h4>
                                                <p class="mb-0 text-muted">Nilai Test Partner</p>
                                            </div>
                                        </div>
                                        <div class="col-3"></div>
                                    </div>
                                <?php if(@$nilai>=20){?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mt-4">
                                            <div class="alert alert-warning bg-warning text-white border-0" role="alert">
                                                Your account under <strong>Review</strong> by Administrator!
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mt-4">
                                            <div class="alert alert-danger bg-danger text-white border-0" role="alert">
                                                Sorry, your test result <strong>Not in reqruitment!</strong>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                    
                                </div>
                                
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-3">
                    </div> <!-- end col -->

                </div>


            </div> <!-- end container-fluid -->
        </div>
        <!-- end wrapper -->
    

        <?php if($footer_start) echo $footer_start;?>

        <!-- Modal-Effect -->
        <script src="<?php echo base_url(); ?>assets/plugins/custombox/js/custombox.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/custombox/js/legacy.min.js"></script>

        <?php if($footer_end) echo $footer_end;?>