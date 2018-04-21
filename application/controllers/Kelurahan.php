<?
	class Kelurahan extends CI_Controller
	{
		public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_kelurahan');
				 
				$this->title = array(
            	 				'menu' 		=> 'Master Data',
            	 				'submenu' 	=> 'Data Kelurahan', 
								'linkadd' 	=> 'kelurahan/add',
								'linklist' 	=> 'kelurahan',
								'FID'		=>	'F' 
        						 );
        		// $this->data can be accessed from anywhere in the controller.
				  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_kelurahan->SelectAllData();
				
				$this->load->view('kelurahan/v_listkelurahan',$data);  
				
			}else
			{
				redirect (base_url()) ;
			} 	
		}
		
		public function add() 
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			$data['row_cbokecamatan']=$this->mycombo->LoadCombo("tb_kecamatan"); 
			if ($this->input->post('cmdSimpan'))  {
            	$result =$this->M_kelurahan->Simpan();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('kelurahan/add');
        	} else {
            	$this->load->view('kelurahan/v_addkelurahan',$data);
        	}
    	}
		
		function edit()
		{
        	$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			$data['row_cbokecamatan']=$this->mycombo->LoadCombo("tb_kecamatan"); 
			if ($this->input->post('cmdUpdate'))  {
            	$result=$this->M_kelurahan->Update();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('kelurahan');
        	}else{
            	$id      = $this->uri->segment(3);
            	$data['rowedit'] = $this->M_kelurahan->SelectByID($id);
            	$this->load->view('kelurahan/v_editkelurahan',$data);
        	}
    	}
    
    	function delete()
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
        	$id = $this->uri->segment(3);
        	if(!empty($id)){
           	 	// proses delete data
            	$result=$this->M_kelurahan->Delete($id);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'hapus');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
        	}
        	redirect('kelurahan');
   	 	}

	
	}

?>