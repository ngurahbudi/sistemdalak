<?php
	class Laporan extends CI_Controller
	{
	
	    public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_laporan');
				 
				$this->title = array(
            	 				'menu' 		=> 'Laporan',
            	 				'submenu' 	=> 'Data Perusahaan', 
								'linkadd' 	=> 'perusahaan/add',
								'linklist' 	=> 'perusahaan',
								'FID'		=>	'1'
        						 );
	  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_laporan->SelectAllData();
				
				$this->load->view('laporan/v_lapperusahaan',$data);  
				
			}else
			{  die('ss');
				redirect (base_url()) ;
			} 	
		}
 	 
	}




?>