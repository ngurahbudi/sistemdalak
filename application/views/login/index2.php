<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><? echo PROJNAME; ?></title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<? $this->load->view('template/css-link'); ?>
       <!-- ace styles -->
		<link rel="stylesheet" href="<? echo base_url(); ?>assets/dist/css/ace.min.css" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<? echo base_url(); ?>assets/dist/css/ace-rtl.min.css" />
       
    </head>
	<body class="login-layout blur-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center"><i class=""/>
								<h1>
									<span class="red">SIMPANAS</span></h1>
							  <h4 class="blue" id="id-company-text">&copy; DALAK - DPMPTSP Kota Denpasar</h4>
							</div>
							<div class="space-6"></div>
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-user green"></i>
												Informasi Login</h4>

											<div class="space-6"></div>

											<form id="login-form" >
									    <fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="txtusername" type="text" class="form-control" id="txtusername" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>														</span>													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="txtpassword" type="password" class="form-control" id="txtpassword" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>														</span>													</label>

													<div class="space"></div>

													<div class="clearfix">
 
														<button type="submit" id="btnLogin" name="btnLogin" class="width-35 pull-right btn btn-sm btn-primary" onClick="generatenomor()"  >
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>																		                                                         </button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

									  <div class="social-or-login center">
												<span class="bigger-110">(c) 2018</span>
                                              </div>

											<div class="space-6"></div>

											 
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix center">
 											<div></div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
 
								 
							</div><!-- /.position-relative -->

							 
						</div>
					</div>
					<!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<? echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
 		<script src="<? echo base_url(); ?>assets/plugins/jqueryvalidator/jquery.validate.min.js"></script>
		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		 

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			 $('#login-form').validate({
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
