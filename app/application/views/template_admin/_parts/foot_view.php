<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/dist/js/dataTables.fixedColumns.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>">
  
</script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
<script src="<?php echo base_url('assets/dist/js/app.min.js')?>"></script>

<!-- CK Editor -->
<!-- <script type="text/javascript" src="<?php //echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script> -->
<!-- <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script> -->
<!-- <script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<script src="<?=base_url()?>assets/dist/js/validator.js"></script>
<script type="text/javascript">

  <?php if($page_title == "Log User | NOKIA"){ ?>
     //get data mahasiswa
        $('.log-user').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": 0 }
          ],
          "sAjaxSource": "<?php echo base_url('LogUser/get_data'); ?>"
        });       
  <?php } ?>

  <?php if($page_title == "Group User | NOKIA"){ ?>
     //get data Group User
        var table = $('.data-group').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"61.1vh",
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": [0,2]}
          ],
          "sAjaxSource": "<?php echo base_url('GroupData/get_data'); ?>"
        });       

        // Inline editing
      var oldValue = null;
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+8)+'px height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select"){
          $(this).html('<input type="text" style="width:'+($(this).width()+8)+'px" class="update" value="'+ oldValue +'" />');
        }
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('GroupData/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

        // ajax delete data
      $(document).on('click','.delete-data',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var name= $(this).attr('data-name');
        var del = window.confirm('Confirm delete '+name+'?');
          if (del === false) {
            event.preventDefault();
            return false;
          }
          
        $.ajax({
          url: '<?php echo base_url("GroupData/delete_data"); ?>',
          type: 'POST',
          data: { id: id },
          success: function (resp) {    
            if (resp == 1) {  
             table.ajax.reload( null, false );
            } 
            else { alert('error '+resp);}
          },
          error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
        // end delete data
  <?php } ?>

  <?php if($page_title == "Data User | NOKIA"){ ?>
     //get data data user
        var table = $('.data-user').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": [0,12] }
          ],
          "sAjaxSource": "<?php echo base_url('DataUser/get_data'); ?>"
        });       

        // Inline editing
      var oldValue = null;
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+8)+'px height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+100)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select"){
          var elem    = $(this);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url('DataUser/getDataGroup'); ?>",
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
          
        }
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');
        // console.log(newValue+' | newValue | '+oldValue+' | oldValue  |');
        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('DataUser/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(colName == 'id_group'){
                table.ajax.reload( null, false );
              }
              $(elem).parent().addClass('editable');
              if (newValue == '') {
                newValue = '- ';
              }
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

        // check password - confirm password  
      $("#rePass").focusout(function(){
        if($("#pass").val() != $("#rePass").val()){
          $("#notMatch").show();
        }else{
          $("#notMatch").hide();
        }
      });
        // end check password

        // ajax delete data
      $(document).on('click','.delete-data',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var name= $(this).attr('data-name');
        var del = window.confirm('Confirm delete '+name+'?');
          if (del === false) {
            event.preventDefault();
            return false;
          }
          
        $.ajax({
                  url: '<?php echo base_url("DataUser/delete_data"); ?>',
                  type: 'POST',
                  data: { id: id },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
        // end delete data

        // ajax change status
      $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val= $(this).attr('data-name');
        $.ajax({
                  url: '<?php echo base_url("DataUser/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
        // end change status

        // ajax modal edit password
         $(function(){
              $(document).on('click','.edit-password',function(e){
                  e.preventDefault();
                  $("#editPassword").modal('show');
                  $.post("<?php echo base_url('DataUser/modelEditPassword') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditPassword").html(html);
                      }   
                  );
              });
          });


         // ajax modal edit group
         $(function(){
              $(document).on('click','.edit-group',function(e){
                  e.preventDefault();
                  $("#editGroup").modal('show');
                  $.post("<?php echo base_url('DataUser/modelEditGroup') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditGroup").html(html);
                      }   
                  );
              });
          });
  <?php } ?>

  <?php if($page_title == "Master Received | NOKIA"){ ?>
      // get data
        <?php if(isset($_POST['year']) || isset($_POST['phase_code']) || isset($_POST['po_type']) || isset($_POST['po_no']) || isset($_POST['item_text']) || isset($_POST['cr_status'])){ ?>
        var table = $('.data-master-received').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [94]}
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[93] == '<div><span type="text" name="status_po">0</span></div>' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $key1 = str_replace($replacements,$entities,$_POST["year"]);
            $key2 = str_replace($replacements,$entities,$_POST["phase_code"]);
            $key3 = str_replace($replacements,$entities,$_POST["po_type"]);
            $key4 = str_replace($replacements,$entities,$_POST["po_no"]);
            $key5 = str_replace($replacements,$entities,$_POST["item_text"]);
            $key6 = str_replace($replacements,$entities,$_POST["cr_status"]);
            if($key1 == ""){
              $key1 = "xxx";
            }
            if($key2 == ""){
              $key2 = "xxx";
            }
            if($key3 == ""){
              $key3 = "xxx";
            }
            if($key4 == ""){
              $key4 = "xxx";
            }
            if($key5 == ""){
              $key5 = "xxx";
            }
            if($key6 == ""){
              $key6 = "xxx";
            }
          ?>
          "sAjaxSource": "<?php echo base_url('MasterReceived/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6); ?>"
        });
        <?php }else{ ?>
        var table = $('.data-master-received').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"390px",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [94]}
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[93] == '<div><span type="text" name="status_po">0</span></div>' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('MasterReceived/get_data'); ?>"
          
        });
        <?php } ?>
        $('.data-master-received tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
        // Inline editing
      var oldValue = null;
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select"){
          $(this).html('<input type="text" style="width:'+($(this).width()+8)+'px" class="update" value="'+ oldValue +'" />');
        }
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('MasterReceived/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

        // ajax delete data
     $(document).on('click','.delete-data',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var name= $(this).attr('data-name');
         var del = window.confirm('Confirm delete '+name+'?');
          if (del === false) {
            event.preventDefault();
            return false;
          }
          
        $.ajax({
                  url: '<?php echo base_url("MasterReceived/delete_data"); ?>',
                  type: 'POST',
                  data: { id: id },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
        // end delete data
        //add data
      $(document).on('click','.add-data',function(e){
        that = this;
                    
        $.ajax({  
                  url: '<?php echo base_url("MasterReceived/create"); ?>',
                  type: 'POST',
                  data: {  },
                  success: function (resp) {    
                     $('#data-master-received').append(resp);                                 
                  }                
        });
      });
      // end add data
  <?php } ?>
  

  <?php if($page_title == "Phase | NOKIA"){ ?>
    //Phase
      // get data
        var table = $('.data-phase').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [9]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[9].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('Phase/get_data'); ?>"
          
        });
		
        $('.data-phase tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

	  
	  //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('Phase/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
      //ajax edit 
      $(function(){
        $(document).on('click','.submit-edit',function(e){
          if(document.getElementById('id').value=="" || document.getElementById('phcode').value=="" || document.getElementById('phname').value=="" || document.getElementById('phyear').value=="" || document.getElementById('publishreport').value=="" || document.getElementById('publishupdate').value=="" || document.getElementById('remarks').value==""){
            alert("Please complete all information requested on this form");
          }else{
          $.ajax({
            url:'<?php echo base_url('Phase/editData')?>',
            method:'post',
            data :
            {
              id : document.getElementById('id').value,
              phcode : document.getElementById('phcode').value,
              newphcode : document.getElementById('newphcode').value,
              phname : document.getElementById('phname').value,
              phyear : document.getElementById('phyear').value,
              publishreport : document.getElementById('publishreport').value,
              publishupdate : document.getElementById('publishupdate').value,
              remarks : document.getElementById('remarks').value
            },
            success : function(respone)
            {
              if(respone==1){
                $("#editData").modal('hide');
                table.ajax.reload(null, false);
                alert("Success Update");
              }else{
                alert("Phase Code is already exist");
              }
            }
          })
        }
        })
      }),

      //ajax add data
      $(function(){
        $(document).on('click','.submit-add', function(e){
          if(document.getElementById('phcodenew').value=="" || document.getElementById('phnamenew').value=="" || document.getElementById('phyearnew').value=="" || document.getElementById('publishreportnew').value=="" || document.getElementById('publishupdatenew').value=="" || document.getElementById('remarksnew').value==""){
            alert("Please complete all information requested on this form");
          }else{
          $.ajax({
            url : '<?php echo base_url('Phase/createData') ?>',
            method : 'post',
            data : 
            {
              phcode : document.getElementById('phcodenew').value,
              phname : document.getElementById('phnamenew').value,
              phyear : document.getElementById('phyearnew').value,
              publishreport : document.getElementById('publishreportnew').value,
              publishupdate : document.getElementById('publishupdatenew').value,
              remarks : document.getElementById('remarksnew').value
            },
            success : function(response)
            {
              if(response==1){
                $("#addPhase").modal('hide');
                document.getElementById('phcodenew').value= "";
                document.getElementById('phnamenew').value= "";
                document.getElementById('phyearnew').value= "";
                document.getElementById('publishreportnew').value= "";
                document.getElementById('publishupdatenew').value= "";
                document.getElementById('remarksnew').value= "";
                table.ajax.reload(null, false);
                alert("Phase has been entered to the database successfully");
              }else{
                alert("Phase code already exist");
              }

            
            }
          })
        }
        })


      }),

        



		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("Phase/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });

      $(document).on('click','.create-code',function(event){
        var id= $(this).attr('rel');
        var year= $(this).attr('data-year');
        var that = $(this);
        $.ajax({
                  url: '<?php echo base_url("Phase/create_code"); ?>',
                  type: 'POST',
                  data: { id: id, year: year },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
  <?php } ?>
  
  
  <?php if($page_title == "PO Type | NOKIA"){ ?>
      //potype
      // get data   
        var table = $('.data-potype').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [5]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[5].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('PoType/get_data'); ?>"
          
        });
        
        $('.data-potype tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

	  
	  //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('PoType/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("PoType/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
  <?php } ?>
  
  
  <?php if($page_title == "Region | NOKIA"){ ?>
    //Region
      // get data     
        var table = $('.data-region').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [6]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[6].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('Region/get_data'); ?>"
          
        });
        
        $('.data-region tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
	  
	  //edit 
			$(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('Region/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
          });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("Region/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
  <?php } ?>
  
  
  <?php if($page_title == "NE Type | NOKIA"){ ?>
    //NE Type
      // get data     
        var table = $('.data-netype').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [5]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[5].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('NeType/get_data'); ?>"
          
        });
        
        $('.data-netype tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

	 //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('NeType/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("NeType/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
  <?php } ?>
  
 

  <?php if($page_title == "Site Status | NOKIA"){ ?>
      //Site Status
      // get data   
        var table = $('.data-site-status').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 4
          },
          "columnDefs": [
            { "orderable": false, "targets": [5]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[5].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('SiteStatus/get_data'); ?>"
          
        });
        
        $('.data-site-status tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

	  //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('SiteStatus/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("SiteStatus/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
	 
  <?php } ?>
  
  
  <?php if($page_title == "PO Status | NOKIA"){ ?>
      //PO Status
      // get data     
        var table = $('.data-postatus').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [5]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[5].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('PoStatus/get_data'); ?>"
          
        });
        
        $('.data-postatus tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

      //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('PoStatus/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("PoStatus/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
  <?php } ?>
  
  
  <?php if($page_title == "CR Status | NOKIA"){ ?>
    //CR Status
      // get data     
        var table = $('.data-crstatus').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [5]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[5].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('CrStatus/get_data'); ?>"
          
        });
        
        $('.data-crstatus tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

	  
	  //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('CrStatus/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("CrStatus/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
	 
  <?php } ?>
  
  
  <?php if($page_title == "Doc Status | NOKIA"){ ?>
      //Doc Status
      // get data     
        var table = $('.data-docstatus').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [5]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[5].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('DocStatus/get_data'); ?>"
          
        });
        
        $('.data-docstatus tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

	  
	  //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('DocStatus/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("DocStatus/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
	 
  <?php } ?>
  
  
  <?php if($page_title == "ATP Method | NOKIA"){ ?>
      //ATP Method
      // get data     
        var table = $('.data-atpmethod').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [5]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[5].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
               }
         },
          "sAjaxSource": "<?php echo base_url('AtpMethod/get_data'); ?>"
          
        });
        
        $('.data-atpmethod tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

	  //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('AtpMethod/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("AtpMethod/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
	 
  <?php } ?>
  
  
  <?php if($page_title == "Partner | NOKIA"){ ?>
      //Partner
      // get data     
        var table = $('.data-partner').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [6]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[6].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('Partner/get_data'); ?>"
          
        });
        
        $('.data-partner tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
	  
      //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('Partner/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("Partner/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
	 
  <?php } ?>
  
  
  <?php if($page_title == "Tower | NOKIA"){ ?>
      //Tower
      // get data     
        var table = $('.data-tower').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [7]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
             }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[7].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('Tower/get_data'); ?>"
          
        });
        
        $('.data-tower tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

	  //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('Tower/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("Tower/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
	 
  <?php } ?>
  
  <?php if($page_title == "WP Name | NOKIA"){ ?>
      //WP Name
      // get data     
        var table = $('.data-wpname').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [5]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[5].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('WpName/get_data'); ?>"
          
        });
        
        $('.data-wpname tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
	  
      //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('WpName/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("WpName/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
	 
  <?php } ?>
  
  <?php if($page_title == "Site Category | NOKIA"){ ?>
      //SiteCategory
      // get data     
        var table = $('.data-site-category').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [5]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[5].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('SiteCategory/get_data'); ?>"
          
        });
        
        $('.data-site-category tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
	  
	  //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('SiteCategory/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
      $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("SiteCategory/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
	 
  <?php } ?>
  
  <?php if($page_title == "Sowd Category | NOKIA"){ ?>
      //Sowd Category
      // get data     
        var table = $('.data-sowd-category').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"58vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [5]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[5].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
              }
          },
          "sAjaxSource": "<?php echo base_url('SowdCategory/get_data'); ?>"
          
        });
        
        $('.data-sowd-category tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
	  
	  //edit
	    $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('SowdCategory/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
		  
		  $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("SowdCategory/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
	 
  <?php } ?>

  
  <?php if($page_title == "Site Info | NOKIA"){ ?>
      //Site Tracker
      //Site Info
      //getdata filter
      var table = $('.data-site-info').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"62vh",
          fixedColumns: {
              leftColumns: 7
          },
          "columnDefs": [
            { "orderable": false, "targets": [58]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[57].substring(18,19) == '0' )
              {
                $(nRow).css('background-color', 'Silver');
              }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['sowcategory']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['status'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["sowcategory"]);
            $key6 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key7 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key8 = str_replace($replacements,$entities,$_POST["netype"]);
            $key9 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key10 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key11 = str_replace($replacements,$entities,$_POST["status"]);
            
            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }

          ?>
          "sAjaxSource": "<?php echo base_url('SiteInfo/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('SiteInfo/get_data'); ?>"
        });
        <?php } ?>
        
        $('.data-site-info tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

      $(document).on('click','#btn-filter',function(event){
        $('#btn-export').prop('disabled', false);

      });
      
      //Modal edit
      $(function(){
        $(document).on('click','.edit-data',function(e){
          e.preventDefault();
          $.post("<?php echo base_url('SiteInfo/modalEditData') ?>",
            {id:$(this).attr('data-id')},
            function(html){
              $("#editData").modal('show');
              $("#modalEditData").html(html);
            }   
          );
        });
      });

      // ajax submit edit data
      $(function(){
            $(document).on('click','.submit-edit',function(e){
              if(document.getElementById('id').value == "" ){
                alert("Please complete all information requested on this form");
              }else{
                if ($('#broadcast').is(":checked"))
                {
                  var broadcast = true;
                }else{
                  var broadcast = false;
                }
                console.log(broadcast);
                $.ajax({
                  url : "<?php echo base_url('SiteInfo/modalUpdateData') ?>",
                  method : 'post',
                  data : 
                  {
                    id : document.getElementById('id').value,
                    boqno : document.getElementById('boqnoEdit').value,
                    sistemkey : document.getElementById('sistemkeyEdit').value,
                    wpidsvc : document.getElementById('wpidsvcEdit').value,
                    netype : document.getElementById('netypeEdit').value,
                    siteid : document.getElementById('siteidEdit').value,
                    sitename : document.getElementById('sitenameEdit').value,
                    sitestatus : document.getElementById('sitestatusEdit').value,
                    regioncode : document.getElementById('regioncodeEdit').value,
                    siteidori : document.getElementById('siteidoriEdit').value,
                    sitenameori : document.getElementById('sitenameoriEdit').value,
                    regioncodeori : document.getElementById('regioncodeoriEdit').value,
                    wpidori : document.getElementById('wpidoriEdit').value,
                    momreloc : document.getElementById('momrelocEdit').value,
                    broadcast : broadcast
                  },
                  success : function(respone)
                  {
                    $("#editData").modal('hide');
                    table.ajax.reload( null, false );
                    if(respone ==1){
                      alert("Success update");
                    }
                  }
                });
              }
            });
          });

      
      //inline edit
      String.prototype.replaceArray = function(find, replace) {
        var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };      
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }
        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitelevel"){
          var html = '<select name="sitelevel" style="width:'+($(this).width()+25)+'px" class="update" selected>';
          
          if(oldValue == 1){
            html += '<option value="1" selected>1</option>';
          }else{
            html += '<option value="1">1</option>';
          }
          if(oldValue == 2){
            html += '<option value="2" selected>2</option>';
          }else{
            html += '<option value="2">2</option>';
          }
          html += '</select>';
          $(this).html(html);
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phgroup"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>ATF/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
          var elem    = $(this);
          var oldValue1 = oldValue.replaceArray(replacements,entities);

          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="sowG900" || $(this).attr('name')=="sowG1800" || $(this).attr('name')=="sowU2100" || $(this).attr('name')=="sowU900" || $(this).attr('name')=="sowL1800" || $(this).attr('name')=="sowL2100" || $(this).attr('name')=="sowL900")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataSowdCategory/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="regioncode" || $(this).attr('name')=="regioncodeori")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="netype"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataNeType/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitecategory"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataSiteCategory/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });  
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="wpname"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataWpName/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });  
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="boqnolevel1trs" || $(this).attr('name')=="boqnolevel1ps" || $(this).attr('name')=="boqnolevel1cme")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
           if(oldValue1 == ""){oldValue1 = "xxx";}
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getBoqByIdSite/"+oldValue1+"/"+$(this).attr('id'),
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });  
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('SiteInfo/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

      $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("statussiteinfo");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("SiteInfo/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
      
      $('#phcodeInput').change(function() {
        $.ajax({
            url : '<?php echo base_url('SiteInfo/getDataPhaseByPhcode') ?>',
            method : 'post',
            data : 
            {
              phcode : $("#phcodeInput").val()
            },
            success : function(respone)
            {
              var data = jQuery.parseJSON(respone);
              $("#phyearinput").val(data.phyear);
              $("#phyearinput1").val(data.phyear);
              $("#phnameinput").val(data.phname);
              $("#phname").val(data.phname);
            }
        });
      });
      $("#sitenameori").keyup(function(){
        if($("#sitenameInput").val() == $("#sitenameori").val()){
          $("#statuscrrelocmapping1").val("NO CHANGE");
          $("#statuscrrelocmappinginput").val("NO CHANGE");
        }else{
          $("#statuscrrelocmapping1").val("CR RELOC");
          $("#statuscrrelocmappinginput").val("CR RELOC");
        }
      });
      $("#sitenameInput").keyup(function(){
        if($("#sitenameInput").val() == $("#sitenameori").val()){
          $("#statuscrrelocmapping1").val("NO CHANGE");
          $("#statuscrrelocmappinginput").val("NO CHANGE");
        }else{
          $("#statuscrrelocmapping1").val("CR RELOC");
          $("#statuscrrelocmappinginput").val("CR RELOC");
        }
      });
  <?php } ?>
  
  
  <?php if($page_title == "Progress | NOKIA"){ ?>
      //Progress
      // get data     
      //getdata filter
      var table = $('.data-progress').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"62vh",
          fixedColumns: {
              leftColumns: 7
          },
          "columnDefs": [
            { "orderable": false, "targets": [70]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[38].substring(18,19) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['oa_ac']) || isset($_POST['atp_ac']) || isset($_POST['sitestatus']) || isset($_POST['sitecategory']) || isset($_POST['onairbaseline']) || isset($_POST['onairforecast']) || isset($_POST['onairstatus'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key6 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key7 = str_replace($replacements,$entities,$_POST["netype"]);
            $key8 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key9 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key10 = str_replace($replacements,$entities,$_POST["oa_ac"]);
            $key11 = str_replace($replacements,$entities,$_POST["atp_ac"]);
            $key12 = str_replace($replacements,$entities,$_POST["sitestatus"]);
            $key13 = str_replace($replacements,$entities,$_POST["sitecategory"]);
            $key14 = str_replace($replacements,$entities,$_POST["onairbaseline"]);
            $key15 = str_replace($replacements,$entities,$_POST["onairforecast"]);
            $key16 = str_replace($replacements,$entities,$_POST["onairstatus"]);

            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }
            if($key13 == ""){ $key13 = "xxx"; }
            if($key14 == ""){ $key14 = "xxx"; }
            if($key15 == ""){ $key15 = "xxx"; }
            if($key16 == ""){ $key16 = "xxx"; }

          ?>
          "sAjaxSource": "<?php echo base_url('Progress/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12.'/'.$key13.'/'.$key14.'/'.$key15.'/'.$key16); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('Progress/get_data'); ?>"
        });
        <?php } ?>
        
        $('.data-progress tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

      //edit
      $(function(){
        $(document).on('click','.edit-data',function(e){
            e.preventDefault();
            $("#editData").modal('show');
            $.post("<?php echo base_url('Progress/modelEditData') ?>",
                {id:$(this).attr('data-id')},
                function(html){
                    $("#modelEditData").html(html);
                }   
            );
        });
      });

       //add tss
      $(function(){
              $(document).on('click','.add-tss',function(e){
                  e.preventDefault();
                  $("#add-tss").modal('show');
                  $.post("<?php echo base_url('Progress/modalEditDataTss') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modalEditDataTss").html(html);
                          console.log(id);
                      }   
                  );
              });
      });
      //ajax add tss
      $(document).on('click','.submit-add-tss',function(event){
        var id = $('#id_modal_tss').val();
        $.ajax({
          url: '<?php echo base_url("Progress/addDataTss"); ?>',
          type: 'POST',
          data: { 
            id: id
          },
          success: function (resp) {    
            if (resp == 1) {  
              table.ajax.reload( null, false );
              $("#add-tss").modal('hide');
              alert("Success add data to TSS");
            } 
            else if(resp == 0){ 
              alert('Cant add data to Database TSS because already in Database TSS');
            }
          },
          error: function(e){ alert ("Error " + e); }
        });     
        event.preventDefault();
      });

      //inline edit
      // Inline editing
      String.prototype.replaceArray = function(find, replace) {
      var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="onairstatus"){
          var select = '<select name="onairstatus" style="width:'+($(this).width()+25)+'px" class="update">';
          if(oldValue == 'Yes'){
            select += '<option value="Yes" selected>Yes</option>';
          }else{
            select += '<option value="Yes">Yes</option>';
          }
          if(oldValue == 'No'){
            select += '<option value="No" selected>No</option>';
          }else{
            select += '<option value="No">No</option>';
          }
          if(oldValue == '-' || oldValue == null){
            select += '<option value="-" selected>-</option>';
          }else{
            select += '<option value="-">-</option>';
          }
          $(this).html(select);
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Progress/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="tower_owner"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Progress/getTowerOwner/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Progress/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="regioncode" ){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Progress/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="partnerni" || $(this).attr('name')=="partnernpo")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Progress/getDataPartner/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="atpmethod"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Progress/getDataAtpMethod/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });   
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('Progress/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              console.log(colName);
              console.log('colom name');
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

      // ajax modal edit partner
         $(function(){
              $(document).on('click','.edit-partner',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('Progress/modalEditPartner') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modalEditData").html(html);
                      }   
                  );
              });
          });

      // ajax edit partner
      $(document).on('click','.submit-edit-partner',function(event){
        var id = $('#id').val();
        var that = $(this);
        var partnertssOld = $('#partnertssOld').val();
        var partnerniOld = $('#partnerniOld').val();
        var partnernpoOld = $('#partnernpoOld').val();
        var partnertssNew = $('#partnertssNew').val();
        var partnerniNew = $('#partnerniNew').val();
        var partnernpoNew = $('#partnernpoNew').val();
        var changeReason = $('#changeReason').val();
        if ($('#broadcast').is(":checked"))
        {
          var broadcast = true;
        }else{
          var broadcast = false;
        }

        if (partnertssOld == null || partnertssOld == '' || partnerniOld == null || partnerniOld == '' || partnernpoOld == null || partnernpoOld == '' || partnertssNew == null || partnertssNew == '' || partnerniNew == null || partnerniNew == '' || partnernpoNew == null || partnernpoNew == '' || changeReason == null || changeReason == '') {
          alert('Please fill all field!');
        } else {
          $.ajax({
            url: '<?php echo base_url("Progress/editDataPartner"); ?>',
            type: 'POST',
            data: { 
              id: id, 
              partnertssOld: partnertssOld, 
              partnerniOld: partnerniOld, 
              partnernpoOld: partnernpoOld,
              partnertssNew: partnertssNew,
              partnerniNew: partnerniNew,
              partnernpoNew: partnernpoNew,
              changereason: changeReason,
              broadcast: broadcast
              },
            success: function (resp) {    
              if (resp == 1) {  
                table.ajax.reload( null, false );
                $("#editData").modal('hide');
                alert("Success update");
              } 
              else { alert('error '+resp);}
            },
            error: function(e){ alert ("Error " + e); }
          });
        }
        
        event.preventDefault();
      });

      // ajax edit partner and send mail
      $(document).on('click','.submit-edit-partner-send-mail',function(event){
        var id = $('#id').val();
        var that = $(this);
        var partnertssOld = $('#partnertssOld').val();
        var partnerniOld = $('#partnerniOld').val();
        var partnernpoOld = $('#partnernpoOld').val();
        var partnertss = $('#partnertss').val();
        var partnerni = $('#partnerni').val();
        var partnernpo = $('#partnernpo').val();
        if ($('#bradcast').is(":checked"))
        {
          var broadcast = true;
        }else{
          var broadcast = false;
        }
        $.ajax({
                  url: '<?php echo base_url("Progress/editDataPartnerAndSendMail"); ?>',
                  type: 'POST',
                  data: { 
                    id: id, 
                    partnertssOld: partnertssOld, 
                    partnerniOld: partnerniOld, 
                    partnernpoOld: partnernpoOld, 
                    partnertss: partnertss, 
                    partnerni: partnerni, 
                    partnernpo: partnernpo,
                    broadcast: broadcast
                    },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                     $("#editData").modal('hide');
                     alert("Success update and send mail");
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      });

      // ajax modal edit loi
         $(function(){
              $(document).on('click','.edit-loi',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('Progress/modalEditLoi') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modalEditData").html(html);
                      }   
                  );
              });
          });

      // ajax edit loi
      $(document).on('click','.submit-edit-loi',function(event){
        var id = $('#id').val();
        var that = $(this);
        var loi1tss = $('#loi1tss').val();
        var loipartnerni = $('#loipartnerni').val();
        var loipartnernpo = $('#loipartnernpo').val();
        $.ajax({
                  url: '<?php echo base_url("Progress/editDataLoi"); ?>',
                  type: 'POST',
                  data: { id: id, loi1tss: loi1tss, loipartnerni: loipartnerni, loipartnernpo: loipartnernpo},
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                     $("#editData").modal('hide');
                     alert("Success update");
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      });

      // ajax edit loi and send mail
      $(document).on('click','.submit-edit-loi-send-mail',function(event){
        var id = $('#id').val();
        var that = $(this);
        var loi1tss = $('#loi1tss').val();
        var loipartnerni = $('#loipartnerni').val();
        var loipartnernpo = $('#loipartnernpo').val();
        $.ajax({
                  url: '<?php echo base_url("Progress/editDataLoiAndSendMail"); ?>',
                  type: 'POST',
                  data: { id: id, loi1tss: loi1tss, loipartnerni: loipartnerni, loipartnernpo: loipartnernpo},
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                     $("#editData").modal('hide');
                     alert("Success update and send mail");
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      });
  <?php } ?>

  <?php if($page_title == "ATF | NOKIA"){ ?>
      //ATF
      // get data     
             //getdata filter
      var table = $('.data-atf').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 5
          },
          "columnDefs": [
            { "orderable": false, "targets": [31]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[37].substring(18,19) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['sowcategory']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['oa_ac']) || isset($_POST['atp_ac'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["sowcategory"]);
            $key6 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key7 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key8 = str_replace($replacements,$entities,$_POST["netype"]);
            $key9 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key10 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key11 = str_replace($replacements,$entities,$_POST["oa_ac"]);
            $key12 = str_replace($replacements,$entities,$_POST["atp_ac"]);
            
            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }
          ?>
          "sAjaxSource": "<?php echo base_url('ATF/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('ATF/get_data'); ?>"
        });
        <?php } ?>
        
        $('.data-atf tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

   //edit
      $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('ATF/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
      
      //inline edit
       // Inline editing
      String.prototype.replaceArray = function(find, replace) {
      var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('click', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="onairstatus"){
          $(this).html('<select name="onairstatus" style="width:'+($(this).width()+8)+'px" class="update"><option value="Yes">Yes</option><option value="No">No</option></select>');
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phgroup"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>ATF/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>ATF/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>ATF/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="regioncode" ){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>ATF/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('ATF/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

  <?php } ?>

  <?php if($page_title == "MCR | NOKIA"){ ?>
      //MCR
      // get data     
             //getdata filter
      var table = $('.data-mcr').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 5
          },
          "columnDefs": [
            {
              "targets": [33,34,35,36,37,38,39],
              render : function(data, type, row, meta) {
                    var res = data.split("|");
                    if(res[0] == 't'){
                      res[0] = 'text';
                    }else if(res[0] == 's'){
                      res[0] = 'select';
                    }else if(res[0] == 'su'){
                      res[0] = 'selectUser';
                    }else if(res[0] == 'd'){
                      res[0] = 'date';
                    }
                    if(res[2] == 'e'){
                      res[2] = 'editable';
                    }
                    var id = row[0].split("|");
                    return "<div style='overflow: hidden; height:14.4px; width:100px; text-overflow: ellipsis;'><a href='"+res[3]+"' target='_blank'><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></a></div>"
                }             
            },
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[37].substring(18,19) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['sowcategory']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['oa_ac']) || isset($_POST['mcrexit'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["sowcategory"]);
            $key6 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key7 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key8 = str_replace($replacements,$entities,$_POST["netype"]);
            $key9 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key10 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key11 = str_replace($replacements,$entities,$_POST["oa_ac"]);
            $key12 = str_replace($replacements,$entities,$_POST["mcrexit"]);
            
            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }
          ?>
          "sAjaxSource": "<?php echo base_url('MCR/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('MCR/get_data'); ?>"
        });
        <?php } ?>
        
        $('.data-mcr tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

   //edit
      $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('MCR/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
      
      //inline edit
       // Inline editing
      String.prototype.replaceArray = function(find, replace) {
      var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('click', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="onairstatus"){
          $(this).html('<select name="onairstatus" style="width:'+($(this).width()+8)+'px" class="update"><option value="Yes">Yes</option><option value="No">No</option></select>');
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>MCR/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>MCR/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="regioncode" ){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>MCR/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('MCR/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

      // ajax modal edit link
         $(function(){
              $(document).on('click','.edit-link',function(e){
                  e.preventDefault();
                  $("#editLink").modal('show');
                  $.post("<?php echo base_url('MCR/modalEditLink') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modalEditLink").html(html);
                      }   
                  );
              });
          });

      // ajax edit link
      $(document).on('click','.submit-edit-link',function(event){
        var id = $('#id').val();
        var that = $(this);
        var ssvsr = $('#ssvsr').val();
        var ssvfr = $('#ssvfr').val();
        var rssi = $('#rssi').val();
        var pmr = $('#pmr').val();
        var alarmlog = $('#alarmlog').val();
        var xxother3 = $('#xxother3').val();
        var xxother4 = $('#xxother4').val();
        $.ajax({
                  url: '<?php echo base_url("MCR/editLink"); ?>',
                  type: 'POST',
                  data: { id: id, ssvsr: ssvsr, ssvfr: ssvfr, rssi: rssi, pmr: pmr, alarmlog: alarmlog, xxother3: xxother3, xxother4: xxother4 },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                     $("#editLink").modal('hide');
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
  <?php } ?>

  
  <?php if($page_title == "BINDER | NOKIA"){ ?>
      //BINDER
      // get data     
             //getdata filter
      var table = $('.data-binder').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 5
          },
          "columnDefs": [
            { "orderable": false, "targets": [57]},
            {
              "targets": [20,21,22,23,24,25,26,27,28,29,30,31,32,37,38,39,40,41,42],
              render : function(data, type, row, meta) {
                    var res = data.split("|");
                    if(res[0] == 't'){
                      res[0] = 'text';
                    }else if(res[0] == 's'){
                      res[0] = 'select';
                    }else if(res[0] == 'su'){
                      res[0] = 'selectUser';
                    }else if(res[0] == 'd'){
                      res[0] = 'date';
                    }
                    if(res[2] == 'e'){
                      res[2] = 'editable';
                    }
                    var id = row[0].split("|");
                    return "<div style='overflow: hidden; height:14.4px; width:100px; text-overflow: ellipsis;'><a href='"+res[3]+"' target='_blank'><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></a></div>"
                }             
            },
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
                if (res[0]=='t'){
                  res[0]='text';
                }else if (res[0]=='s'){
                    res[0]='select';
                }else if (res[0]=='d'){
                      res[0]='date';
                }else if (res[0]=='n'){
                      res[0]='number';
                }
                if (res[2]=='e'){
                    res[2]='editable';                     
                }
                var id= row[0].split("|");
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[37].substring(18,19) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['oa_ac']) || isset($_POST['atp_ac']) || isset($_POST['mcrexit']) || isset($_POST['sitestatus']) || isset($_POST['doc_submit']) || isset($_POST['doc_accept']) || isset($_POST['endorse_submit']) || isset($_POST['endorse_approved'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key6 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key7 = str_replace($replacements,$entities,$_POST["netype"]);
            $key8 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key9 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key10 = str_replace($replacements,$entities,$_POST["oa_ac"]);
            $key11 = str_replace($replacements,$entities,$_POST["atp_ac"]);
            $key12 = str_replace($replacements,$entities,$_POST["mcrexit"]);
            $key13 = str_replace($replacements,$entities,$_POST["sitestatus"]);
            $key14 = str_replace($replacements,$entities,$_POST["doc_submit"]);
            $key15 = str_replace($replacements,$entities,$_POST["doc_accept"]);
            $key16 = str_replace($replacements,$entities,$_POST["endorse_submit"]);
            $key17 = str_replace($replacements,$entities,$_POST["endorse_approved"]);
            
            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }
            if($key13 == ""){ $key13 = "xxx"; }
            if($key14 == ""){ $key14 = "xxx"; }
            if($key15 == ""){ $key15 = "xxx"; }
            if($key16 == ""){ $key16 = "xxx"; }
            if($key17 == ""){ $key17 = "xxx"; }
          ?>
          "sAjaxSource": "<?php echo base_url('BINDER/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12.'/'.$key13.'/'.$key14.'/'.$key15.'/'.$key16.'/'.$key17.'/'); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('BINDER/get_data'); ?>"
        });
        <?php } ?>
        
        $('.data-binder tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

    //edit
      $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('BINDER/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
      
      //inline edit
       // Inline editing
      String.prototype.replaceArray = function(find, replace) {
      var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('click', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "number"){
          $(this).html('<input type="number" style="width:'+($(this).width()+8)+'px" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="onairstatus"){
          $(this).html('<select name="onairstatus" style="width:'+($(this).width()+8)+'px" class="update"><option value="Yes">Yes</option><option value="No">No</option></select>');
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>BINDER/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>BINDER/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="regioncode" ){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>BINDER/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('BINDER/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing
      // ajax modal edit link
         $(function(){
              $(document).on('click','.edit-link',function(e){
                  e.preventDefault();
                  $("#editLink").modal('show');
                  $.post("<?php echo base_url('BINDER/modalEditLink') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modalEditLink").html(html);
                      }   
                  );
              });
          });

      // ajax edit link
      $(document).on('click','.submit-edit-link',function(event){
        var id = $('#id').val();
        var that = $(this);
        var lld_ndb = $('#lld_ndb').val();
        var tssr_pdf = $('#tssr_pdf').val();
        var sid_pdf = $('#sid_pdf').val();
        var boq_pdf = $('#boq_pdf').val();
        var atf_xls = $('#atf_xls').val();
        var atf_pdf = $('#atf_pdf').val();
        var atp_functional = $('#atp_functional').val();
        var atp_physical = $('#atp_physical').val();
        var redline_pdf = $('#redline_pdf').val();
        var abd_dwg = $('#abd_dwg').val();
        var abd_pdf = $('#abd_pdf').val();
        var xx_others = $('#xx_others').val();
        var xx_others2 = $('#xx_others2').val();
        $.ajax({
                  url: '<?php echo base_url("BINDER/editLink"); ?>',
                  type: 'POST',
                  data: { id: id, lld_ndb: lld_ndb, tssr_pdf: tssr_pdf, sid_pdf: sid_pdf, boq_pdf: boq_pdf, atf_xls: atf_xls, atf_pdf: atf_pdf, atp_functional: atp_functional, atp_physical: atp_physical, redline_pdf: redline_pdf, abd_dwg: abd_dwg, abd_pdf: abd_pdf, xx_others: xx_others, xx_others2: xx_others2 },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                     $("#editLink").modal('hide');
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
  <?php } ?>

  <?php if($page_title == "SPE | NOKIA"){ ?>
      //SPE
      // get data     
             //getdata filter
      var table = $('.data-spe').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 5
          },
          "columnDefs": [
            { "orderable": false, "targets": [22]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[37].substring(18,19) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['sowcategory']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['oa_ac']) || isset($_POST['atp_ac'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["sowcategory"]);
            $key6 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key7 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key8 = str_replace($replacements,$entities,$_POST["netype"]);
            $key9 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key10 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key11 = str_replace($replacements,$entities,$_POST["oa_ac"]);
            $key12 = str_replace($replacements,$entities,$_POST["atp_ac"]);
            
            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }
          ?>
          "sAjaxSource": "<?php echo base_url('SPE/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('SPE/get_data'); ?>"
        });
        <?php } ?>
        
        $('.data-spe tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

   //edit
      $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('SPE/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
      
      //inline edit
       // Inline editing
      String.prototype.replaceArray = function(find, replace) {
      var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('click', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="onairstatus"){
          $(this).html('<select name="onairstatus" style="width:'+($(this).width()+8)+'px" class="update"><option value="Yes">Yes</option><option value="No">No</option></select>');
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SPE/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SPE/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="regioncode" ){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SPE/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('SPE/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

  <?php } ?>

   <?php if($page_title == "Certificate | NOKIA"){ ?>
      //Certificate
      // get data     
             //getdata filter
      var table = $('.data-certificate').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 5
          },
          "columnDefs": [
            { "orderable": false, "targets": [33]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
                if (res[0]=='t'){
                  res[0]='text';
                }else if (res[0]=='s'){
                    res[0]='select';
                }else if (res[0]=='d'){
                      res[0]='date';
                }else if (res[0]=='n'){
                      res[0]='number';
                }
                if (res[2]=='e'){
                    res[2]='editable';                     
                }
                var id= row[0].split("|");
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[37].substring(18,19) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['oa_ac']) || isset($_POST['atp_ac']) || isset($_POST['sitestatus']) || isset($_POST['mcrexit']) || isset($_POST['doc_status']) || isset($_POST['endorse_approved']) || isset($_POST['pac_date']) || isset($_POST['pacbaseline'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key6 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key7 = str_replace($replacements,$entities,$_POST["netype"]);
            $key8 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key9 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key10 = str_replace($replacements,$entities,$_POST["oa_ac"]);
            $key11 = str_replace($replacements,$entities,$_POST["atp_ac"]);
            $key12 = str_replace($replacements,$entities,$_POST["sitestatus"]);
            $key13 = str_replace($replacements,$entities,$_POST["mcrexit"]);
            $key14 = str_replace($replacements,$entities,$_POST["doc_status"]);
            $key15 = str_replace($replacements,$entities,$_POST["endorse_approved"]);
            $key16 = str_replace($replacements,$entities,$_POST["pac_date"]);
            $key17 = str_replace($replacements,$entities,$_POST["pacbaseline"]);

            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }
            if($key13 == ""){ $key13 = "xxx"; }
            if($key14 == ""){ $key14 = "xxx"; }
            if($key15 == ""){ $key15 = "xxx"; }
            if($key16 == ""){ $key16 = "xxx"; }
            if($key17 == ""){ $key17 = "xxx"; }
          ?>
          "sAjaxSource": "<?php echo base_url('Certificate/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12.'/'.$key13.'/'.$key14.'/'.$key15.'/'.$key16.'/'.$key17); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('Certificate/get_data'); ?>"
        });
        <?php } ?>
        
        $('.data-certificate tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

   //edit
      $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('Certificate/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
      
      //inline edit
       // Inline editing
      String.prototype.replaceArray = function(find, replace) {
      var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('click', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "number"){
          $(this).html('<input type="number" style="width:'+($(this).width()+8)+'px" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="onairstatus"){
          $(this).html('<select name="onairstatus" style="width:'+($(this).width()+8)+'px" class="update"><option value="Yes">Yes</option><option value="No">No</option></select>');
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Certificate/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Certificate/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="regioncode" ){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Certificate/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('Certificate/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

  <?php } ?>


     <?php if($page_title == "Commercial | NOKIA"){ ?>
      //Certificate
      // get data     
             //getdata filter
      var table = $('.data-commercial').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 5
          },
          "columnDefs": [
            { "orderable": false, "targets": [63]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
                if (res[0]=='t'){
                  res[0]='text';
                }else if (res[0]=='s'){
                    res[0]='select';
                }else if (res[0]=='n'){
                    res[0]='number';
                }else if (res[0]=='d'){
                      res[0]='date';
                }
                if (res[2]=='e'){
                    res[2]='editable';                     
                }
                var id= row[0].split("|");
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[37].substring(18,19) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['sowcategory']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['oa_ac']) || isset($_POST['atp_ac'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["sowcategory"]);
            $key6 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key7 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key8 = str_replace($replacements,$entities,$_POST["netype"]);
            $key9 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key10 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key11 = str_replace($replacements,$entities,$_POST["oa_ac"]);
            $key12 = str_replace($replacements,$entities,$_POST["atp_ac"]);
            
            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }
          ?>
          "sAjaxSource": "<?php echo base_url('Commercial/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('Commercial/get_data'); ?>"
        });
        <?php } ?>
        
        $('.data-commercial tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

   //edit
      $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('Commercial/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
      
      //inline edit
       // Inline editing
      String.prototype.replaceArray = function(find, replace) {
      var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('click', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "number"){
          $(this).html('<input type="number" style="width:'+($(this).width()+8)+'px" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="onairstatus"){
          $(this).html('<select name="onairstatus" style="width:'+($(this).width()+8)+'px" class="update"><option value="Yes">Yes</option><option value="No">No</option></select>');
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Commercial/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Commercial/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="regioncode" ){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Commercial/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('Commercial/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

  <?php } ?>

  <?php if($page_title == "IPM | NOKIA"){ ?>
      //IPM
      // get data     
             //getdata filter
      var table = $('.data-ipm').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 5
          },
          "columnDefs": [
            { "orderable": false, "targets": [38]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[38].substring(18,19) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['sowcategory']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['oa_ac']) || isset($_POST['atp_ac'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["sowcategory"]);
            $key6 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key7 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key8 = str_replace($replacements,$entities,$_POST["netype"]);
            $key9 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key10 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key11 = str_replace($replacements,$entities,$_POST["oa_ac"]);
            $key12 = str_replace($replacements,$entities,$_POST["atp_ac"]);
            
            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }
          ?>
          "sAjaxSource": "<?php echo base_url('IPM/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('IPM/get_data'); ?>"
        });
        <?php } ?>
        
        $('.data-ipm tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );


  <?php } ?>

  <?php if($page_title == "Closing | NOKIA"){ ?>
      //Closing
      // get data     
             //getdata filter
      var table = $('.data-closing').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 5
          },
          "columnDefs": [
            { "orderable": false, "targets": [35]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
                if (res[0]=='t'){
                  res[0]='text';
                }else if (res[0]=='s'){
                    res[0]='select';
                }else if (res[0]=='d'){
                      res[0]='date';
                }
                else if (res[0]=='n'){
                      res[0]='number';
                }
                if (res[2]=='e'){
                    res[2]='editable';                     
                }
                var id= row[0].split("|");
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[38].substring(18,19) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['sowcategory']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['oa_ac']) || isset($_POST['atp_ac'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["sowcategory"]);
            $key6 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key7 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key8 = str_replace($replacements,$entities,$_POST["netype"]);
            $key9 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key10 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key11 = str_replace($replacements,$entities,$_POST["oa_ac"]);
            $key12 = str_replace($replacements,$entities,$_POST["atp_ac"]);
            
            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }
          ?>
          "sAjaxSource": "<?php echo base_url('Closing/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('Closing/get_data'); ?>"
        });
        <?php } ?>
        
        $('.data-closing tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

   //edit
      $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('Closing/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
      
      //inline edit
       // Inline editing
      String.prototype.replaceArray = function(find, replace) {
      var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('click', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "number"){
          $(this).html('<input type="number" style="width:'+($(this).width()+8)+'px" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="onairstatus"){
          $(this).html('<select name="onairstatus" style="width:'+($(this).width()+8)+'px" class="update"><option value="Yes">Yes</option><option value="No">No</option></select>');
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Closing/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Closing/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="regioncode" ){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Closing/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="partnerni" || $(this).attr('name')=="partnernpo")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Closing/getDataPartner/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="atpmethod"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>Closing/getDataAtpMethod/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });   
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('Closing/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

  <?php } ?>


  <?php if($page_title == "Upload Site | NOKIA"){ ?>
    //Upload Site
      // get data     
        var table = $('.data-upload').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"62vh",
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [7]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[7].substring(10,11) == '0' )
              {
                $(nRow).css('background-color', 'pink');
               }
         },
          "sAjaxSource": "<?php echo base_url('UploadData/get_data'); ?>"
          
        });
        
        $('.data-upload tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

    //edit
      $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('AtpMethod/modelEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditData").html(html);
                      }   
                  );
              });
      });
      
      //ajax form open
    $('#uploadto').on('change', function() {
      if(document.getElementById('uploadto').value == "Site Info"){
        $("#Tipe").css("display","inline");
      }else{
        $("#Tipe").css("display","none");
      }
    });  

    $('#uploadto').on('change', function() {
      if(document.getElementById('uploadto').value == "Site Info"){
        $("#NewSiteInfo").css("display","inline");
        $("#UpdateProgress").css("display","none");
        $("#UpdateATF").css("display","none");
        $("#UpdateMCR").css("display","none");
        $("#UpdateSPE").css("display","none");
        $("#UpdateCertificate").css("display","none");
        $("#UpdateBINDER").css("display","none");
        $("#UpdateCommercial").css("display","none");
        $("#UpdateClosing").css("display","none");
      }else if(document.getElementById('uploadto').value == "Progress"){
        $("#UpdateProgress").css("display","inline");
        $("#NewSiteInfo").css("display","none");
        $("#UpdateATF").css("display","none");
        $("#UpdateMCR").css("display","none");
        $("#UpdateSPE").css("display","none");
        $("#UpdateCertificate").css("display","none");
        $("#UpdateBINDER").css("display","none");
        $("#UpdateCommercial").css("display","none");
        $("#UpdateClosing").css("display","none");
      }else if(document.getElementById('uploadto').value == "MCR"){
        $("#UpdateMCR").css("display","inline");
        $("#NewSiteInfo").css("display","none");
        $("#UpdateProgress").css("display","none");
        $("#UpdateATF").css("display","none");
        $("#UpdateSPE").css("display","none");
        $("#UpdateCertificate").css("display","none");
        $("#UpdateBINDER").css("display","none");
        $("#UpdateCommercial").css("display","none");
        $("#UpdateClosing").css("display","none");
      }else if(document.getElementById('uploadto').value == "ATF"){
        $("#UpdateATF").css("display","inline");
        $("#UpdateMCR").css("display","none");
        $("#NewSiteInfo").css("display","none");
        $("#UpdateProgress").css("display","none");
        $("#UpdateSPE").css("display","none");
        $("#UpdateCertificate").css("display","none");
        $("#UpdateBINDER").css("display","none");
        $("#UpdateCommercial").css("display","none");
        $("#UpdateClosing").css("display","none");
      }else if(document.getElementById('uploadto').value == "SPE"){
        $("#UpdateSPE").css("display","inline");
        $("#UpdateMCR").css("display","none");
        $("#UpdateATF").css("display","none");
        $("#NewSiteInfo").css("display","none");
        $("#UpdateProgress").css("display","none");
        $("#UpdateCertificate").css("display","none");
        $("#UpdateBINDER").css("display","none");
        $("#UpdateCommercial").css("display","none");
        $("#UpdateClosing").css("display","none");
      }else if(document.getElementById('uploadto').value == "Certificate"){
        $("#UpdateCertificate").css("display","inline");
        $("#UpdateSPE").css("display","none");
        $("#UpdateMCR").css("display","none");
        $("#UpdateATF").css("display","none");
        $("#NewSiteInfo").css("display","none");
        $("#UpdateProgress").css("display","none");
        $("#UpdateBINDER").css("display","none");
        $("#UpdateCommercial").css("display","none");
        $("#UpdateClosing").css("display","none");
      }else if(document.getElementById('uploadto').value == "BINDER"){
        $("#UpdateBINDER").css("display","inline");
        $("#UpdateSPE").css("display","none");
        $("#UpdateMCR").css("display","none");
        $("#UpdateATF").css("display","none");
        $("#NewSiteInfo").css("display","none");
        $("#UpdateProgress").css("display","none");
        $("#UpdateCertificate").css("display","none");
        $("#UpdateCommercial").css("display","none");
        $("#UpdateClosing").css("display","none");
      }else if(document.getElementById('uploadto').value == "Commercial"){
        $("#UpdateCommercial").css("display","inline");
        $("#UpdateSPE").css("display","none");
        $("#UpdateMCR").css("display","none");
        $("#UpdateATF").css("display","none");
        $("#NewSiteInfo").css("display","none");
        $("#UpdateProgress").css("display","none");
        $("#UpdateCertificate").css("display","none");
        $("#UpdateBINDER").css("display","none");
        $("#UpdateClosing").css("display","none");
      }
      else if(document.getElementById('uploadto').value == "Closing"){
        $("#UpdateClosing").css("display","inline");
        $("#UpdateSPE").css("display","none");
        $("#UpdateMCR").css("display","none");
        $("#UpdateATF").css("display","none");
        $("#NewSiteInfo").css("display","none");
        $("#UpdateProgress").css("display","none");
        $("#UpdateCertificate").css("display","none");
        $("#UpdateBINDER").css("display","none");
        $("#UpdateClosing").css("display","none");
        $("#UpdateCommercial").css("display","none");
      }
      else if(document.getElementById('uploadto').value == "DatabaseTss"){
        $("#UpdateClosing").css("display","none");
        $("#UpdateSPE").css("display","none");
        $("#UpdateMCR").css("display","none");
        $("#UpdateATF").css("display","none");
        $("#NewSiteInfo").css("display","none");
        $("#UpdateProgress").css("display","none");
        $("#UpdateCertificate").css("display","none");
        $("#UpdateBINDER").css("display","none");
        $("#UpdateClosing").css("display","none");
        $("#UpdateCommercial").css("display","none");
        $("#DatabaseTss").css("display","inline");
      }
    });  

      $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("status");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
          url: '<?php echo base_url("UploadData/change_status"); ?>',
          type: 'POST',
          data: { id_upload: id, val: val },
          success: function (resp) {    
            if (resp == 1) {  
             table.ajax.reload( null, false );
            } 
            else { alert('error '+resp);}

          },
          error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
   
  <?php } ?>

  <?php if($page_title == "Database TSS | NOKIA"){ ?>
      var table = $('.data-site-info').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"62vh",
          fixedColumns: {
              leftColumns: 0
          },
          "columnDefs": [
            { "orderable": false, "targets": [0]},
            {
              "targets": '_all',
              render: function(data,type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[0].substring(18,19) == '0' )
              {
                $(nRow).css('background-color', 'Silver');
              }
          },
        <?php if(isset($_POST['phcode']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['statuscrrelocmapping']) || isset($_POST['phyear']) || isset($_POST['sowcategory']) || isset($_POST['phgroup']) || isset($_POST['netype']) || isset($_POST['sitelevel']) || isset($_POST['status']) || isset($_POST['phname_filter'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phcode"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key5 = str_replace($replacements,$entities,$_POST["sowcategory"]);
            $key6 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key7 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key8 = str_replace($replacements,$entities,$_POST["netype"]);
            $key9 = str_replace($replacements,$entities,$_POST["statuscrrelocmapping"]);
            $key10 = str_replace($replacements,$entities,$_POST["sitelevel"]);
            $key11 = str_replace($replacements,$entities,$_POST["status"]);
            $key12 = str_replace($replacements,$entities,$_POST["phname_filter"]);
            
            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }

          ?>
          "sAjaxSource": "<?php echo base_url('DatabaseTss/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('DatabaseTss/get_data'); ?>"
        });
        <?php } ?>

  <?php } ?>

  //Register Nokia
  <?php if($page_title == "Issue Register Nokia | NOKIA"){ ?>
      
      //getdata
      // var table = $('.data-issue-register-nokia').DataTable({
      //     "sServerMethod": "POST", 
      //     "bProcessing": true,
      //     "bServerSide": true,
      //     "lengthMenu": [20,50, 100, 150, 200],
      //     "iDisplayLength" :50,
      //     "scrollX":true,
      //     "scrollY":"62vh",
      //     fixedColumns: {
      //         leftColumns: 0
      //     },
      //     "columnDefs": [
      //       { "orderable": false, "targets": [0]},
      //       {
      //         "targets": '_all',
      //         render: function(data, type,row,meta){
      //           var res = data.split("|");
      //           if (res[0]=='t'){
      //             res[0]='text';
      //           }else if (res[0]=='s'){
      //               res[0]='select';
      //           }else if (res[0]=='d'){
      //                 res[0]='date';
      //           }
      //           if (res[2]=='e'){
      //               res[2]='editable';           
      //           }
      //           var id= row[0].split("|");
      //           return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
      //         }
      //       }
      //     ],
      //     'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
      //     },
      //     // get data     
      //     "sAjaxSource": "<?php //echo base_url('IssueRegisterNokia/get_data'); ?>"
      //   });

        
        $('.data-issue-register-nokia tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

      $(document).on('click','#btn-filter',function(event){
        $('#btn-export').prop('disabled', false);

      });
      
      //Modal edit
      $(function(){
        $(document).on('click','.edit-data',function(e){
          e.preventDefault();
          $.post("<?php echo base_url('IssueRegisterNokia/modalEditData') ?>",
            {id:$(this).attr('data-id')},
            function(html){
              $("#editData").modal('show');
              $("#modalEditData").html(html);
            }   
          );
        });
      });

      // ajax submit edit data
      $(function(){
            $(document).on('click','.submit-edit',function(e){
              if(document.getElementById('id').value == "" ){
                alert("Please complete all information requested on this form");
              }else{
                if ($('#broadcast').is(":checked"))
                {
                  var broadcast = true;
                }else{
                  var broadcast = false;
                }
                console.log(broadcast);
                $.ajax({
                  url : "<?php echo base_url('IssueRegisterNokia/modalUpdateData') ?>",
                  method : 'post',
                  data : 
                  {
                    id : document.getElementById('id').value,
                    boqno : document.getElementById('boqnoEdit').value,
                    sistemkey : document.getElementById('sistemkeyEdit').value,
                    wpidsvc : document.getElementById('wpidsvcEdit').value,
                    netype : document.getElementById('netypeEdit').value,
                    siteid : document.getElementById('siteidEdit').value,
                    sitename : document.getElementById('sitenameEdit').value,
                    sitestatus : document.getElementById('sitestatusEdit').value,
                    regioncode : document.getElementById('regioncodeEdit').value,
                    siteidori : document.getElementById('siteidoriEdit').value,
                    sitenameori : document.getElementById('sitenameoriEdit').value,
                    regioncodeori : document.getElementById('regioncodeoriEdit').value,
                    wpidori : document.getElementById('wpidoriEdit').value,
                    momreloc : document.getElementById('momrelocEdit').value,
                    broadcast : broadcast
                  },
                  success : function(respone)
                  {
                    $("#editData").modal('hide');
                    table.ajax.reload( null, false );
                    if(respone ==1){
                      alert("Success update");
                    }
                  }
                });
              }
            });
          });

      
      //inline edit
      String.prototype.replaceArray = function(find, replace) {
        var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };      
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }
        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitelevel"){
          var html = '<select name="sitelevel" style="width:'+($(this).width()+25)+'px" class="update" selected>';
          
          if(oldValue == 1){
            html += '<option value="1" selected>1</option>';
          }else{
            html += '<option value="1">1</option>';
          }
          if(oldValue == 2){
            html += '<option value="2" selected>2</option>';
          }else{
            html += '<option value="2">2</option>';
          }
          html += '</select>';
          $(this).html(html);
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phgroup"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>ATF/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
          var elem    = $(this);
          var oldValue1 = oldValue.replaceArray(replacements,entities);

          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>IssueRegisterNokia/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>IssueRegisterNokia/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="sowG900" || $(this).attr('name')=="sowG1800" || $(this).attr('name')=="sowU2100" || $(this).attr('name')=="sowU900" || $(this).attr('name')=="sowL1800" || $(this).attr('name')=="sowL2100" || $(this).attr('name')=="sowL900")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>IssueRegisterNokia/getDataSowdCategory/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="regioncode" || $(this).attr('name')=="regioncodeori")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>IssueRegisterNokia/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="netype"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>IssueRegisterNokia/getDataNeType/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitecategory"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>IssueRegisterNokia/getDataSiteCategory/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });  
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="wpname"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>IssueRegisterNokia/getDataWpName/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });  
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="boqnolevel1trs" || $(this).attr('name')=="boqnolevel1ps" || $(this).attr('name')=="boqnolevel1cme")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
           if(oldValue1 == ""){oldValue1 = "xxx";}
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>IssueRegisterNokia/getBoqByIdSite/"+oldValue1+"/"+$(this).attr('id'),
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });  
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('IssueRegisterNokia/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

      $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val = $(this).attr("statussiteinfo");
        var name= $(this).attr('data-name');
        if(val == 1){
          var upd = window.confirm('Confirm Active '+name+'?');
        }else{
          var upd = window.confirm('Confirm Inactive '+name+'?');  
        }
        if (upd === false) {
          event.preventDefault();
          return false;
        }
        $.ajax({
                  url: '<?php echo base_url("IssueRegisterNokia/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}

                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
      
      $('#phcodeInput').change(function() {
        $.ajax({
            url : '<?php echo base_url('IssueRegisterNokia/getDataPhaseByPhcode') ?>',
            method : 'post',
            data : 
            {
              phcode : $("#phcodeInput").val()
            },
            success : function(respone)
            {
              var data = jQuery.parseJSON(respone);
              $("#phyearinput").val(data.phyear);
              $("#phyearinput1").val(data.phyear);
              $("#phnameinput").val(data.phname);
              $("#phname").val(data.phname);
            }
        });
      });
      $("#sitenameori").keyup(function(){
        if($("#sitenameInput").val() == $("#sitenameori").val()){
          $("#statuscrrelocmapping1").val("NO CHANGE");
          $("#statuscrrelocmappinginput").val("NO CHANGE");
        }else{
          $("#statuscrrelocmapping1").val("CR RELOC");
          $("#statuscrrelocmappinginput").val("CR RELOC");
        }
      });
      $("#sitenameInput").keyup(function(){
        if($("#sitenameInput").val() == $("#sitenameori").val()){
          $("#statuscrrelocmapping1").val("NO CHANGE");
          $("#statuscrrelocmappinginput").val("NO CHANGE");
        }else{
          $("#statuscrrelocmapping1").val("CR RELOC");
          $("#statuscrrelocmappinginput").val("CR RELOC");
        }
      });
  <?php } ?>


  //Issue Register Nokia Deatil
  <?php if($page_title == "Issue Register Nokia Detail | NOKIA"){ ?>
      //Issue Register
      var table = $('.data-issue-register').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"62vh",
          fixedColumns: {
              leftColumns: 5
          },
          "order": [[ 0, "DESC" ]],
          "columnDefs": [
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                var res = data.split("|");
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
                return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>";
              }
            }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // console.log(aData[24]);
             // if ( aData[23] == '1' )
             //  {
             //    $(nRow).css('background-color', '#F5F5F5');
             //  }
          },
        <?php if(isset($_POST['phyear']) || isset($_POST['phgroup']) || isset($_POST['boqno']) || isset($_POST['siteid']) || isset($_POST['sitename']) || isset($_POST['regioncode']) || isset($_POST['sitestatus']) || isset($_POST['sitecategory'])  || isset($_POST['datastatus']) || isset($_POST['issue_status']) || isset($_POST['issue_category']) || isset($_POST['onairactual'])){ 
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phgroup"]);
            $key3 = str_replace($replacements,$entities,$_POST["boqno"]);
            $key4 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key5 = str_replace($replacements,$entities,$_POST["sitename"]);
            $key6 = str_replace($replacements,$entities,$_POST["regioncode"]);
            $key7 = str_replace($replacements,$entities,$_POST["sitestatus"]);
            $key8 = str_replace($replacements,$entities,$_POST["sitecategory"]);
            $key9 = str_replace($replacements,$entities,$_POST["issue_category"]);
            $key10 = str_replace($replacements,$entities,$_POST["issue_status"]);
            $key11 = str_replace($replacements,$entities,$_POST["datastatus"]);
            $key12 = str_replace($replacements,$entities,$_POST["onairactual"]);
            
            if($key1 == ""){ $key1 = "xxx"; }
            if($key2 == ""){ $key2 = "xxx"; }
            if($key3 == ""){ $key3 = "xxx"; }
            if($key4 == ""){ $key4 = "xxx"; }
            if($key5 == ""){ $key5 = "xxx"; }
            if($key6 == ""){ $key6 = "xxx"; }
            if($key7 == ""){ $key7 = "xxx"; }
            if($key8 == ""){ $key8 = "xxx"; }
            if($key9 == ""){ $key9 = "xxx"; }
            if($key10 == ""){ $key10 = "xxx"; }
            if($key11 == ""){ $key11 = "xxx"; }
            if($key12 == ""){ $key12 = "xxx"; }
          ?>
          "sAjaxSource": "<?php echo base_url('IssueRegisterNokiaDetail/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11.'/'.$key12.'/'); ?>"
        });
        <?php 
        }else{
          $issuestatus = isset($_POST['issue_status']);
          $issuecategory = isset($_POST['issue_category']);
          $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
          $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");

          // $key1 = str_replace($replacements,$entities,$issuestatus);
          // $key2 = str_replace($replacements,$entities,$issuecategory);

          // if($key1 == ""){ $key1 = "xxx"; }
          // if($key2 == ""){ $key2 = "xxx"; }
             ?>
          // get data     
          "sAjaxSource": "<?php echo base_url('IssueRegisterNokiaDetail/get_data/'); ?>"
        });
        <?php } ?>
        
        $('.data-issue-register tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

      $(document).on('click','#btn-filter',function(event){
        $('#btn-export').prop('disabled', false);

      });
      
      //Modal edit
      $(function(){
        $(document).on('click','.edit-data',function(e){
          e.preventDefault();
          $.post("<?php echo base_url('IssueRegisterNokiaDetail/modalEditData') ?>",
            {id:$(this).attr('data-id')},
            function(html){
              $("#editData").modal('show');
              $("#modalEditData").html(html);
              $("#masterissueEdit").attr("disabled", true);
              document.getElementById("saveButton").style.visibility = "hidden";
              document.getElementById("updateButton").style.visibility = "visible";
              $(document).on('click','.button-update',function(e){
                e.preventDefault();
                $("#issuecategoryEdit").attr("disabled", false);
                $("#issuedetailEdit").attr("readonly", false);
                $("#issueownerEdit").attr("disabled", false);
                $("#issuesolutionEdit").attr("readonly", false);
                $("#issuestatusEdit").attr("disabled", false);
                $("#closedateEdit").attr("readonly", false);
                if ($('#issuemaster').val() > 1) {
                  $("#masterissueEdit").attr("disabled", false);
                }
                document.getElementById("updateButton").style.display = "none";
                document.getElementById("saveButton").style.visibility = "visible";
              });
            }   
          );
        });
      });

      // ajax togle add master data
      $(function(){
            $(document).on('click','.togle-add-master',function(e){
              var id = $(this).attr('data-id');
              var masterissue = $(this).attr('masterissue');
              var boqno = $(this).attr('data-boq');
              if(id == "" ){
                alert('Error get ID from this Issue, Please refresh page!');
              }else{
                  if(masterissue == 1){
                    // alert('change master to 0');
                    $.ajax({
                      url : "<?php echo base_url('IssueRegisterNokiaDetail/changeMaster') ?>",
                      method : 'post',
                      data : 
                      {
                        id : id,
                        masterissue : 0
                      },
                      success : function(respone)
                      {
                        // console.log(document.getElementById('masterissueEdit').value);
                        // $("#editData").modal('hide');
                        table.ajax.reload( null, false );
                        if(respone == 2){
                          alert("Can't change master issue. Master issue already exist!");
                          $(this).attr("aria-pressed","true");
                        }
                      }
                    });
                  }else{
                    // alert('change master to 1');
                    $.ajax({
                      url : "<?php echo base_url('IssueRegisterNokiaDetail/changeMaster') ?>",
                      method : 'post',
                      data : 
                      {
                        id : id,
                        boqno: boqno,
                        masterissue : 1
                      },
                      success : function(respone)
                      {
                        table.ajax.reload( null, false );
                        if(respone == 2){
                          alert("Can't change master issue. Master issue already exist!");
                          $(this).removeClass("active");
                          $(this).attr("aria-pressed","false");
                        }
                      }
                    });
                
                }
                
              }
            });
      });


      // ajax submit edit data
      $(function(){
            $(document).on('click','.submit-edit',function(e){
              if(document.getElementById('id').value == "" ){
                alert("Please complete all information requested on this form");
              }else{
                if(document.getElementById('issuestatusEdit').value == 'CLOSE'){
                  if(document.getElementById('closedateEdit').value == ''){
                    alert("Close Date can't be null!");
                  }else{
                    $.ajax({
                      url : "<?php echo base_url('IssueRegisterNokiaDetail/modalUpdateData') ?>",
                      method : 'post',
                      data : 
                      {
                        id : document.getElementById('id').value,
                        issuecategory : document.getElementById('issuecategoryEdit').value,
                        issuedetail : document.getElementById('issuedetailEdit').value,
                        issueowner : document.getElementById('issueownerEdit').value,
                        issuesolution : document.getElementById('issuesolutionEdit').value,
                        issuestatus : document.getElementById('issuestatusEdit').value,
                        closedate : document.getElementById('closedateEdit').value,
                        masterissue : document.getElementById('masterissueEdit').value
                      },
                      success : function(respone)
                      {
                        console.log(document.getElementById('masterissueEdit').value);
                        $("#editData").modal('hide');
                        table.ajax.reload( null, false );
                        if(respone ==1){
                          alert("Success update");
                        }
                      }
                    });
                  }
                }else{
                  $.ajax({
                    url : "<?php echo base_url('IssueRegisterNokiaDetail/modalUpdateData') ?>",
                    method : 'post',
                    data : 
                    {
                      id : document.getElementById('id').value,
                      issuecategory : document.getElementById('issuecategoryEdit').value,
                      issuedetail : document.getElementById('issuedetailEdit').value,
                      issueowner : document.getElementById('issueownerEdit').value,
                      issuesolution : document.getElementById('issuesolutionEdit').value,
                      issuestatus : document.getElementById('issuestatusEdit').value,
                      closedate : document.getElementById('closedateEdit').value,
                      masterissue : document.getElementById('masterissueEdit').value
                    },
                    success : function(respone)
                    {
                      console.log(document.getElementById('masterissueEdit').value);
                      $("#editData").modal('hide');
                      table.ajax.reload( null, false );
                      if(respone ==1){
                        alert("Success update");
                      }
                    }
                  });
                }
                
              }
            });
      });

      //Modal delete
      $(function(){
        $(document).on('click','.delete-data',function(e){
          e.preventDefault();
          
          $.post("<?php echo base_url('IssueRegisterNokiaDetail/modalDeleteData') ?>",
            {id:$(this).attr('data-id')},
            function(html){
              $("#deleteData").modal('show');
              $("#modalDeleteData").html(html);
            }   
          );
        });
      });

      // ajax submit delete data
      $(function(){
        $(document).on('click','.submit-delete',function(e){
          $.ajax({
            url : "<?php echo base_url('IssueRegisterNokiaDetail/deleteData') ?>",
            method : 'post',
            data : 
            {
              id : document.getElementById('id').value
            },
            success : function(respone)
            {
              $("#deleteData").modal('hide');
              table.ajax.reload( null, false );
              if(respone == 1){
                alert("Success Delete Data");
              }
            }
          });
        });
      });
      
      //inline edit
      String.prototype.replaceArray = function(find, replace) {
        var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
        };      
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();
        if (oldValue=="-"){
          oldValue="";
        }
        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+20)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          if(oldValue == ""){
            $(this).html('<input type="date" style="width:110px" class="update" value="'+ oldValue +'" />');
          }else{
            $(this).html('<input type="date" style="width:'+($(this).width()+55)+'px" class="update" value="'+ oldValue +'" />');
          }
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitelevel"){
          var html = '<select name="sitelevel" style="width:'+($(this).width()+25)+'px" class="update" selected>';
          
          if(oldValue == 1){
            html += '<option value="1" selected>1</option>';
          }else{
            html += '<option value="1">1</option>';
          }
          if(oldValue == 2){
            html += '<option value="2" selected>2</option>';
          }else{
            html += '<option value="2">2</option>';
          }
          html += '</select>';
          $(this).html(html);
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phgroup"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>ATF/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="phcode"){
          var elem    = $(this);
          var oldValue1 = oldValue.replaceArray(replacements,entities);

          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataPhase/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitestatus"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataSiteStatus/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="sowG900" || $(this).attr('name')=="sowG1800" || $(this).attr('name')=="sowU2100" || $(this).attr('name')=="sowU900" || $(this).attr('name')=="sowL1800" || $(this).attr('name')=="sowL2100" || $(this).attr('name')=="sowL900")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataSowdCategory/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="regioncode" || $(this).attr('name')=="regioncodeori")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataRegion/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="netype"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataNeType/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          }); 
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="sitecategory"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataSiteCategory/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });  
        }else if($(this).attr('type') == "select" && $(this).attr('name')=="wpname"){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getDataWpName/"+oldValue1,
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });  
        }else if($(this).attr('type') == "select" && ($(this).attr('name')=="boqnolevel1trs" || $(this).attr('name')=="boqnolevel1ps" || $(this).attr('name')=="boqnolevel1cme")){
           var elem    = $(this);
           var oldValue1 = oldValue.replaceArray(replacements,entities);
           if(oldValue1 == ""){oldValue1 = "xxx";}
          $.ajax({
            type: "GET",
            url : "<?php echo base_url(); ?>SiteInfo/getBoqByIdSite/"+oldValue1+"/"+$(this).attr('id'),
            dataType: "html",
            success : function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });  
        }
        
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('SiteInfo/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue==""){
                newValue="-";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue==""){
            newValue="-";
          }
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
      // end inline editing

      



  <?php } ?>
  //summary
   <?php if($page_title == "Summary Progress | NOKIA"){ ?>
    //summaryprogress
      // get data     
        var table = $('.data-summary-progress').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 4
          },
          "columnDefs": [
            { "orderable": false, "targets": [25]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                return "<div>"+data+"</div>"
              }
            }
          ],
          "order": [[ 2, "asc" ]],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[7].substring(10,11) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phyear'])||isset($_POST['phgroup'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            $key2 = str_replace($replacements,$entities,$_POST["phgroup"]);
  
            if($key1 == ""){
              $key1 = "xxx";
            }elseif($key2 == "") {
              $key2 = "xxx";
            }
          
          ?>
          "sAjaxSource": "<?php echo base_url('SummaryProgress/get_data_filter/'.$key1.'/'.$key2); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('SummaryProgress/get_data'); ?>"
        });
        <?php } ?>
          
        
        $('.data-summary-progress tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
   
  <?php } ?>

  //summary
  <?php if($page_title == "Summary Certificate | NOKIA"){ ?>
    //summarypCertificate
      // get data     
        var table = $('.data-summary-certificate').DataTable({
          "sServerMethod": "POST",
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 4
          },
          "columnDefs": [
            { "orderable": false, "targets": [26]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                return "<div>"+data+"</div>"
              }
            }
          ],
          "order": [[ 2, "asc" ]],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[7].substring(10,11) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phyear'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            
  
            if($key1 == ""){
              $key1 = "xxx";
            }
          
          ?>
          "sAjaxSource": "<?php echo base_url('SummaryCertificate/get_data_filter/'.$key1); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('SummaryCertificate/get_data'); ?>"
        });
        <?php } ?>
          
        
        $('.data-summary-certificate tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
   
  <?php } ?>

  <?php if($page_title == "Summary Commercial | NOKIA"){ ?>
    //summarypCertificate
      // get data     
        var table = $('.data-summary-commercial').DataTable({
          "sServerMethod": "POST",
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57vh",
          fixedColumns: {
              leftColumns: 4
          },
          "columnDefs": [
            { "orderable": false, "targets": [26]},
            {
              "targets": '_all',
              render: function(data, type,row,meta){
                return "<div>"+data+"</div>"
              }
            }
          ],
          "order": [[ 2, "asc" ]],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              // if ( aData[7].substring(10,11) == '0' )
              // {
              //   $(nRow).css('background-color', 'pink');
              // }
          },
        <?php if(isset($_POST['phyear'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $key1 = str_replace($replacements,$entities,$_POST["phyear"]);
            
  
            if($key1 == ""){
              $key1 = "xxx";
            }
          
          ?>
          "sAjaxSource": "<?php echo base_url('SummaryCommercial/get_data_filter/'.$key1); ?>"
        });
        <?php }else{ ?>
      // get data     
          "sAjaxSource": "<?php echo base_url('SummaryCommercial/get_data'); ?>"
        });
        <?php } ?>
          
        
        $('.data-summary-commercial tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
   
  <?php } ?>

  <?php if($page_title == "Report MT ISAT | NOKIA") { ?>
    //Report MT ISAT
    var table;
 
  $(document).ready(function() {
 
    //datatables
    var table = $('.log-exsport-mt').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('ReportMtIsat/get_data'); ?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
          { 
            "targets": [1], //first column / numbering column
            "orderable": false, //set not orderable
          },
        ],
 
    });

    table.order([ 0, 'asc' ]).draw();
 
  });
    
  <?php } ?>

  <?php if($page_title == "BOQ per Site | NOKIA") { ?>
    var val = [];
    var id = [];

    $("#ph_year").change(function(){
      var ph_year = $("#ph_year").val();
      if(ph_year != ""){
        // $("#boqno").prop('disabled', false);
        $("#boqno").prop('disabled', true);
        // $("#contentData").hide();
        // $("#loadData").hide();
        // $('#boqno').find('option').remove().end().append("<option value=''>--Choose--</option>");
        $.ajax({
          url: '<?php echo base_url("BOQperSiteMT1/get_phase_group"); ?>',
          type: 'post',
          data: {ph_year:ph_year},
          dataType: 'json',
          success: function(data){
            $("#loadData").hide();
            $("#contentData").hide();
            $('#ph_group').find('option').remove().end().append("<option value=''>--Choose--</option>");
            $.each(data, function(i, item){
              $("#ph_group").append("<option value='"+item.ph_group+"'>"+item.ph_group+"</option>");
            });
          }
        });
      }
    });

    $("#ph_group").change(function(){
      var ph_group = $("#ph_group").val();
      var ph_year = $("#ph_year").val();
      if(ph_group != ""){
        // var ph_group = $("#ph_group").val();
        
        // $('#boqno').find('option').remove().end().append("<option value=''>--Choose--</option>");
        // $("#loadData").hide();
        // $("#contentData").hide();
        console.log(ph_group+" ->id phase");
        console.log(ph_year+" ->id region");

        $.ajax({
          url: '<?php echo base_url("BOQperSiteMT1/get_site_list"); ?>',
          type: 'post',
          data: {ph_group:ph_group, ph_year:ph_year},
          dataType: 'json',
          success: function(data){
            $("#boqno").prop('disabled', false);
            $('#boqno').find('option').remove().end().append("<option value=''>--Choose--</option>");
            // console.log(data);
            $.each(data, function(i, item){
              $("#boqno").append("<option value='"+item.boqno+"%7C"+item.siteid+"%7C"+item.sitename+"%7C"+item.sowcategory+"%7C"+item.netype+"'>"+item.boqno+" | "+item.siteid+" | "+item.sitename+" | "+item.sowcategory+" | "+item.netype+"</option>");
            });
          }
        });
      }
    });

    //get data master cr
    var table = $('#boqpersite').DataTable({
      "sServerMethod": "POST", 
      "bProcessing": true,
      "bServerSide": true,
      "lengthMenu": [20,50, 100, 150, 200],
      "iDisplayLength" :50,
      "scrollX":true,
      "scrollY":"62vh",
      fixedColumns: {
          leftColumns: 1
      },
      "columnDefs": [
        {
          "targets": '_all',
          render: function(data, type,row,meta){
            var res = data.split("|");
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
            return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
          }
        }
      ],
      "sAjaxSource": "<?php echo base_url('BOQperSiteMT1/get_data_null'); ?>"
        
    });
    

    // ajax submit edit cron job
    $("#filter-data").click(function(){
        if(document.getElementById('ph_year').value == "" || document.getElementById('ph_group').value == "" || document.getElementById('boqno').value == ""){
          alert("Please complete all information requested on this form");
        }else{
          load_data();
        }
    });


    function load_data() {
      String.prototype.replaceArray = function(find, replace) {
        var replaceString = this;
        for (var i = 0; i < find.length; i++) {
          replaceString = replaceString.replace(find[i], replace[i]);
        }
        return replaceString;
      };

      // var textarea = $(this).val();
      var find = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      var replace = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];

      var ph_year = document.getElementById('ph_year').value;
      var ph_group = document.getElementById('ph_group').value;
      var boqno = document.getElementById('boqno').value;

      document.getElementById("ph_year-post").value = ph_year;
      document.getElementById("ph_group-post").value = ph_group;
      document.getElementById("boqno-post").value = boqno;
      
      key1 = ph_year.replaceArray(find, replace);
      key2 = ph_group.replaceArray(find, replace);
      key3 = boqno.replaceArray(find, replace);
      key3=key3.replace(/\s+/g,"%22");
      key3=key3.replace(/[\,]/g,"%2C");
      
      console.log(key1);
      console.log(key2);
      console.log(key3);
      document.getElementById("btn-export").disabled = false;
      if(key1 == ""){ key1 = "xxx"; }
      if(key2 == ""){ key2 = "xxx"; }
      if(key3 == ""){ key3 = "xxx"; }

      var table = $('#boqpersite').DataTable({
            "destroy": true,
            "Sort": true,
            "aoColumns": [ 
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null,
                  null
            ],
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
            "sAjaxSource": "<?php echo base_url('BOQperSiteMT1/get_data_filter').'/'?>"+key1+"/"+key2+"/"+key3+"/",
            "columnDefs": [
              {
                "targets": '_all',
                render: function(data,type,row,meta){
                  
                  var res = data.split("|");
                  var id= row[0].split("|");
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

                  if (res[4]=='c'){
                      res[4]='<input type="checkbox" name="verify[]" id="verify" onclick="showBtnSave()" value="' + $('<div/>').text(id[3]).html() + '">';                     
                  }
                  if (res[4]=='a'){
                      res[4]='<input type="checkbox" name="approve[]" id="approve" onclick="showBtnApprove()" value="' + $('<div/>').text(id[3]).html() + '">';                     
                  }

                  if (res[5]=='n'){
                      res[3]='<input type="number" data-id="'+id[3]+'" style="height:10px; margin-buttom: 5px;width: 70px;" name="qty_actual_map_inline[]" class="form-control input-xs input-qty-actual" id="qty_actual_map_inline" value="' + $('<div/>').text(res[3]).html() + '">';                     
                  }
                  return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[4]+" "+res[3]+"</span></div>"
                }
              }
            ],
            "initComplete": function(settings, json) {
              var inputs = $('.input-qty-actual').each(function() {
                $(this).data('original', this.value);
              });

              $('.input-qty-actual').change(function(){
                console.log('change');
                val.length = 0;
                id.length = 0;

                if ($(this).data('original') !== this.value) {
                  $('.input-qty-actual').each(function(i){
                    val[i] = $(this).val();
                    id[i] = $(this).attr('data-id');
                  });
                  var btn = document.getElementById("btn-qty-actual");
                  if (val.length != 0){
                    btn.style.display = "block";
                    // console.log(val);
                    // console.log(id);
                  } else {
                    btn.style.display = "none";
                  }
                } else {
                    return false;
                }
              });
            }
        });

        
    };

    $('#btn-verify').on('click', function(e){
      var val = [];
      $(':checkbox:checked').each(function(i){
        val[i] = $(this).val();
      });
      console.log(val);
      $.ajax({
          url : "<?php echo base_url('BOQperSiteMT1/confirmData') ?>",
          method : 'post',
          data : 
          {
            id : val,
          },
          success : function(respone)
          {
            // $("#confirmData").modal('hide');
            // table.ajax.reload( null, false );
            if(respone == 1){
              alert("Success Confirm Data");
              load_data();
              // table.ajax.reload( null, false );
              var btn = document.getElementById("btn-verify");
              btn.style.display = "none";
            }else{
              alert(respone);
            }
          }
        });
    });

    $('#btn-approve').on('click', function(e){
      var val = [];
      $(':checkbox:checked').each(function(i){
        val[i] = $(this).val();
      });
      console.log(val);
      $.ajax({
        url : "<?php echo base_url('BOQperSiteMT1/approveData') ?>",
        method : 'post',
        data : 
        {
          id : val,
        },
        success : function(respone)
        {
          // $("#confirmData").modal('hide');
          // table.ajax.reload( null, false );
          if(respone == 1){
            alert("Success Approve Data");
            load_data();
            // table.ajax.reload( null, false );
            var btn = document.getElementById("btn-approve");
            btn.style.display = "none";
          }else{
            alert(respone);
          }
        }
      });
    });

    $('#btn-qty-actual').on('click', function(e){
      // console.log(val);
      // console.log(id);
      $.ajax({
        url : "<?php echo base_url('BOQperSiteMT1/updateDataQtyActual') ?>",
        method : 'post',
        data : 
        {
          id : id,
          val : val
        },
        success : function(respone)
        {
          // $("#confirmData").modal('hide');
          // table.ajax.reload( null, false );
          if(respone == 1){
            alert("Success Update Data");
            load_data();
            // table.ajax.reload( null, false );
            var btn = document.getElementById("btn-qty-actual");
            btn.style.display = "none";
          }else{
            alert(respone);
          }
        }
      });
    })

    // function showBtnApprove() {
    //   var val = [];
    //   $(':checkbox:checked').each(function(i){
    //     val[i] = $(this).val();
    //   });
    //   var checkBox = document.getElementById("approve");
    //   var btn = document.getElementById("btn-approve");
    //   if (val.length != 0){
    //     btn.style.display = "block";
    //   } else {
    //     btn.style.display = "none";
    //   }
    // }

    //Modal edit
    $(function(){
      $(document).on('click','.edit-buffer',function(e){
        e.preventDefault();
        $.post("<?php echo base_url('BOQperSiteMT1/modalEditData') ?>",
          {id:$(this).attr('data-id')},
          function(html){
            $("#editData").modal('show');
            $("#modalEditData").html(html);
            $(document).on('click','.button-update',function(e){
              e.preventDefault();

            });
          }   
        );
      });
    });

    // ajax submit edit data
    $(function(){
          $(document).on('click','.submit-edit',function(e){
            if(document.getElementById('idUpdate').value == "" ){
              alert("Please complete all information requested on this form");
            }else{
              if(document.getElementById('qty_actual_mapEdit').value == '' ){
                alert("Data can't be null!");
              }else{
                $.ajax({
                  url : "<?php echo base_url('BOQperSiteMT1/modalUpdateData') ?>",
                  method : 'post',
                  data : 
                  {
                    id : document.getElementById('idUpdate').value,
                    qty_actual_map : document.getElementById('qty_actual_mapEdit').value
                  },
                  success : function(respone)
                  { 
                    console.log(document.getElementById('idUpdate').value);
                    console.log('id |')
                    $("#editData").modal('hide');
                    // load_data();
                    // table.ajax.reload( null, false );
                    // if(respone ==1){
                    //   alert("Success update");
                    // }
                    alert(respone);
                  }
                });
              }              
            }
          });
    });

    //Modal delete
    $(function(){
      $(document).on('click','.confirm-buffer',function(e){
        e.preventDefault();
        
        $.post("<?php echo base_url('BOQperSiteMT1/modalConfirmData') ?>",
          {id:$(this).attr('data-id')},
          function(html){
            $("#confirmData").modal('show');
            $("#modalConfirmData").html(html);
          }   
        );
      });
    });

    // ajax submit confirm data
    $(function(){
      $(document).on('click','.submit-confirm',function(e){
        $.ajax({
          url : "<?php echo base_url('BOQperSiteMT1/confirmData') ?>",
          method : 'post',
          data : 
          {
            id : document.getElementById('id').value,
            qty_plan_map : document.getElementById('qty_plan_map').value
          },
          success : function(respone)
          {
            $("#confirmData").modal('hide');
            table.ajax.reload( null, false );
            if(respone == 1){
              alert("Success Confirm Data");
            }else{
              alert(respone);
            }
          }
        });
      });
    }); 

  <?php } ?>


  <?php if($page_title == "Cron Job | NOKIA") { ?>
     //get data Cron Job
        var table = $('.data-cronjob').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"63.6vh", //awalnya tidak ada
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": [0,3]},
            { "width": "20%", "targets": 2 }
          ],
          "sAjaxSource": "<?php echo base_url('Cronjob/get_data'); ?>"
        });       

        $('.data-cronjob tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
     // ajax modal edit cron job
         $(function(){
              $(document).on('click','.edit-cronjob',function(e){
                  e.preventDefault();
                  $("#editCronjob").modal('show');
                  $.post("<?php echo base_url('Cronjob/modalEditCronjob') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modalEditCronjob").html(html);
                      }   
                  );
              });
          });

      // ajax submit edit cron job
         $(function(){
            $(document).on('click','.submit-edit',function(e){
              if(document.getElementById('id').value == "" || document.getElementById('email').value == "" || document.getElementById('remarks').value == ""){
                alert("Please complete all information requested on this form");
              }else{
                $.ajax({
                  url : '<?php echo base_url('Cronjob/update_data') ?>',
                  method : 'post',
                  data : 
                  {
                    id    : document.getElementById('id').value,
                    email : document.getElementById('email').value,
                    remarks : document.getElementById('remarks').value
                  },
                  success : function(respone)
                  {
                    $("#editCronjob").modal('hide');
                    table.ajax.reload( null, false );
                    if(respone ==1){
                      alert("Success update");
                    }
                  }
                });
              }
            });
          });
  <?php } ?>



</script>
