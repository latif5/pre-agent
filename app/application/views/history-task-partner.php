<?php if($header_start) echo $header_start;?>

        <!-- DataTables -->
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Tooltipster css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/tooltipster/tooltipster.bundle.min.css">

        <!-- Multi Item Selection examples -->
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                                    
                                    <li class="breadcrumb-item active">History Task Job</li>
                                </ol>
                            </div>
                            <h4 class="page-title">History Task Job</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">List Data</h4>
                            <!-- <p class="text-muted font-14 m-b-30">
                                DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                            </p> -->

                            <table id="list-partner" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Task</th>
                                    <th>Pemilik UMKM</th>
                                    <th>Status</th>
                                    <th>File Task</th>
                                    <th>Upload</th>
                                    <th>Email</th>
                                    <th>NO Telepon</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->

            </div> <!-- end container-fluid -->
        </div>
        <!-- end wrapper -->


         <!-- Review task modal content -->
        <div id="upload-file" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2 class="text-uppercase text-center m-b-30">
                            <a href="index.html" class="text-success">
                                <span><img src="assets/images/logo.jpeg" alt="" height="35"></span>
                            </a>
                        </h2>

                        <form class="form-horizontal" action="<?php echo base_url(); ?>History_task_partner/update_task_partner" enctype="multipart/form-data" method="post">

                            <div class="form-group m-b-25">
                                <input type="hidden" id="id_task" name="id_task" value="">
                                <label class="col-12 col-form-label">File Task</label>
                                <div class="col-md-10">
                                    <input type="file" class="filestyle" name="file_partner" data-buttonbefore="true" data-btnClass="btn-light" accept=".xls,.xlsx" required>
                                </div>
                            </div>

                            <div class="form-group account-btn text-center m-t-10">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-t-10 btn-sm" data-toggle="modal" data-target="#add-task-modal">Submit</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <?php if($footer_start) echo $footer_start;?>

        <!-- Required datatable js -->
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.print.min.js"></script>

        <!-- Key Tables -->
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.keyTable.min.js"></script>

        <!-- Responsive examples -->
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Selection table -->
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.select.min.js"></script>

         <!-- Tooltipster js -->
        <script src="<?php echo base_url(); ?>assets/plugins/tooltipster/tooltipster.bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/pages/jquery.tooltipster.js"></script>
        <script>
            $(document).ready(function() {

                // Default Datatable
                var table = $('#list-partner').DataTable({
                  "destroy": true,
                    "Sort": true,
                    
                    "ServerMethod": "GET", 
                    "processing": true,
                    "bServerSide": true,
                    "lengthMenu": [20,50, 100, 150, 200],
                    "iDisplayLength" :50,
                    "iDisplayStart": 0,
                    "scrollX":true,
                    "scrollY":"62vh",
                    fixedColumns: {
                        leftColumns: 1
                    },
                  // fixedColumns: {
                  //     leftColumns: 2
                  // },
                  "columnDefs": [
                    // { "orderable": false, "targets": [1]},
                    {
                      "targets": '_all',
                      render: function(data, type,row,meta){
                        var res = data.split("|");
                        // console.log(res[0]);
                        if (res[0]=='t'){
                          res[0]='text';
                        }else if (res[0]=='s'){
                            res[0]='select';
                        }else if (res[0]=='d'){
                              res[0]='date';
                        }
                        if (res[2]=='e'){
                            res[2]='editable';                     
                        }
                        var id= row[0].split("|");
                        return "<td>"+res[3]+"</td>"
                      }
                    }
                  ],
                  
                  // 'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                  //     // if ( aData[38].substring(18,19) == '0' )
                  //     // {
                  //     //   $(nRow).css('background-color', 'pink');
                  //     // }
                  // },
                  "sAjaxSource": "<?php echo base_url('History_task_partner/get_data'); ?>"
                });

                $(document).on('click','.file-upload',function(event){
                    var id= $(this).attr('data-id');
                    // var that = $(this);
                    // var val = $(this).attr("val");
                    $('#id_task').val(id);
   
                    // $.ajax({
                    //     url: '<?php //echo base_url("List_partner/change_req"); ?>',
                    //     type: 'POST',
                    //     data: { id: id, val: val },
                    //     success: function (resp) {    
                    //     if (resp == 1) {  
                    //         table.ajax.reload( null, false );
                    //     }else{ 
                    //         alert('error '+resp);}
                    //     },
                    //     error: function(e){ alert ("Error " + e); }
                    // });
                    event.preventDefault();
                  
                });


                // Key Tables

                $('#key-table').DataTable({
                    keys: true
                });

                // Responsive Datatable
                $('#responsive-datatable').DataTable();

                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>
        <?php if($footer_end) echo $footer_end;?>