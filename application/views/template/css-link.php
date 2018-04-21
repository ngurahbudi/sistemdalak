 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="shortcut icon" type="image/x-icon" href="<? echo base_url() ?>favicon.ico">
  <title><? echo PROJNAME ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <!-- Bootstrap 3.3.6 -->
   <style>
 @font-face {
  font-family: 'Glyphicons Halflings';
  src: url('<? echo base_url() ?>assets/bootstrap/fonts/glyphicons-halflings-regular.eot');
  src: url('<? echo base_url() ?>assets/bootstrap/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url('<? echo base_url() ?>assets/bootstrap/fonts/glyphicons-halflings-regular.woff2') format('woff2'), url('<? echo base_url() ?>assets/bootstrap/fonts/glyphicons-halflings-regular.woff') format('woff'), url('<? echo base_url() ?>assets/bootstrap/fonts/glyphicons-halflings-regular.ttf') format('truetype'), url('<? echo base_url() ?>assets/bootstrap/fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular') format('svg');
};
</style>
  <link rel="stylesheet" href="<? echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<? echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" />
  <!-- Font Awesome -->
   <style>
      @font-face{font-family:'FontAwesome';src:url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.eot?v=4.5.0');src:url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.eot?#iefix&v=4.5.0') format('embedded-opentype'),url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.woff2?v=4.5.0') format('woff2'),url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.woff?v=4.5.0') format('woff'),url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.ttf?v=4.5.0') format('truetype'),url('<? echo base_url() ?>assets/font-awesome/4.5.0/fonts/fontawesome-webfont.svg?v=4.5.0#fontawesomeregular') format('svg');font-weight:normal;font-style:normal};
 </style>
  <link rel="stylesheet" href="<? echo base_url() ?>assets/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <style>
@font-face{font-family:"Ionicons";src:url("<? echo base_url() ?>assets/plugins/ionicon/fonts/ionicons.eot?v=2.0.0");src:url("<? echo base_url() ?>assets/plugins/ionicon/fonts/ionicons.eot?v=2.0.0#iefix") format("embedded-opentype"),url("<? echo base_url() ?>assets/plugins/ionicon/fonts/ionicons.ttf?v=2.0.0") format("truetype"),url("<? echo base_url() ?>assets/plugins/ionicon/fonts/ionicons.woff?v=2.0.0") format("woff"),url("<? echo base_url() ?>assets/plugins/ionicon/fonts/ionicons.svg?v=2.0.0#Ionicons") format("svg");font-weight:normal;font-style:normal}
</style>
  <link rel="stylesheet" href="<? echo base_url() ?>assets/plugins/ionicon/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<? echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<? echo base_url() ?>assets/dist/css/select2.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
       
   <link rel="stylesheet" href="<?  echo base_url() ?>assets/dist/css/skins/_all-skins.min.css"> 
  <!-- iCheck -->
  <link rel="stylesheet" href="<? echo base_url() ?>assets/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="<? echo base_url() ?>assets/plugins/iCheck/all.css">
  <!-- Morris chart  
  <link rel="stylesheet" href="<? //echo base_url() ?>assets/plugins/morris/morris.css">-->
  <!-- jvectormap  
  <link rel="stylesheet" href="<? // echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">-->
  <!-- Date Picker  -->
  <link rel="stylesheet" href="<?  echo base_url() ?>assets/plugins/datepicker/datepicker3.css">
  <!-- Date Picker  
   		<link rel="stylesheet" href="../vendor/assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="../vendor/assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="../vendor/assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="../vendor/assets/css/bootstrap-datetimepicker.min.css" /> -->
  
  <!-- Daterange picker  -->
  <link rel="stylesheet" href="<?  echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">

  
  <!-- bootstrap wysihtml5 - text editor 
  <link rel="stylesheet" href="<? //echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
-->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
 
<style>
/* adminLTE.css  */
.layout-boxed {
  background: url('<? echo base_url() ?>assets/dist/img/boxed-bg.jpg') repeat fixed;
}
/* Data tabel.css  */

  </style>
  
</head>  