<?php if($header_start) echo $header_start;?>

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
                                    <li class="breadcrumb-item active">Test Agent</li>
                                </ol>
                            </div>
                            <!-- <h4 class="page-title">FAQ</h4> -->
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
                <form action="<?php echo base_url(); ?>Test_partner/submit_answer" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <h3 class="">Test Agent</h3>
                                <p class="text-muted"> Sebelum mengerjakan silahkan berdoa dan kerjakan dengan teliti. <b>Selamat mengerjakan!</b></p>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row m-t-50 pt-3">
                        <div class="col-lg-5 offset-lg-1">
                            <!-- echo angka ganjil -->
                            <!-- Question/Answer -->
                            <?php $i=1; foreach ($list_soal as $value) {
                                
                                if ($i%2 != 0) {
                                echo "<div>
                                        <div class=\"question-q-box\">$value->no_soal.</div>
                                        <h4 class=\"question\" data-wow-delay=\".1s\">$value->soal_test
                                        <div style=\"height:5px;\"></div>
                                        <table>
                                            <tr>
                                                <td valign=\"top\"><input type=\"radio\" id=\"soal-jawaban_a-$value->no_soal\" value=\"a\" name=\"soal_$value->no_soal\" required></td>
                                                <td>$value->jawaban_a</td>
                                            </tr>
                                            <tr>
                                                <td valign=\"top\"><input type=\"radio\" id=\"soal-jawaban_b-$value->no_soal\" value=\"b\" name=\"soal_$value->no_soal\"required></td>
                                                <td>$value->jawaban_b</td>
                                            </tr>
                                            <tr>
                                                <td valign=\"top\"><input type=\"radio\" id=\"soal-jawaban_c-$value->no_soal\" value=\"c\" name=\"soal_$value->no_soal\"required></td>
                                                <td>$value->jawaban_c</td>
                                            </tr>
                                            <tr>
                                                <td valign=\"top\"><input type=\"radio\" id=\"soal-jawaban_d-$value->no_soal\" value=\"d\" name=\"soal_$value->no_soal\"required></td>
                                                <td>$value->jawaban_d</td>
                                            </tr>
                                        </table>
                                        </h4>
                                    </div>";
                                }
                                $i++;
                            } ?>
                            

                        </div>
                        <!--/col-md-5 -->

                        <div class="col-lg-5">
                            <!-- echo angka genap -->
                            <!-- Question/Answer -->
                            <?php $i=1; foreach ($list_soal as $value) {
                                
                                if ($i%2 == 0) {
                                echo "<div>
                                        <div class=\"question-q-box\">$value->no_soal.</div>
                                        <h4 class=\"question\" data-wow-delay=\".1s\">$value->soal_test
                                        <div style=\"height:5px;\"></div>
                                        <table>
                                            <tr>
                                                <td valign=\"top\"><input type=\"radio\" id=\"soal-jawaban_a-$value->no_soal\" value=\"a\" name=\"soal_$value->no_soal\"required></td>
                                                <td>$value->jawaban_a</td>
                                            </tr>
                                            <tr>
                                                <td valign=\"top\"><input type=\"radio\" id=\"soal-jawaban_b-$value->no_soal\" value=\"b\" name=\"soal_$value->no_soal\"required></td>
                                                <td>$value->jawaban_b</td>
                                            </tr>
                                            <tr>
                                                <td valign=\"top\"><input type=\"radio\" id=\"soal-jawaban_c-$value->no_soal\" value=\"c\" name=\"soal_$value->no_soal\"required></td>
                                                <td>$value->jawaban_c</td>
                                            </tr>
                                            <tr>
                                                <td valign=\"top\"><input type=\"radio\" id=\"soal-jawaban_d-$value->no_soal\" value=\"d\" name=\"soal_$value->no_soal\"required></td>
                                                <td>$value->jawaban_d</td>
                                            </tr>
                                        </table>
                                        </h4>
                                    </div>";
                                }
                                $i++;
                            } ?>
                    
                        </div>
                        <!--/col-md-5-->

                        
                    </div>
                    <div class="form-group account-btn text-center m-t-10">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-t-10 btn-xs">Submit</button>
                        </div>
                    </div>
                    <!-- end row -->
                </form>
                
            </div> <!-- end container-fluid -->
        </div>
        <!-- end wrapper -->


        <?php if($footer_start) echo $footer_start;?>

        <?php if($footer_end) echo $footer_end;?>