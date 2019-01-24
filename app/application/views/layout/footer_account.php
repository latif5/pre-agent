<!-- jQuery  -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>

		<!-- App js -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.core.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.app.js"></script>

		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
        <!-- slider -->
        <script src="<?php echo base_url('assets/js/jquery.bxslider.js'); ?>"></script>
        <!-- Parsley js -->
        <script src="<?php echo base_url(); ?>assets/plugins/parsleyjs/parsley.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js" type="text/javascript"></script>
		

      	<script type="text/javascript">
      		<?php if($this->session->flashdata('gagal')){ ?>
			$(window).on('load',function(){
			 	$('#modal_gagal').modal('show');
			});
			<?php } ?>
			<?php if($this->session->flashdata('success')){ ?>
			$(window).on('load',function(){
			 	$('#modal_success').modal('show');
			});
			<?php } ?>
			
			$( document ).ready( function () {

		    $("#form-signup").validate( {
		        rules: {
		          nama: "required",
		          user_name: {
		            required: true,
		            minlength: 5,
		            remote: "<?php echo base_url();?>Auth/checkUserAviable"
		          },
		          password: {
		            required: true,
		            minlength: 5
		          },
		          re_password: {
		            required: true,
		            minlength: 5,
		            equalTo: "#password"
		          },
		          email: {
		            required: true,
		            email: true
		          }
		        },
		        messages: {
		          nama: "Please enter your fullname",
		          user_name: {
		            required: "Please enter a username",
		            minlength: "Your username must consist of at least 5 characters",
		            remote: $.validator.format("{0} this username alredy uses!")

		          },
		          password: {
		            required: "Please provide a password",
		            minlength: "Your password must be at least 5 characters long"
		          },
		          re_password: {
		            required: "Please provide a password",
		            minlength: "Your password must be at least 5 characters long",
		            equalTo: "Please enter the same password as above"
		          },
		          email: "Please enter a valid email address",
		        },
		        errorElement: "em",
		        errorPlacement: function ( error, element ) {
		          // Add the `help-block` class to the error element
		          error.addClass( "help-block" );

		          // Add `has-feedback` class to the parent div.form-group
		          // in order to add icons to inputs
		          element.parents( ".col-12" ).addClass( "has-feedback" );

		          if ( element.prop( "type" ) === "checkbox" ) {
		            error.insertAfter( element.parent( "label" ) );
		          } else {
		            error.insertAfter( element );
		          }

		          // Add the span element, if doesn't exists, and apply the icon classes to it.
		          if ( !element.next( "span" )[ 0 ] ) {
		            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
		          }
		        },
		        success: function ( label, element ) {
		          // Add the span element, if doesn't exists, and apply the icon classes to it.
		          if ( !$( element ).next( "span" )[ 0 ] ) {
		            $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
		          }
		        },
		        highlight: function ( element, errorClass, validClass ) {
		          $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
		          $( element ).next( "div" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
		        },
		        unhighlight: function ( element, errorClass, validClass ) {
		          $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
		          $( element ).next( "div" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
		        }
		      } );
		    });
      	</script>
		
    </body>
</html>