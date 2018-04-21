<?
	class Grafik extends CI_Controller
	{
		
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_grafik');
				$this->title = array(
            	 				'menu' 		=> 'Laporan',
            	 				'submenu' 	=> 'Grafik Permasalahan', 
								'linkadd' 	=> 'jalan/add',
								'linklist' 	=> 'jalan',
								'FID'		=>	'6' 
        						 );
        		// $this->data can be accessed from anywhere in the controller.
				  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				//$data['alldata']= $this->M_jalan->SelectAllData();
				$data['isigrafik'] = $this->M_grafik->getDataGrafik();
				$this->load->view('grafik/v_grafik',$data);  
				
			}else
			{
				redirect (base_url()) ;
			} 	
		}
	
	
	
	}
?>