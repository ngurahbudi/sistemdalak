 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<? //echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->
      <!-- search form  
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search..." />
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <link href="../../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
       <?
	   		//*** KETERANGAN
			/*	// master data
				FID=A	=> menu dashboard
				FID=B	=> menu master data perusahaan
				FID=C	=> menu master data jalan
					D	=> menu master data kategory
					E	=> menu master data kecamatan
					F	=> menu master data kelurahan
					G	=> menu master data user
					H	=> menu master data group user
					 
				//=== kegiatan
					N	=> menu kegiatan penjadwalan
					O	=> pemantauan
					P	=> pembinaan
					Q	=> pengawasan
					R	=> melengkapi berkas
					S 	=> kirim email
					
				//===pelaporan
					1	=> laporan Pemantauan
					2	=> laporan Pembinaan
					3 	=> laporan pengawasan
					4	=> perusahaan 
					5	=> Daftar Jatuh tempo pembinaan
					6	=> Grafik perusahaan 
					7	=> daftar jadwal 
			
			*/
			//***
	   		// if(preg_match("/$menu[FID]/","ABCDEFGHIJKM")){echo "ketemu"; }
	   
	   ?>
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li>
        <li class="treeview <? if(preg_match("/$menu[FID]/","A")){echo "active"; }  ?>">
          <a href="<? echo base_url(); ?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

          </a>
        </li>
        <li class="treeview <? if(preg_match("/$menu[FID]/","BCDEFGHIJKM")){echo "active"; }  ?>">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          	<li class="<?  if(preg_match("/$menu[FID]/","B")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>perusahaan"><i class="fa fa-industry"></i> Data Perusahaan</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","C")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>jalan"><i class="fa fa-road"></i> Data Jalan Denpasar</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","D")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>kategory"><i class="fa fa-suitcase"></i> Kategory Masalah</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","E")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>kecamatan"><i class="fa fa-clipboard"></i> Data Kecamatan</a></li>
         	<li class="<?  if(preg_match("/$menu[FID]/","F")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>kelurahan"><i class="fa fa-bookmark"></i> Data Kelurahan</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","G")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>user"><i class="fa fa-user"></i> User/Pengguna </a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","H")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>groupuser"><i class="fa fa-bookmark"></i> Group User</a></li>
          </ul>
        </li>
        <li class="treeview <? if(preg_match("/$menu[FID]/","NOPQRS")){echo "active"; }  ?>">
          <a href="#">
            <i class="fa fa-edit"></i>
            <span>Kegiatan</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          	<li class="<?  if(preg_match("/$menu[FID]/","N")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>penjadwalan"><i class="fa fa-car"></i> Penjadwalan</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","O")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>pemantauan"><i class="fa fa-eye"></i> Pemantauan</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","P")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>pembinaan"><i class="fa fa-binoculars"></i> Pembinaan</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","Q")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>pengawasan"><i class="fa fa-medkit"></i> Pengawasan</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","R")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>melengkapi"><i class="fa fa-reply-all"></i> Melengkapi Berkas</a></li> 
            <li class="<?  if(preg_match("/$menu[FID]/","S")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>email"><i class="fa fa-send-o"></i> Kirim Email Perusahaan</a></li>
          </ul>
        </li>
  		<li class="treeview <? if(preg_match("/$menu[FID]/","1234567890")){echo "active"; }  ?>">
          <a href="#">
            <i class="fa fa-area-chart"></i>
            <span>Laporan</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?  if(preg_match("/$menu[FID]/","7")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>lapjadwal"><i class="fa fa-calendar-minus-o"></i> Lap. Penjadwalan</a></li> 
            <li class="<?  if(preg_match("/$menu[FID]/","1")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>lappemantauan"><i class="fa fa-line-chart"></i> Lap. Pemantauan</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","2")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>lappembinaan"><i class="fa fa-area-chart"></i> Lap. Pembinaan</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","3")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>lappengawasan"><i class="fa fa-circle-o"></i> Lap. Pengawasan</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","4")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>laporan"><i class="fa fa-institution"></i> Lap. Perusahaan</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","5")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>laptenggangwaktu"><i class="fa fa-hourglass-half"></i> Daftar Prs. Tenggang waktu</a></li>
            <li class="<?  if(preg_match("/$menu[FID]/","6")){echo "active"; }  ?>">
            <a href="<? echo base_url(); ?>grafik"><i class="fa fa-bar-chart-o"></i> Grafik. Perusahaan</a></li> 
          </ul>
        </li>
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>