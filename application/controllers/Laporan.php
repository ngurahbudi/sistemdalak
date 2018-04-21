<?
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
								'FID'		=>	'4'
        						 );
	  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				 
				$data['row_cbokategory']=$this->mycombo->LoadCombo("tb_kategory");  
				$data['row_cboaktif']=$this->mycombo->LoadCombo("tb_status_aktif"); 
				$data['row_cboklasmasalah']=$this->mycombo->LoadCombo("tb_klasifikasi_masalah");  
				$data['row_filter']= array( 'klasmasalah_id' 	=> 'all', 
											     'kategory_id' 			=> 'all',
												 'aktif_id' 			=> 'all' 
										       );
				$data['custom_column']= $this->M_laporan->SelectCustomColumn(); 
				$data['alldata']= $this->M_laporan->SelectAllData();
				$this->load->view('laporan/v_lapperusahaan',$data);  
				
			}else
			{
				redirect (base_url()) ;
			} 	
		}
		
		public function search() 
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			$data['row_cbokategory']=$this->mycombo->LoadCombo("tb_kategory");  
			$data['row_cboaktif']=$this->mycombo->LoadCombo("tb_status_aktif"); 
			$data['row_cboklasmasalah']=$this->mycombo->LoadCombo("tb_klasifikasi_masalah");  
			$data['custom_column']= $this->M_laporan->SelectCustomColumn();
 			$where="";
			$status_filter="";
			if($this->input->post('cboklasmasalah')<>"all" and $this->input->post('cboklasmasalah')<>"")
			{
				$where .=" AND klasmasalah ='". $this->input->post('cboklasmasalah') ."'";
				$status_filter .="Klasifikasi Masalah : ".$this->input->post('cboklasmasalah');
			}
			if($this->input->post('cbokategory')<>"all" and $this->input->post('cbokategory')<>"")
			{
				$where .=" AND kategory ='". $this->input->post('cbokategory') ."'";
				$status_filter .=" Kategory : ".$this->input->post('cbokategory');
			}
			if($this->input->post('cboaktif')<>"all" and $this->input->post('cboaktif')<>"")
			{
				$where .=" AND statusaktif='". $this->input->post('cboaktif') ."'";
				$status_filter .=" Status Aktif : ". $this->input->post('cboaktif');
			}

			$data['row_filter']= array( 'klasmasalah_id' 	=> $this->input->post('cboklasmasalah') , 
										'kategory_id' 		=> $this->input->post('cbokategory') ,
										'aktif_id' 			=> $this->input->post('cboaktif') 
									   );
			if($this->input->post('cmdFilter') )
			{
				//$data['alldata']= $this->M_laporan->SelectAllData($where);
				$this->M_laporan->export($this->M_laporan->SelectAllData($where),$status_filter);
				$this->load->view('laporan/v_lapperusahaan',$data);  	
			} 
			if($this->input->post('cmdFilter2') )
			{ 
				$this->M_laporan->export_custom($where,$status_filter);
			 	$this->load->view('laporan/v_lapperusahaan',$data);  
			}
    	}
 
	
	}

?>