<?php
	class Kategory extends CI_Controller
	{
		var $title;	// class variabel for variabel global
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('m_kategory');
				$this->title = array(
            	 'judul_tabel' => 'Klasifikasi Masalah',
            	 'sub_judul' => 'Klasifikasi Masalah' 
            
        	 );
        	// $this->data can be accessed from anywhere in the controller.
    	}    
		 
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	//$data=$this->title;
				//$data['status']="";	// untuk pesan error atau sukses
				//$data['rowdata']= $this->m_kategory->GetListData();
				//$this->load->view('kategory/v_kategory',$data);  
				redirect ('kategory/home');
			}else
			{
				redirect (base_url()) ;
			} 	
		}
		public function Home($status="")
		{
			// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	
				$data=$this->title;
				$data['status']=$status;	// untuk pesan error atau sukses
				$data['rowdata']= $this->m_kategory->GetListData();
				$data['loadupdate']="";
				$this->load->view('kategory/v_kategory',$data);  
				
				
			}else
			{
				redirect (base_url()) ;
			} 	
		
		}
		public function AddUpdate()
		{
			$data=$this->title; 
			$aksi=$this->uri->segment(3);
			$idnya=$this->uri->segment(4);
			if (isset($_POST['txtKlasifikasi']) && $_POST['txtKlasifikasi']<> "") {
				if ($aksi==='edit' && $id <> "") 
				{
					$status=$this->m_kategory->Update($id); 	
					redirect (base_url().'kategory/home/'.$status) ;
				}else
				{
            		$id=$this->m_kategory->CreateNewID('KM','2');
					$status=$this->m_kategory->Simpan($id); 	
					redirect (base_url().'kategory/home/'.$status) ;
				}
			}else
			{
				$this->load->view('kategory/v_kategory',$data); 
			} 
			 
		}
		public function Edit($id)
		{
			$data=$this->title; 
			
				//$id       = $this->uri->segment(3);
				$data['loadupdate'] = $this->m_kategory->LoadDataUpdate($id);
				$data['status']="";   
				$data['rowdata']=array(); 
				$this->load->view('kategory/v_kategory',$data); 
			 
			 
		}			
					
		//CONTOH			
	   function addxxx() {
			if (isset($_POST['submit'])) {
				$this->Model_guru->save();
				redirect('guru');
			} else {
				$this->template->load('template', 'guru/add');
			}
		}
		
		function editxxx(){
			if(isset($_POST['submit'])){
				$this->Model_guru->update();
				redirect('guru');
			}else{
				$id_guru      = $this->uri->segment(3);
				$data['guru'] = $this->db->get_where('tbl_guru',array('id_guru'=>$id_guru))->row_array();
				$this->template->load('template', 'guru/edit',$data);
			}
		}
		
		 

	}




?>