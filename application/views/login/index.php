 
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><? echo PROJNAME; ?></title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link href="<? echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<? echo base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		 
        <!-- text fonts 
		<link rel="stylesheet" href="<? //echo base_url(); ?>assets/font/fonts.googleapis.com.css" />-->
		
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
        
		<![endif]-->
        
        <style>
      @font-face{font-family:'FontAwesome';src:url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.eot?v=4.5.0');src:url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.eot?#iefix&v=4.5.0') format('embedded-opentype'),url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.woff2?v=4.5.0') format('woff2'),url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.woff?v=4.5.0') format('woff'),url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.ttf?v=4.5.0') format('truetype'),url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.svg?v=4.5.0#fontawesomeregular') format('svg');font-weight:normal;font-style:normal}
       
		 .has-error{
		 	font:Arial, Helvetica, sans-serif;color:#990000; font-size:24px;
		 
		 }
 	
 
	 
        </style>

	 <!-- ace styles -->
		<link rel="stylesheet" href="<? echo base_url(); ?>assets/dist/css/ace.min.css" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<? echo base_url(); ?>assets/dist/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout" onLoad="document.getElementById('txtusername').focus()">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
                                
								<h1><i class="fa fa-user" ></i>
									<span class="red">Login</span>
									<span class="white" id="id-text2">Sistem</span>
								</h1>
								  <h4 class="blue" id="id-company-text">SIMPANAS</h4>  
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
										  <h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Informasi login
										  </h4>
                                            <?php  
											if($this->session->flashdata('message'))
											 {
												?>
												<div class="alert alert-block alert-danger">
													<button type="button" class="close" data-dismiss="alert" onClick="document.getElementById('txtuserid').focus()">
														<i class="ace-icon fa fa-times"></i>
													</button>
													<strong>GAGAL,</strong> <? echo $this->session->flashdata('message') ?>
												</div>
												<?
											 }  
										
										?>
											<form action="<? base_url() ?>login/ceklogin" method="post" name="form-login" target="_self" id="form-login">
												<fieldset>
													<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input name="txtusername"   type="text" class="form-control" id="txtusername" placeholder="Username" />
													<i class="ace-icon fa fa-user"></i>
													</span>
													</label>

													<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input name="txtpassword" type="password" class="form-control" id="txtpassword" value="" placeholder="Password" />
														<i class="ace-icon fa fa-lock"></i>
													</span>
													</label>

													<div class="space"></div>

													<div class="clearfix pull-right">
                                                    <!--
													  <button type="button" class="width-35 pull-right btn btn-sm btn-primary"   >
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
													  </button> -->
                                                       <input class="btn btn-default" name="login" type="submit" value="Login"> 
													</div>
												</fieldset>
										  </form> 
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div  style="width:100%;">
												 
                                                  <h5 class="white center" id="id-company-text" align="center">&copy; Dalak - DPMPTSP Kota Denpasar</h5>  
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
										
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->
							 
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
	<script src="<? echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
 	<script src="<? echo base_url(); ?>assets/plugins/jqueryvalidator/jquery.validate.min.js"></script>
    <script src="<? echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
 
	<!-- inline scripts related to this page -->
		<script type="text/javascript">
			 $('#form-login').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
					rules: {						 
						txtusername: {
							required: true
						}, 
						txtpassword: {
							required: true
						} 
								
					},
			
					messages: {
						txtusername: {
							required: "Data tidak boleh kosong !",							 
						},
						txtpassword: {
							required: "Data tidak boleh kosong !",							 
						} 
					},
			
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
			
				    submitHandler: function(form) {
					  $(form).ajaxSubmit();
				    },
					invalidHandler: function (form) {
					}
				});
				
				
			 
		</script>


		 
	</body>
</html>
