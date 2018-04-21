
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
              
            </div>
            <!-- /.box-header -->
            
            <div class="box-body" id="boxlist" >
              <table width="100%" class="table table-bordered table-striped table-hover" id="datatabel">
                <thead>
                <tr>
                  <th width="45"> ID</th>
                  <th width="232"> Nama Perusahaan</th>
                  <th width="334"> Lokasi</th>
                  <th width="210" align="center">Bidang Usaha</th>
                  <th width="98" align="center">Status</th>
                  <th width="37" align="center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <? 
					foreach($alldata as $row )
					{
					  ($row['aktif_id']=='0' ? $style="style='color:#FF0000'" : $style="" ) ;
					  switch ($row['klasmasalah_id'])
					  {
					  		case "KM.01"		: $status="Sehat"; $label="label-success"; break;
					  		case "KM.02"		: $status="Warning"; $label="label-warning";break;
							case "KM.04" 		: $status="Sakit"; $label="label-danger";break;
							default				: $status=""; $label="label-warning";break;
					  } 
					  if( $row['aktif_id']==0) { $status="Non Aktif"; $label="label-danger"; }
					  
				 ?>
                <tr <? echo $style ?>>
                  <td><? echo $row['prs_id']; ?></td>
                  <td><? echo $row['prs_nama']; ?></td>
                  <td><? echo $row['namajalan']." ".$row['prs_lokasidet'].", ". $row['kelurahan'] .", ". $row['kecamatan']; ?></td>
                  <td><? echo $row['prs_bidangusaha']; ?></td>
                  <td align="center"><span class="label <? echo $label ?>"><? echo $status; ?></span></td>
                  <td align="center"><? echo anchor('perusahaan/edit/'.$row['prs_id']  , '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning tooltips" data-placement="top" data-original-title="Edit"') . ' 
                        '. anchor('perusahaan/delete/' .$row['prs_id'] , '<i class="fa fa-trash"></i>',  'class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Edit"  onclick="return confirmDialog()"'  ) ; ?></td>
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
    return confirm("Apakah anda yakin ingin ME-NON AKTIFKAN perusahaan ini ?")
}
</script>
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
				 
 
  });
</script>
</body>
</html>
