
<? $this->load->view('template/css-link'); ?>
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
        <? echo $menu  ; ?> 
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
			}elseif($this->session->flashdata('status')=='sukses' && $this->session->flashdata('error')==="OK")
			{
				//berhasil simpan
		   ?>
       		  <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Data berhasil diupdate dan File berhasil diupload !  
             </div>
           <? 
		   }
		   elseif($this->session->flashdata('status')=='sukses' && $this->session->flashdata('error') <> "OK")
			{
				//berhasil simpan
		   ?>
       		  <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Data berhasil diupdate ! <?  echo $this->session->flashdata('error'); ?>
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
 
    <!-- /.content -->
        <div class="col-xs-12">
        <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Filter</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
             
          </div>
        </div>
        <div class="box-body">
            <form class="form-horizontal" method="post" id="form1" name="form1" action="<? echo base_url() ?>pengawasan" >
              <div class="box-body">
                 
                <div class="form-group">
                      <label for="txttglturun" class="block col-sm-2 control-label">Tgl.Turun mulai</label>
                      <div class=" col-sm-2" >
                            <div class="input-group">
                                <input class="form-control date-picker" id="txttglturun" name="txttglturun" value="<?   echo $this->mycombo->FormatYMD($_SESSION['tglps1']); ?>"  placeholder="dd-mm-yyyy" type="text" data-date-format="dd-mm-yyyy" />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>
                      </div>
                </div>
                <div class="form-group">
                      <label for="txttglturun2" class="block col-sm-2 control-label">Tgl.Turun sampai</label>
                      <div class=" col-sm-2" >
                            <div class="input-group">
                                <input class="form-control date-picker" id="txttglturun2" name="txttglturun2" value="<?   echo $this->mycombo->FormatYMD($_SESSION['tglps2']); ?>"  placeholder="dd-mm-yyyy" type="text" data-date-format="dd-mm-yyyy" />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>
                      </div>
                </div>
                 <div class="form-group">
                      <label for="txttglturun" class="block col-sm-2 control-label"></label>
                      <div class=" col-sm-2" >
                            <div class="input-group">
                               <input name="cmdFilter" type="submit" value="Filter" id="cmdFilter" class="btn btn-primary">  
                            </div>
                      </div>
                </div>
                
              </div>
              <!-- /.box-body -->
      
                  <div class="col-sm-6">
                    
                    
                  </div>

            </form>
        </div>
        <!-- /.box-body -->
        
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
        
        
          <div class="box  box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><? echo $menu; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" id="boxlist"  >
              <table width="100%" class="table table-bordered table-striped table-hover" id="datatabel">
                <thead>
                <tr>
                  <th width="48">ID</th>
                  <th width="95">Tgl Turun</th>
                  <th width="148"> Perusahaan</th>
                  <th width="215"> Alamat Perusahaan</th>
                  <th width="94" align="center">No. Telp</th>
                  <th width="124" align="center">No. Ijin Prinsip</th>
                  <th width="125" align="center">Bidang Usaha</th>
                  <th width="203" align="center">Catatan</th>
                  <th width="50" align="center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <? 
					foreach($alldata as $row )
					{
					  	switch ($row['jenismonitoring_id'])
						{
							case	"PM"	:	$label="label-primary"; break ;
							case	"PB"	:	$label="label-warning"; break ;
							case	"PS"	:	$label="label-danger"; break ;	
						
						}
						($row['monit_id']=="" ? $idmonit="new" : $idmonit=$row['monit_id']);
				 ?>
                <tr>
                  <td align="center"><? echo $row['monit_id'] ; ?><br><span class="label <? echo $label ?>"><? echo $row['jenismonitoring_id']; ?></span></td>
                  <td><? echo $this->mycombo->NamaHari($row['jadwal_tgl']) ."<BR>".  $this->mycombo->FormatDMY($row['jadwal_tgl']); ?></td>
                  <td><? echo $row['prs_nama']; ?></td>
                  <td><? echo $row['namajalan'].",".$row['prs_lokasidet'] .",".$row['kelurahan'] .",".$row['kecamatan']  ; ?></td>
                  <td align="center"><? echo $row['prs_telpkantor']." / ". $row['prs_telpcontact']; ?></td>
                  <td align="center"><? echo $row['prs_noIPPMA']; ?></td>
                  <td align="center"><? echo $row['prs_bidangusaha']; ?></td>
                  <td align="left"><? echo $row['catatanlapangan']; ?></td>
                  <td align="center"><? echo anchor('pengawasan/edit/'.$row['jadwal_id'] ."/".$idmonit  , '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning tooltips" data-placement="top" data-original-title="Edit"') . ' 
                        '. anchor('pengawasan/delete/'  .$row['prs_id']  ."/".$idmonit  , '<i class="fa fa-trash"></i>',  'class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Edit"  onclick="return confirmDialog()"'  ) ; ?></td>
                </tr>
                <?
				
					}
				?>
                </tbody>
              </table>
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
</script>
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
	  "order": [[ 0, "desc" ]],
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
			txttglturun: {
				required: true
			},
			cbokegiatan: {
				required: true
			} 
					
		},
		messages: {
			 
			txttglturun: {
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
