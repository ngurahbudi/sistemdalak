
<? $this->load->view('template/css-link'); ?>
 <!-- Morris charts -->
  <link rel="stylesheet" href="<? echo base_url() ?>assets/plugins/morris/morris.css">
  
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php
	$data['menu']=array('FID'  => $FID ) ;
	// get data chart
	$bantu=explode("/",$isigrafik);
	 $ykey=$bantu[0];
	 $data_grafik=$bantu[1];
	 $ylabel=$bantu[2];
	 
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
    <section class="content">
      
      <div class="row">
        
        <div class="col-md-12">
          
          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
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
 <script src="<? echo base_url() ?>assets/plugins/raphael210/raphael-min.js"></script>
<script src="<? echo base_url() ?>assets/plugins/morris/morris.min.js"></script>
<!-- page script -->
 
<script>
  $(function () {

    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [ 
        <?    echo $data_grafik  ;  ?>   
      /*  {y: '2007', a: 75, b: 65,  c: 25,  d: 81,  e: 78 },
         {y: '2008', a: 23, b: 77,  c: 56,  d: 56,  e: 48},
        {y: '2009', a: 75, b: 65},
        {y: '2010', a: 50, b: 40},
        {y: '2011', a: 75, b: 65},
        {y: '2012', a: 100, b: 90} */
      ],
     barColors: ['Darkgreen', 'Darkseagreen','Darkturquoise','Darkmagenta','Darkorange','Darkred','Darkorchid','Darkkhaki','Darkolivegreen','Darkturquoise'],
      xkey: 'y',
      ykeys: [<? echo $ykey ?>],
      labels: [<? echo $ylabel ?>],
      hideHover: 'auto'
    });
  });
  
  // color
  // #f56954
  
</script>
</body>
</html>
