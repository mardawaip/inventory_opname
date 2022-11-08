<head>
	<?php $this->load->view('global/header'); ?>
</head>
<body>
    <!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						
						<div class="content">
							<div class="header">
								<div class="logo text-center"><h2>Inventory Blanko</h2></div>
								<p class="lead">Form Login</p>
								<div id="error"></div>
							</div>
							<form class="form-auth-small" action="index.php">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Username</label>
									<input type="text" class="form-control" id="signin-name" placeholder="Username">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" id="signin-password" placeholder="Password">
								</div>
								
								<button type="submit" class="btn btn-error btn-lg btn-block" id="btn_login">Login</button>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading"><b>Aplikasinya Sistem Monitoring Pengajuan Blanko</b></h1>
							<p>Dinas kependudukan dan pencatatan sipil</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){

       $('#btn_login').click(function(e){
			
			var user = $('#signin-name').val();
			var password = $('#signin-password').val();
			$.ajax({
            type: "POST",
            url: "auth/login",
            data: 'user='+user+'&password='+password,
                      
            success: function(response){
               if(response== "success")
                {
					window.location = '<?php echo base_url(); ?>';
                   
                }
                else
                {
                    //alert(response);
                    $("#error").html('<div class="alert alert-danger alert-dismissible" role="alert"> <i class="fa fa-exclamation-triangle"></i> &nbsp; Login Error !</div>');
                }
               
            } 
        	});

			e.preventDefault();
	   });
	  
    });
</script>