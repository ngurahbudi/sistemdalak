<?
	class Email extends CI_Controller
	{
		public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_email');
				$this->title = array(
            	 				'menu' 		=> 'Kegiatan',
            	 				'submenu' 	=> 'Kirim Email', 
								'linkadd' 	=> 'email/add',
								'linklist' 	=> 'email', 
								'FID'		=>	'S'
        						 );
        		// $this->data can be accessed from anywhere in the controller.
				  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_email->SelectAllData();
				$data['row_template']=$this->M_email->SelectAllTemplate();
				$this->load->view('email/v_listemail',$data);  
				
			}else
			{
				redirect (base_url()) ;
			} 	
		}
		
		
	 	
		public function compose() 
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
 			$data['row_sentto']=$this->M_email->SelectKategory();
			$data['row_template']=$this->M_email->SelectAllTemplate();
			
			if($this->input->post('cbotemplate'))
			{
				$data['row_isitemplate']= $this->M_email->SelectTemplateByID($this->input->post('cbotemplate')) ;
			}else
			{  
				$data['row_isitemplate']= array(
					'template_id'		=>	'',
					'template_nama'		=>	'',
					'template_content'	=>	''
				
				);
			}
			if ($this->input->post('cmdSend'))  {
				
            	$result =$this->M_email->SendMail();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('email/compose');
        	} else {
            	$this->load->view('email/v_compose',$data);
        	}
    	}
		
		public function add() 
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
 
			if ($this->input->post('cmdSimpan'))  {
            	$result =$this->M_email->Simpan();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('email/add');
        	} else {
            	$this->load->view('email/v_addemail',$data);
        	}
    	}
		public function addtemplate() 
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
 
			if ($this->input->post('cmdSimpan'))  {
				
            	$result =$this->M_email->SimpanTemplate();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('email/addtemplate');
        	} else {
            	$this->load->view('email/v_addtemplate',$data);
        	}
    	}
		
		function edittemplate()
		{
        	$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			if ($this->input->post('cmdUpdate')) {
            	$result=$this->M_email->UpdateTemplate();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('email/edittemplate');
        	}else{
            	$id      = $this->uri->segment(3);
            	$data['rowtemplate'] = $this->M_email->SelectTemplateByID($id);
            	$this->load->view('email/v_edittemplate',$data);
        	}
    	}
		
		
		function edit()
		{
        	$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			if ($this->input->post('cmdUpdate')) {
            	$result=$this->M_email->Update();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('email');
        	}else{
            	$id      = $this->uri->segment(3);
            	$data['rowedit'] = $this->M_email->SelectByID($id);
            	$this->load->view('email/v_editemail',$data);
        	}
    	}
    
    	function deletetemplate()
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
        	$id = $this->uri->segment(3);
        	if(!empty($id)){
           	 	// proses delete data
            	$result=$this->M_email->DeleteTemplate($id);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'hapus');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
        	}
        	redirect('email/edittemplate');
   	 	}

	
	}

?>