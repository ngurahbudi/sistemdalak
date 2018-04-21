<?
	class Kecamatan extends CI_Controller
	{
		public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_kecamatan');
				$this->title = array(
            	 				'menu' 		=> 'Master Data',
            	 				'submenu' 	=> 'Kecamatan', 
								'linkadd' 	=> 'kecamatan/add',
								'linklist' 	=> 'kecamatan', 
								'FID'		=>	'E'
        						 );
        		// $this->data can be accessed from anywhere in the controller.
				  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_kecamatan->SelectAllData();
				$this->load->view('kecamatan/v_listkecamatan',$data);  
				
			}else
			{
				redirect (base_url()) ;
			} 	
		}
		
		public function add() 
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
 
			if ($this->input->post('cmdSimpan'))  {
            	$result =$this->M_kecamatan->Simpan();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('kecamatan/add');
        	} else {
            	$this->load->view('kecamatan/v_addkecamatan',$data);
        	}
    	}
		
		function edit()
		{
        	$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			if ($this->input->post('cmdUpdate')) {
            	$result=$this->M_kecamatan->Update();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('kecamatan');
        	}else{
            	$id      = $this->uri->segment(3);
            	$data['rowedit'] = $this->M_kecamatan->SelectByID($id);
            	$this->load->view('kecamatan/v_editkecamatan',$data);
        	}
    	}
    
    	function delete()
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
        	$id = $this->uri->segment(3);
        	if(!empty($id)){
           	 	// proses delete data
            	$result=$this->M_kecamatan->Delete($id);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'hapus');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
        	}
        	redirect('kecamatan');
   	 	}

	
	}

?>