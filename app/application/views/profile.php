<?php if($header_start) echo $header_start;?>

        <!-- Plugins css-->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" />

<?php if($header_end) echo $header_end;?>


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Profile</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-sm-12">
                        <!-- meta -->
                        <div class="profile-user-box card-box bg-custom">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span class="float-left mr-3"><img src="<?php echo base_url(); ?>assets/images/users/avatar-1.jpg" alt="" class="thumb-lg rounded-circle"></span>
                                    <div class="media-body text-white">
                                        <h4 class="mt-1 mb-1 font-18"><?php echo $nama;?> </h4>
                                        <p class="font-13 text-light"><?php echo $this->session->userdata('email');?></p>
                                        <p class="text-light mb-0"><?php echo $no_tlp;?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-light waves-effect" id="button-edit-profile" attr-display="no">
                                            <i class="mdi mdi-account-settings-variant mr-1"></i> Edit Profile
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ meta -->
                    </div>
                </div>
                <!-- end row -->

                <div class="row" id="form-edit-profile">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Edit Profile</h4>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-20">
                                        <form class="form-horizontal" id="formUpdate" role="form" action="<?php echo base_url(); ?>Profile/update" method="post" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Full Name</label>
                                                <div class="col-10">
                                                    <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $nama;?>" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Username</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" value="<?php echo $user_name;?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Email</label>
                                                <div class="col-10">
                                                    <p class="form-control-static"><?php echo $email;?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label" for="pass1">Password<span class="text-danger ">*</span></label>
                                                <div class="col-10">
                                                    <input id="pass1" name="password" type="password" placeholder="Password" required
                                                       class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label" for="passWord2">Confirm Password <span class="text-danger">*</span></label>
                                                <div class="col-10">
                                                    <input data-parsley-equalto="#pass1" type="password" required
                                                       placeholder="Password" class="form-control" id="passWord2">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Alamat</label>
                                                <div class="col-10">
                                                    <textarea id="alamat" name="alamat" class="form-control" maxlength="250" rows="4" placeholder="This textarea has a limit of 250 chars." required=""><?php echo $alamat;?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Telpone</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" maxlength="12" type="tel" id="no_tlp" name="no_tlp" value="<?php echo $no_tlp;?>" required="">
                                                </div>
                                            </div>

                                            <?php if(isset($form_input_semester)) echo $form_input_semester;?>

                                            <?php if(isset($form_input_ipk)) echo $form_input_ipk;?>

                                            <?php if(isset($form_upload_krs_partner)) echo $form_upload_krs_partner;?>

                                            <div class="form-group text-right m-b-0">
                                                <button class="btn btn-custom waves-effect waves-light" type="submit">
                                                    Update
                                                </button>
                                                <button type="reset" class="btn btn-light waves-effect m-l-5">
                                                    Cancel
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>
                            <!-- end row -->

                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end container-fluid -->
        </div>
        <!-- end wrapper -->


        <?php if($footer_start) echo $footer_start;?>
        
        <!-- Counter Up  -->
        <script src="<?php echo base_url(); ?>assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- Parsley js -->
        <script src="<?php echo base_url(); ?>assets/plugins/parsleyjs/parsley.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/autocomplete/jquery.mockjax.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/autocomplete/countries.js"></script>
        <script src="<?php echo base_url(); ?>assets/pages/jquery.autocomplete.init.js"></script>

        <!-- Init Js file -->
        <script src="<?php echo base_url(); ?>assets/pages/jquery.form-advanced.init.js"></script>

        <script>
            $('#form-edit-profile').hide();

            $(document).ready(function() {
                $('form').parsley();
                
            });

            $('#button-edit-profile').on('click',function() {
                var is_display = $(this).attr('attr-display');
                if (is_display=='no') {
                    $('#form-edit-profile').show();
                    $(this).attr("attr-display","yes");
                }else{
                    $('#form-edit-profile').hide();
                    $(this).attr("attr-display","no");
                }
                
            });

            $("#upload").click(function(e){
                e.preventDefault();
                var formData = new FormData($('#formUpdate')[0]);

                $.ajax({
                    url: "<?php echo base_url(); ?>Profile/upload_krs",
                    type: "POST",
                    data: formData,
                    datatype: 'JSON',
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,
                    success: function(data)
                    {
                        console.log("sukses");
                        // load_data();
                        // $('html,body').animate({
                        //     scrollTop: 0
                        // }, 700);
                    }
                });
            });
        </script>

        <?php if($footer_end) echo $footer_end;?>