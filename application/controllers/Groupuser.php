<?
	class Groupuser extends CI_Controller
	{
		public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_groupuser');
				$this->title = array(
            	 				'menu' 		=> 'Master Data',
            	 				'submenu' 	=> 'Data Group User', 
								'linkadd' 	=> 'groupuser/add',
								'linklist' 	=> 'groupuser',
								'FID'		=>	'H' 
        						 );
        		// $this->data can be accessed from anywhere in the controller.
				  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_groupuser->SelectAllData();
				$this->load->view('groupuser/v_listgroupuser',$data);  
				
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
            	$result =$this->M_groupuser->Simpan();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('groupuser/add');
        	} else {
            	$this->load->view('groupuser/v_addgroupuser',$data);
        	}
    	}
		
		function edit()
		{
        	$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			if ($this->input->post('cmdUpdate'))  {
            	$result=$this->M_groupuser->Update();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('groupuser');
        	}else{
            	$id      = $this->uri->segment(3);
            	$data['rowedit'] = $this->M_groupuser->SelectByID($id);
            	$this->load->view('groupuser/v_editgroupuser',$data);
        	}
    	}
    
    	function delete()
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
        	$id = $this->uri->segment(3);
        	if(!empty($id)){
           	 	// proses delete data
            	$result=$this->M_groupuser->Delete($id);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'hapus');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
        	}
        	redirect('groupuser');
   	 	}

	
	}

?>