<?
	class Kategory extends CI_Controller
	{
		public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_kategory');
				$this->title = array(
            	 				'menu' 		=> 'Master Data',
            	 				'submenu' 	=> 'Klasifikasi Masalah', 
								'linkadd' 	=> 'kategory/add',
								'linklist' 	=> 'kategory' ,
								'FID'		=>	'D'
        						 );
        		// $this->data can be accessed from anywhere in the controller.
				  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_kategory->SelectAllData();
				$this->load->view('kategory/v_listkategory',$data);  
				
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
            	$result =$this->M_kategory->Simpan();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('kategory/add');
        	} else {
            	$this->load->view('kategory/v_addkategory',$data);
        	}
    	}
		
		function edit()
		{
        	$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			if ($this->input->post('cmdUpdate'))  {
            	$result=$this->M_kategory->Update();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('kategory');
        	}else{
            	$id      = $this->uri->segment(3);
            	$data['rowedit'] = $this->M_kategory->SelectByID($id);
            	$this->load->view('kategory/v_editkategory',$data);
        	}
    	}
    
    	function delete()
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
        	$id = $this->uri->segment(3);
        	if(!empty($id)){
           	 	// proses delete data
            	$result=$this->M_kategory->Delete($id);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'hapus');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
        	}
        	redirect('kategory');
   	 	}

	
	}

?>