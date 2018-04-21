<?
	class Lappembinaan extends CI_Controller
	{
		public $title;	// class variabel for variabel global
		
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_lappembinaan');
				 
				$this->title = array(
            	 				'menu' 		=> 'Laporan',
            	 				'submenu' 	=> 'Data Pembinaan', 
								'linkadd' 	=> 'perusahaan/add',
								'linklist' 	=> 'perusahaan',
								'FID'		=>	'2'
        						 );
	  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				 
				$data['row_cbokategory']=$this->mycombo->LoadCombo("tb_kategory");  
				//$data['row_cboaktif']=$this->mycombo->LoadCombo("tb_status_aktif"); 
				$data['row_cboklasmasalah']=$this->mycombo->LoadCombo("tb_klasifikasi_masalah");  
				$data['row_filter']= array( 'klasmasalah_id' 	=> 'all', 
											'kategory_id' 		=> 'all',
											'tglturun' 			=> date('d-m-Y'),
											'tglturun2' 		=> date('d-m-Y') 	 
										    );
				//$data['custom_column']= $this->M_lappembinaan->SelectCustomColumn(); 
				//$data['alldata']= $this->M_lappembinaan->SelectAllData();
				$this->load->view('Lappembinaan/v_lappembinaan',$data);  
				
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
			//$data['row_cboaktif']=$this->mycombo->LoadCombo("tb_status_aktif"); 
			$data['row_cboklasmasalah']=$this->mycombo->LoadCombo("tb_klasifikasi_masalah");  
			//$data['custom_column']= $this->M_lappembinaan->SelectCustomColumn();
 			$where="";
			$status_filter="";
			$where .=" and h.jadwal_tgl >= '". $this->mycombo->FormatYMD($this->input->post('txttglturun')) ."' and h.jadwal_tgl <= '" . $this->mycombo->FormatYMD($this->input->post('txttglturun2')) . "'";
			$status_filter .=" Dari tanggal ". $this->input->post('txttglturun') ." sampai dengan " . $this->input->post('txttglturun2');
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
 			
			$data['row_filter']= array( 'klasmasalah_id' 	=> $this->input->post('cboklasmasalah') , 
										'kategory_id' 		=> $this->input->post('cbokategory'),
										'tglturun' 			=> date('d-m-Y'),
										'tglturun2' 		=> date('d-m-Y') 	   
									 );
			if($this->input->post('cmdFilter') )
			{
				//$data['alldata']= $this->M_lappembinaan->SelectAllData($where);
				 
				$this->M_lappembinaan->export($this->M_lappembinaan->SelectAllData($where),$status_filter);
				$this->load->view('Lappembinaan/v_lappembinaan',$data);  	
			} 
			if($this->input->post('cmdFilter2') )
			{ 
				$this->M_lappembinaan->export_custom($where,$status_filter);
			 	$this->load->view('Lappembinaan/v_lappembinaan',$data);  
			}
    	}
 
	
	}

?>