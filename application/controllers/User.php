<?
	class User extends CI_Controller
	{
		public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_user');
				 
				$this->title = array(
            	 				'menu' 		=> 'Master Data',
            	 				'submenu' 	=> 'Data User/Pengguna', 
								'linkadd' 	=> 'user/add',
								'linklist' 	=> 'user', 
								'FID'		=>	'G'
        						 );
        		// $this->data can be accessed from anywhere in the controller.
				  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_user->SelectAllData();
				
				$this->load->view('user/v_listuser',$data);  
				
			}else
			{
				redirect (base_url()) ;
			} 	
		}
		
		public function add() 
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			$data['row_cbogroup']=$this->mycombo->LoadCombo("tb_groupuser"); 
			if ($this->input->post('cmdSimpan'))  {
            	$result =$this->M_user->Simpan();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('user/add');
        	} else {
            	$this->load->view('user/v_adduser',$data);
        	}
    	}
		
		function edit()
		{
        	$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			$data['row_cbogroup']=$this->mycombo->LoadCombo("tb_groupuser"); 
			if ($this->input->post('cmdUpdate'))  {
            	$result=$this->M_user->Update();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('user');
        	}else{
            	$id      = $this->uri->segment(3);
            	$data['rowedit'] = $this->M_user->SelectByID($id);
            	$this->load->view('user/v_edituser',$data);
        	}
    	}
    
    	function delete()
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
        	$id = $this->uri->segment(3);
        	if(!empty($id)){
           	 	// proses delete data
            	$result=$this->M_user->Delete($id);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'hapus');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
        	}
        	redirect('user');
   	 	}

	
	}

?>