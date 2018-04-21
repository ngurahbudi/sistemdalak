
<? $this->load->view('template/css-link'); ?>
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; font-size:10px }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  </style>
<body class="hold-transition skin-blue sidebar-mini">
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
        <div class="col-xs-12">
          <div class="box  box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><? echo $menu; ?></h3>
              <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
             
          </div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body"   >
            <form class="form-horizontal" method="post" id="form1" name="form1"  action="<? echo base_url() ?>laporan/search" >
               
               <!-- modal !-->
                <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Custom Column</h4>
                    </div>
                    <div class="modal-body">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Pilih Nama Kolom yang ingin ditampilkan</h3>
                          
                          <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                               
                              <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i><span> Pilih Semua</span>
                              
                            </div>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">
                          
                         <ul id="sortable">
                            <? 
                            foreach($custom_column as $row)
                            {
                              ?>  
                            
                                
                                <li  class="mailbox-messages" style="cursor:move;"><span style="border-bottom:thin;border-bottom-style:dashed"><? echo "$row[COLUMN_COMMENT]  "; ?></span><span style="float:left;margin-left:70%"><input  type="checkbox"  name="ceklist[]"   value="<? echo "$row[COLUMN_NAME]/$row[COLUMN_COMMENT]"; ?>"></span></li>
             
                                
                                                
                            <? } ?>
                          </ul>
                         
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <div class="modal-footer">
                      <input name="cmdFilter2"  id="cmdFilter2" class="btn btn-primary btn-sm" value="Export" type="submit"  > 	
                      <button type="button" id="btnclose" name="btnclose" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  
                </div>
              </div>
              <!-- end Modal content-->
               
               <!--  end modal -->
              <div class="box-body">  
               <div class="form-group">
                    <label for="cbokategory" class="block col-sm-2 control-label">Kategori Masalah</label>
                    	<div class="col-sm-6" >
                        	<select id="cboklasmasalah" name="cboklasmasalah" class="select2 "  data-placeholder="- Pilih -"  >  
                            	<option   value="all"    >- Semua -</option>
								<?    
                                        foreach($row_cboklasmasalah as $row )
                                        { 
                                ?>
                              <option   value="<? echo $row['klasmasalah']; ?>"  <? ($row_filter['klasmasalah_id']==$row['klasmasalah_id']) ? $select="selected" : $select="" ; echo $select; ?>   ><? echo $row['klasmasalah'] ; ?></option>
                                     <? } ?>
						  </select>
                   	</div>
                </div> 
                <div class="form-group">
                    <label for="cbokategory" class="block col-sm-2 control-label">Kategori Perusahaan</label>
                   	<div class="col-sm-6" >
                        	<select id="cbokategory" name="cbokategory" class="select2 "  data-placeholder="- Pilih -"  >  
                            	<option   value="all"    >- Semua -</option>
								<?    
                                        foreach($row_cbokategory as $row )
                                        { 
                                ?>
                                        <option   value="<? echo $row['kategory']; ?>" <? ($row_filter['kategory_id']==$row['kategory_id']) ? $select="selected" : $select="" ; echo $select; ?>    ><? echo $row['kategory'] ; ?></option>
                                     <? } ?>
					        </select>
                   	</div>
                </div> 
                <div class="form-group">
                    <label for="cboaktif" class="block col-sm-2 control-label">Status Aktif</label>
                    	<div class="col-sm-6" >
                        	<select id="cboaktif" name="cboaktif" class="select2 "  data-placeholder="- Pilih -"  >  
                            <option   value="all"    >- Semua -</option>
								<?    
                                        foreach($row_cboaktif as $row )
                                        {
                                ?>
                       <option   value="<? echo $row['statusaktif']; ?>"  <? ($row_filter['aktif_id']==$row['aktif_id']) ? $select="selected" : $select="" ; echo $select; ?>    ><? echo $row['statusaktif']; ?></option>
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
                   <span><input name="cmdFilter"  id="cmdFilter" class="btn btn-primary btn-sm" value="Export" type="submit"></span>
                   <span><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Custom Export</button></span>  
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
function confirmDialog() {
    return confirm("Apakah anda yakin ingin menghapus data ini ?")
}

    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();


</script>
<script>			
  $(function () {
   		$('.select2').css('width','500px').select2({allowClear:true})
		.on('change', function(){
			$(this).closest('form').validate().element($(this));
		});  
		
	 //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });	 
	  //iCheck for checkbox and radio inputs
   
	$('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_flat-blue'
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
						txtKlasifikasi: {
							required: true
						} 
								
					},
					messages: {
						 
						txtKlasifikasi: {
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
				 
 		 $('#form2').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
					 
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
						alert('sukses');
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
					alert('sss');
					  //$(form).ajaxSubmit();
				    },
					invalidHandler: function (form) {
					}
				});
  });
</script>
</body>
</html>
