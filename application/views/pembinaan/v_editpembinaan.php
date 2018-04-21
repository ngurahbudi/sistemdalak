
<? $this->load->view('template/css-link'); ?>
<!-- ace styles -->
<link rel="stylesheet" href="<?  echo base_url() ?>assets/dist/css/ace_upload.css" class="ace-main-stylesheet"  />
<body class="hold-transition skin-blue sidebar-mini" onLoad="cboklasmasalah.focus()">
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
        <? echo $menu ; ?>
        <small><? echo $submenu ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><? echo $menu  ?></a></li>
        
        <li class="active"><? echo $submenu; ?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content" id="sec1"    >
      <? $this->load->view('template/tombolkegiatan'); ?> 
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><? echo $menu; ?></h3>
              
            </div>
            <!-- /.box-header -->
            
         
            <div class="box-body" id="boxedit"  >
            	 <!-- form start -->
             
            <form class="form-horizontal" method="post" id="form1" name="form1" enctype="multipart/form-data" action="<? echo base_url() ?>pembinaan/edit" >
              <div class="box-body">
                <div class="form-group">
                  <label for="txtpembinaan" class="block col-sm-2 control-label">ID</label>
                  <div class="col-sm-2">
                    <input name="txtIDmonit" id="txtIDmonit" value="<? echo $this->uri->segment(4); ?>" type="hidden">
                    <input name="txtperusahaan" id="txtperusahaan" value="<? echo $rowedit['prs_id']; ?>" type="hidden">
                    <input type="input" readonly class="form-control" name="txtID" id="txtID" value="<?  echo $rowedit['jadwal_id'];  ?>" placeholder="Auto ID">
                  </div>
                </div>
                <div class="form-group">
                      <label for="txttarget" class="block col-sm-2 control-label">Tgl.Turun</label>
                      <div class=" col-sm-2" >
                            <div class="input-group">
                                 <p class="form-control-static"><?  echo $this->mycombo->NamaHari($rowedit['jadwal_tgl']) .", ".$this->mycombo->FormatDMY($rowedit['jadwal_tgl']);  ?></p>
                                
                        </div>
                      </div>
                </div>
                <div class="form-group">
                    <label for="cboperusahaan" class="block col-sm-2 control-label">Perusahaan</label>
                    	<div class=" col-sm-4" >
                            <div class="input-group">
                                 <p class="form-control-static"><?  echo  $rowedit['prs_nama'] . " (" .$rowedit['prs_id']  . " )"   ;  ?></p>
                                
                            </div>
                    </div>
                </div> 
                 <div class="form-group">
                    <label for="cboperusahaan" class="block col-sm-2 control-label">Lokasi Perusahaan</label>
                    	<div class=" col-sm-10" >
                            <div class="input-group">
                                 <p class="form-control-static"><?  echo  $rowedit['namajalan'] .", " . $rowedit['prs_lokasidet'] .", " . $rowedit['kelurahan'] .", ".  $rowedit['kecamatan'];  ?></p>
                                
                            </div>
                      </div>
                </div> 
               <div class="form-group">
                    <label for="cbokategory" class="block col-sm-2 control-label">Kategori Masalah</label>
                    	<div class="col-sm-6" >
                        	<select id="cboklasmasalah" name="cboklasmasalah" class="select2 "  data-placeholder="- Pilih -"  >  
                            	<option   value=""    ></option>
								<?    
                                        foreach($row_cboklasmasalah as $row )
                                        { 
                                ?>
                              <option   value="<? echo $row['klasmasalah_id']; ?>"  <? ($rowedit['klasmasalah_id']==$row['klasmasalah_id']) ? $select="selected" : $select="" ; echo $select; ?>   ><? echo $row['klasmasalah'] ; ?></option>
                                     <? } ?>
						  </select>
                   	</div>
                </div> 
                <div class="form-group">
                    <label for="cbokategory" class="block col-sm-2 control-label">Kategori Perusahaan</label>
                   	<div class="col-sm-6" >
                        	<select id="cbokategory" name="cbokategory" class="select2 "  data-placeholder="- Pilih -"  >  
                            	<option   value=""    ></option>
								<?    
                                        foreach($row_cbokategory as $row )
                                        { 
                                ?>
                                        <option   value="<? echo $row['kategory_id']; ?>" <? ($rowedit['kategory_id']==$row['kategory_id']) ? $select="selected" : $select="" ; echo $select; ?>    ><? echo $row['kategory'] ; ?></option>
                                     <? } ?>
					        </select>
                   	</div>
                </div> 
                <div class="form-group">
                    <label for="txtcatatan" class="block col-sm-2 control-label">Catatan Lapangan</label>
                   	<div class="col-sm-6">
                    		  <div class="input-group">
                       		 <textarea name="txtcatatan" class="form-control" cols="50" rows="5"><?   echo $rowedit['catatanlapangan'];   ?></textarea>
                    		 </div>
                    </div>
                </div> 
                <div class="form-group">
                      <label for="txttarget" class="block col-sm-2 control-label">Tgl.Tenggang Waktu</label>
                      <div class=" col-sm-2" >
                            <div class="input-group">
                                <input class="form-control date-picker" id="txttarget" name="txttarget" value="<?   echo $this->mycombo->FormatDMY($rowedit['targetwaktu']); ?>"  placeholder="dd-mm-yyyy" type="text" data-date-format="dd-mm-yyyy" />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>
                      </div>
                </div>
               <div class="form-group">
                    <label for="txtfile" class="block col-sm-2 control-label">File Foto</label>
                    	<div class=" col-sm-3" >
                            <div class="clearfix" id="bantu">
                                <input type="file"  class="tes" id="txtfile" name="txtfile[]"/> 
                            </div>
                            <div class="btn btn-primary" id="tambah" style="height:30px;font-size:10px;display:inline-block; "><i class="fa fa-plus"></i></div>
                      </div>
                </div> 
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              	<div class="form-group">
                  <label for="" class="col-sm-2 control-label"></label>

                  <div class="col-sm-6">
                   <input name="cmdUpdate" type="submit" value="Update" id="cmdUpdate" class="btn btn-primary">
                    <input name="cmdBatal" type="button" value="Batal" id="cmdBatal" class="btn btn-info" onClick="window.location.replace('<? echo base_url() ?>pembinaan');">&nbsp;<a target="_blank" href="<? echo base_url("perusahaan/edit") . "/". $rowedit['prs_id'] ?>" class="btn btn-success" >Cek Data Perusahaan </a>
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
	$("#tambah").click( function() {
		$("#bantu").append('<input type="file"  class="tes" id="txtfile" name="txtfile[]"/>');
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
	});
			
  $(function () {
    
    $('#datatabel').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
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
 
	  $('.select2').css('width','500px').select2({allowClear:true})
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
						cboklasmasalah: {
							required: true
						} ,  
						txtcatatan: {
							required: true
						} ,   
						cbokategory: {
							required: true
						}  
								
					},
					messages: {
						 
						cboklasmasalah: {
							required: "Data tidak boleh kosong !",							 
						} ,
						txtcatatan: {
							required: "Data tidak boleh kosong !",							 
						} ,
						cbokategory: {
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
