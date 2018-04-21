
<? $this->load->view('template/css-link'); ?>
 
<body class="hold-transition skin-blue sidebar-mini" onLoad="txtID.focus()">
<div class="wrapper">
<?php
 	// header
	 $data['menu']=array('FID'  => $FID ) ;
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
        <small><? echo $submenu ?></small>      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><? echo $menu  ?></a></li>
        
        <li class="active"><? echo $submenu; ?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content" id="sec1"    >
        <? $this->load->view('template/tombol'); ?>
      <!--  end tombol       -->  	
      	<? 
			if($this->session->flashdata('status')=='gagal')
			{
				//error
				 ?>
       		 	<div class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                	<h4><i class="icon fa fa-check"></i> Gagal!</h4>
                	Data tidak berhasil disimpan !             	</div>
           		<? 
			}elseif($this->session->flashdata('status')=='sukses')
			{
				//berhasil simpan
		   ?>
       		  <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Data berhasil disimpan !             </div>
             
           <? 
		   }
		    ?>
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-home">&nbsp; </i><strong> Identitas Perusahaan</strong></a></li>
              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <p></p>
				<?  $this->load->view('perusahaan/v_tabadd');   ?>
                
              </div>
              <!-- /.tab-pane -->
    
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
 
      </div>
      <!-- /.row -->
      <!-- END CUSTOM TABS -->
     
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
     $('.select2').css('width','300px').select2({allowClear:true})
		.on('change', function(){
			$(this).closest('form').validate().element($(this));
		}); 
    $('#datatabel').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
	 
	
 	// date time picker
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})
	//show datepicker when clicking on the icon
	.next().on("click", function(){
		$(this).prev().focus();
	}); 
	 $('.date-picker').datepicker({autoclose:true}).on('changeDate', function(ev) {
		$(this).closest('form').validate().element($(this));
	});
	 
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
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
			txtperusahaan: {
				required: true
			} ,
			 
			cbojalan: {
				required: true
			},
			cbokelurahan: {
				required: true
			},
			txtlokasidet: {
				required: true
			} 
					
		},
		messages: {
			 
			txtperusahaan: {
				required: "Data tidak boleh kosong !",							 
			}, 
			cbojalan: {
				required: "Data tidak boleh kosong !",							 
			},
			cbokelurahan: {
				required: "Data tidak boleh kosong !",							 
			},
			txtlokasidet: {
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
