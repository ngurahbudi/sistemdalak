
<? $this->load->view('template/css-link'); ?>
<body class="hold-transition skin-blue sidebar-mini" onLoad="txtuser.focus()">
<div class="wrapper">
<?php
	$data['menu']=array('FID'  => $FID ) ;
 	// header
 	 $this->load->view('template/header');
     // <!-- Left side column. contains the logo and sidebar -->
 	 $this->load->view('template/sidemenu',$data);
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <? echo $menu ?>
        <small><? echo $submenu ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><? echo $menu  ?></a></li>
        
        <li class="active"><? echo $submenu; ?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content" id="sec1"    >
      <? $this->load->view('template/tombol'); ?> 
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><? echo $menu; ?></h3>
              
            </div>
            <!-- /.box-header -->
            
         
            <div class="box-body" id="boxedit"  >
            	 <!-- form start -->
             
            <form class="form-horizontal" method="post" id="form1" name="form1" action="<? echo base_url() ?>user/edit" >
              <div class="box-body">
                <div class="form-group">
                  <label for="txtID" class="block col-sm-2 control-label">User ID</label>
                  <div class="col-sm-4">
                    <input type="input" readonly class="form-control" name="txtID" id="txtID" value="<?  echo $rowedit['userid'];  ?>" placeholder="Auto ID">
                  </div>
                </div>
                 <div class="form-group">
                    <label for="txtuser" class="block col-sm-2 control-label">Nama User</label>
                    	<div class="col-sm-6">
                    		<span class="block  ">
                        		<input name="txtuser"   type="text" class="form-control" id="txtuser" value="<?  echo $rowedit['usernama'];  ?>" placeholder="Nama User" />
                    		</span>
                    	</div>
                    </label>
                </div> 
                <div class="form-group">
                    <label for="txtuser" class="block col-sm-2 control-label">Kecamatan</label>
                    	<div class="col-sm-6" >
                        	<select id="cbogroup" name="cbogroup" class="select2 "  data-placeholder="- Pilih -"  >  
								<?    
                                        foreach($row_cbogroup as $row )
                                        {
                                ?>
                                        <option   value="<? echo $row['groupuser_id']; ?>" <? if($rowedit['groupuser_id']==$row['groupuser_id']) echo "Selected" ?>    ><? echo $row['groupuser']; ?></option>
                                     <? } ?>
							</select>
                    	</div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              	<div class="form-group">
                  <label for="" class="col-sm-2 control-label"></label>

                  <div class="col-sm-6">
                   <input name="cmdUpdate" type="submit" value="Update" id="cmdUpdate" class="btn btn-primary">
                    <input name="cmdBatal" type="button" value="Batal" id="cmdBatal" class="btn btn-info" onClick="window.location.replace('<? echo base_url() ?>user');">
                  </div>
                </div>
               
                
              </div>
              <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content  -->
  </div>
  <!-- /.content-wrapper -->
  <?
  	//footer
  	$this->load->view('template/footer');
  	//control right side bar
	$this->load->view('template/control_sidebar');
  ?>
</div>
<!-- ./wrapper -->
 <?   //javascript link
   	$this->load->view('template/js-link');
 ?>	
<!-- page script -->
 
<script>			
  $(function () {
    
    $('#datatabel').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
 
	  $('.select2').css('width','300px').select2({allowClear:true})
		.on('change', function(){
			$(this).closest('form').validate().element($(this));
		});  
		
	//*** auto close alert
	window.setTimeout(function() {
	$(".alert").fadeTo(500, 0).slideUp(500, function(){
	 $(this).remove(); 
	 });
	}, 2000);
	
	 $('#form1').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
					rules: {						 
						txtuser: {
							required: true
						} ,
						txtID: {
							required: true
						},
						cbogroup: {
							required: true
						}  
								
					},
					messages: {
						txtID: {
							required: "Data tidak boleh kosong !",							 
						} ,
						txtuser: {
							required: "Data tidak boleh kosong !",							 
						}, 
						cbogroup: {
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
				 
 
  });
</script>
</body>
</html>
