
<? $this->load->view('template/css-link'); ?>
 <link rel="stylesheet" href="<?  echo base_url() ?>assets/dist/css/ace_upload.css" class="ace-main-stylesheet"  />

<body class="hold-transition skin-blue sidebar-mini" onLoad="load_data_arsip('<?  echo $rowedit['prs_id'];  ?>');load_data_galery('<?  echo $rowedit['prs_id'];  ?>');load_data_carousel('<?  echo $rowedit['prs_id'];  ?>');">
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
              <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-briefcase">&nbsp; </i><strong> Data Administratif</strong></a></li>
              <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-television">&nbsp; </i><strong> Data Perijinan</strong></a></li>
              <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-calculator">&nbsp; </i><strong> Data Teknis</strong></a></li> 
              <li><a href="#tab_5" data-toggle="tab"><i class="fa fa-image">&nbsp; </i><strong> Galerry</strong></a></li> 
              <li><a href="#tab_6" data-toggle="tab"><i class="fa fa-list-ol">&nbsp; </i><strong> History</strong></a></li>
              <li><a href="#tab_7" data-toggle="tab"><i class="fa fa-book">&nbsp; </i><strong> Arsip </strong></a></li>
              <li><a href="#tab_8" data-toggle="tab"><i class="fa fa-map-o">&nbsp; </i><strong> MAPS</strong></a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <p></p>
				<?  $this->load->view('perusahaan/v_tab1');   ?>
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <p></p>
				<?  $this->load->view('perusahaan/v_tab2');   ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                 <p></p>
				<?  $this->load->view('perusahaan/v_tab3');   ?>
              </div>
              <div class="tab-pane" id="tab_4">
                 <p></p>
				<?  $this->load->view('perusahaan/v_tab4');   ?>
              </div>
              <div class="tab-pane" id="tab_5">
                 <p></p>
				<?  $this->load->view('perusahaan/v_tab5');   ?>
              </div>
              <div class="tab-pane" id="tab_6">
                 <p></p>
				<?  $this->load->view('perusahaan/v_tab6');   ?>
              </div>
              <div class="tab-pane" id="tab_7">
                 <p></p>
				<?  $this->load->view('perusahaan/v_tab7');   ?>
              </div>
              <div class="tab-pane" id="tab_8">
                 <p></p>
				<?  $this->load->view('perusahaan/v_tab8');   ?>
              </div>
              
              
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
	function load_data_arsip(id)
	{
   
		$.ajax({
			type: 'post',
			url: "<?php echo base_url('perusahaan/tampil_arsip'); ?>",
			data: {
				id:id,
				 
			}, 
			success: function (response) {
			// We get the element having id of display_info and put the response inside it
			
			 $('#xtabelarsip').html(response);
				//document.getElementById( "hasil" ).value=response;
			}
	   });
	}
	
	function load_data_galery(id)
	{
		$.ajax({
			type: 'post',
			url: "<?php echo base_url('perusahaan/tampil_galery'); ?>",
			data: {
				id:id,
				 
			}, 
			success: function (response) {
			// We get the element having id of display_info and put the response inside it
			
			 $('#xtabelgalery').html(response);
				//document.getElementById( "hasil" ).value=response;
			}
	   });
	
	}

	function load_data_carousel(id)
	{
		$.ajax({
			type: 'post',
			url: "<?php echo base_url('perusahaan/tampil_carousel'); ?>",
			data: {
				id:id,
				 
			}, 
			success: function (response) {
			// We get the element having id of display_info and put the response inside it
			
			 $('#xcarousel').html(response);
				//document.getElementById( "hasil" ).value=response;
			}
	   });
	
	}

	$(document).on("click", ".hapus", function() {
		var id = $(this).attr("data-id");	// id arsip
		var folder = $(this).attr("data-folder");
		var prsid = $(this).attr("data-prsid");
		var file = $(this).attr("data-nama");
		var x= confirm("Apakah anda yakin MENGHAPUS FILE ARSIP perusahaan ini ?")
		if(x===false) return 0;
		$.ajax({
			type: 'post',
			url: "<?php echo base_url('perusahaan/hapusfile'); ?>",
			data: {
				id:id,
				folder:folder,
				file:file,
				prsid:prsid,
			}, 
			success: function (response) {
			// We get the element having id of display_info and put the response inside it
			 // $('#xtabelarsip').html(response);
				load_data_arsip(prsid)
				//document.getElementById( "hasil" ).value=response;
			}
	   });
  
	})
	$(document).on("click", ".hapusfoto", function() {
		var id = $(this).attr("data-id");	// id foto
		var folder = $(this).attr("data-folder"); 
		var prsid = $(this).attr("data-prsid");
		var file = $(this).attr("data-nama");
		var monitid = $(this).attr("data-monitid");
		var x= confirm("Apakah anda yakin MENGHAPUS FILE FOTO perusahaan ini ?")
		if(x===false) return 0;
		$.ajax({
			type: 'post',
			url: "<?php echo base_url('perusahaan/hapusfoto'); ?>",
			data: {
				id:id,
				folder:folder,
				file:file,
				prsid:prsid,
				monitid:monitid,
			}, 
			success: function (response) {
			// We get the element having id of display_info and put the response inside it
			 // $('#xtabelgalery').html(response);
				load_data_galery(prsid);
				load_data_carousel(prsid);
				//document.getElementById( "hasil" ).value=response;
			}
	   });
  
	})

			
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
	 // file input
	 $('.tes').ace_file_input({
		no_file:'No File ...',
		btn_choose:'Choose',
		btn_change:'Change',
		droppable:false,
		onchange:null,
		thumbnail:false //| true | large
		//whitelist:'gif|png|jpg|jpeg'
		//blacklist:'exe|php'
		//onchange:''
		//
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
	// validation tab1
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
 	// validation tab 4
	 $('#form4').validate({
		errorElement: 'div',
		errorClass: 'help-block',
		focusInvalid: true,
		ignore: "",
		rules: {						 
			txtnilairp: {
				required: true,
				number: true
			} ,
			txtnilaiusd: {
				required: true,
				number: true
			} , 
			txtwnilaki: {
				required: true,
				number: true
			} ,
			txtwniperempuan: {
				required: true,
				number: true
			} ,
			txtlat: {
				required: true,
				number: true
			} ,  
			txtlong: {
				required: true,
				number: true
			} , 
			txtwnalaki: {
				required: true,
				number: true
			} , 
			txtwnaperempuan: {
				required: true,
				number: true
			} ,
			cbokategory: {
				required: true,
				 
			} ,
			cbomasalah: {
				required: true,
				 
			}    
		},
		messages: {
			 
			txtnilairp: {
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
	// validation tab 7
	 $('#form7').validate({
		errorElement: 'div',
		errorClass: 'help-block',
		focusInvalid: true,
		ignore: "",
		rules: {						 
			 
			txtketerangan: {
				required: true,
				 
			}  
		},
		messages: {
 
			txtketerangan: {
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
