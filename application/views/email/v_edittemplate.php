
<? $this->load->view('template/css-link'); ?>
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<? echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<body class="hold-transition skin-blue sidebar-mini" onLoad="txtID.focus()">
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
        <? // $this->load->view('template/tombol'); ?>
      <!--  end tombol       -->  	
       <? 
			if($this->session->flashdata('status')=='gagal')
			{
				//error
				 
				 ?>
       		 	<div class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                	<h4><i class="icon fa fa-check"></i> Gagal!</h4>
                	Data tidak berhasil diproses ! 
             	</div>
           		<? 
			}elseif($this->session->flashdata('status')=='sukses')
			{
				//berhasil simpan
		   ?>
       		  <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Data berhasil diupdate !  
             </div>
           <? 
		   }
		   elseif($this->session->flashdata('status')=='hapus')
			{
				//berhasil simpan
		   ?>
       		  <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Data berhasil dihapus !  
             </div>
           <? 
		   }
		    ?>
      <div class="row">
        <div class="col-md-3">
          <!-- <a href="<? //echo base_url() ?>email" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a> !-->
				
           
           <?   
		   	$data['row_template']= $this->M_email->SelectAllTemplate();
			$this->load->view('template/menu_email',$data);  ?>
           
          
        </div>
        <!-- /.col -->
        <form method="post" id="form1" name="form1" action="<? echo base_url('email/edittemplate') ?>"  >
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Template</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
              	<input name="txtid" type="hidden" value="<? echo $rowtemplate['template_id'] ?>">
                <input class="form-control" placeholder="Nama Template" id="txtnama" name="txtnama" value="<? echo $rowtemplate['template_nama'] ?>">
              </div>
             
              <div class="form-group">
                    <textarea id="txtpesan" name="txtpesan" class="form-control" style="height: 300px">
                    <? echo $rowtemplate['template_content'] ?>
                      
                     
                    </textarea>
              </div>
              <!-- 
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>-->
            </div>
           <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <a href="<? echo base_url('email/deletetemplate/') . $rowtemplate['template_id'] ?>" id="cmdHapus" name="cmdHapus" class="btn btn-danger"   onClick="return cekHapus()" >Hapus</a>  
                <input type="submit" id="cmdUpdate" name="cmdUpdate" class="btn btn-primary" value="Update Template" > 
                
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
             
            </div>
            <!-- /.box-footer --> 
            <div class="box-footer">
            <ul  >
            	 NB : 
            	<li>Untuk menyisipkan Nama Perusahaan pada content email maka isi dengan tanda  {nama_perusahaan}  </li>
            	<li>Untuk menyisipkan Alamat perusahaan pada content email maka isi dengan tanda  {alamat_perusahaan}  </li> 
                <li>Untuk menyisipkan Tahun Sekarang pada content email maka isi dengan tanda  {tahun_sekarang}  </li>     
            </ul>  
              </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        </form>
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
 <!-- Bootstrap WYSIHTML5 -->
<script src="<? echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- page script -->
 
<script type="text/javascript">		
  function cekHapus()
  {
  		return confirm("Apakah anda yakin ingin menghapus Template ini ?",true);
  }	 
  $(function () {
    //Add text editor
    $("#txtpesan").wysihtml5();
 	//*** auto close alert
	window.setTimeout(function() {
	$(".alert").fadeTo(500, 0).slideUp(500, function(){
	 $(this).remove(); 
	 });
	}, 2000);
	// validation 1
	 $('#form1').validate({
		errorElement: 'div',
		errorClass: 'help-block',
		focusInvalid: true,
		ignore: "",
		rules: {						 
			txtnama: {
				required: true
			} ,
 		
		},
		messages: {
			 
			txtnama: {
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
