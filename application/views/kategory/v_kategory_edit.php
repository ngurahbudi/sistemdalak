<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title><? echo PROJNAME ?></title>
  <!-- Tell the browser to be responsive to screen width -->
 <? $this->load->view('template/css-link'); ?>
 <style>
 	.class-edit{
		font:Arial, Helvetica, sans-serif;
	}
 </style>
</head>
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
        Data Master 
        <small><? echo $sub_judul ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Master</a></li>
        <li><a href="#">Data</a></li>
        <li class="active"><? echo $sub_judul; ?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content" id="sec1"    >
      <div class="row" >
      	<div class="col-xs-12"   >
      		<div  style="position:relative;float:right;margin:5px"  id="btnAdd" class="btn btn-primary " > Add </div>
            <div  style="position:relative;float:right;margin:5px"  id="btnList" class="btn btn-primary " > Data List </div>
        </div>
      </div>  
      <!--  end tombol       -->  	
      	<? 
			if($status>1)
			{
				//error
				 ?>
       		 	<div class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                	<h4><i class="icon fa fa-check"></i> Gagal!</h4>
                	Data tidak berhasil disimpan !. 
             	</div>
           		<? 
			}elseif($status=="simpan")
			{
				//berhasil simpan
		   ?>
       		  <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Data berhasil disimpan !. 
             </div>
           <? 
		   }
		    ?>
      <div class="row">
        <div class="col-xs-12">
			
          <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><? echo $judul_tabel; ?></h3>
              
            </div>
            <!-- /.box-header -->
            
            <div class="box-body" id="boxlist" >
              <table width="" class="table table-bordered table-striped table-hover" id="datatabel">
                <thead>
                <tr>
                  <th width="70">Kategory ID</th>
                  <th width="337">Kategory</th>
                  <th width="5">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <? 
					foreach($rowdata as $row )
					{
				 ?>
                <tr>
                  <td><? echo $row['klasmasalah_id']; ?></td>
                  <td><? echo $row['klasmasalah']; ?></td>
                  <td><? echo anchor('kategory/edit/'.$row['klasmasalah_id']  , '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning tooltips" data-placement="top" data-original-title="Edit"') . ' 
                        '. anchor('kategory/delete/'  , '<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Delete"')  ?></td>
                 </td>
                 
                </tr>
                <?
				
					}
				?>
                </tbody>
                 
              </table>
            </div>
            <!-- /.box-body -->
            <!-- Add another body for adding data "-->
             <div class="box-body" id="boxadd" style="display:none">
            	 <!-- form start -->
            <form class="form-horizontal" method="post" id="form1" name="form1" action="<? echo base_url() ?>kategory/add" >
              <div class="box-body">
                <div class="form-group">
                  <label for="txtID" class="block col-sm-2 control-label">ID</label>
                  <div class="col-sm-4">
                    <input type="input" readonly class="form-control" name="txtID" id="txtID" placeholder="Auto ID">
                  </div>
                </div>
  
                 <div class="form-group">
                    <label for="txtKlasifikasi" class="block col-sm-2 control-label">Klasifikasi</label>
                    	<div class="col-sm-6">
                    		<span class="block  ">
                        		<input name="txtKlasifikasi"   type="text" class="form-control" id="txtKlasifikasi" placeholder="Klasifikasi" />
                    		</span>
                    	</div>
                    </label>
                </div> 
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              	<div class="form-group">
                  <label for="" class="col-sm-2 control-label"></label>

                  <div class="col-sm-6">
                    <button type="submit" id="cmdSimpan" class="btn btn-primary ">Simpan</button>
                     <button type="reset" id="cmdReset" class="btn btn-default">Cancel</button>
                  </div>
                </div>
               
                
              </div>
              <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.box-body -->

             <!-- /.end box body 2 -->
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
	
	$('#btnAdd').click(function(e){
		//alert('sss');
		$("#boxlist").hide();
		$("#boxadd").show(500);
		$("#txtKlasifikasi").focus();
		$("#cmdReset").click();
	});
	$('#btnList').click(function(e){
		//alert('sss');
		$("#boxadd").hide();
		$("#boxlist").show(500);
		 
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
