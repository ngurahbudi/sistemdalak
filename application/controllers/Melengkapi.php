<?
	class Melengkapi extends CI_Controller
	{
		public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_melengkapi');
				 
				$this->title = array(
            	 				'menu' 		=> 'Melengkapi',
            	 				'submenu' 	=> 'Melengkapi Berkas', 
								'linkadd' 	=> 'melengkapi/add',
								'linklist' 	=> 'melengkapi',
								'FID'		=>	'N' 
        						 );	  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
 
				$data=$this->title;
				
				if($this->input->post('cmdFilter') )
				{
					$filtertgl= $this->mycombo->FormatYMD($this->input->post('txttglturun'));
					$filtertgl2= $this->mycombo->FormatYMD($this->input->post('txttglturun2'));
					$where=" AND melengkapi_tgl >='". $filtertgl ."' and melengkapi_tgl <='". $filtertgl2 ."' ";
					 
					$filterdata = array(  
						'tglml1' 				=> $filtertgl ,
						'tglml2' 				=> $filtertgl2 
				   );
					$this->session->set_userdata($filterdata);
				}else
				{
					// jika belum ada session maka buat session baru
					if(!$this->session->has_userdata('tglml1') )
					{
						$where=" AND melengkapi_tgl='". date('Y-m-d') . "' ";
						$filterdata =array(  
											     'tglml1' 			=> date('Y-m-d'),
												 'tglml2' 			=> date('Y-m-d') 
										       );
						$this->session->set_userdata($filterdata);
					}else
					{
						$where=" AND melengkapi_tgl >='". $this->session->tglml1 ."' and melengkapi_tgl <='". $this->session->tglml2 ."' ";
					}
				}
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_melengkapi->SelectAllData($where);
				 							
				$this->load->view('melengkapi/v_listmelengkapi',$data);  
				
			}else
			{
				redirect (base_url()) ;
			} 	
		}
		
		public function add() 
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			$qry="tb_perusahaan a inner join tb_jalan b on a.jalan_id=b.jalan_id 
				  inner join tb_kelurahan c on a.kelurahan_id=c.kelurahan_id 
			      inner join tb_kecamatan d on c.kecamatan_id=d.kecamatan_id ";
			$data['row_cboperusahaan']=$this->mycombo->LoadCombo($qry ," and aktif_id='1' "); 
			$data['row_txtcatatan']=$this->mycombo->LoadCombo("tb_jenis_monitoring" ); 
			if ($this->input->post('cmdSimpan'))  {
            	$result =$this->M_melengkapi->Simpan();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('melengkapi/add');
        	}elseif ($this->input->post('cmdPerusahaan'))  
			{
				redirect('perusahaan/edit/'.$this->input->post('cboperusahaan'));
			}else {
            	$this->load->view('melengkapi/v_addmelengkapi',$data);
        	}
    	}
		
		function edit()
		{
        	$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			$qry="tb_perusahaan a inner join tb_jalan b on a.jalan_id=b.jalan_id 
				  inner join tb_kelurahan c on a.kelurahan_id=c.kelurahan_id 
			      inner join tb_kecamatan d on c.kecamatan_id=d.kecamatan_id ";
			$data['row_cboperusahaan']=$this->mycombo->LoadCombo($qry ," and aktif_id='1' "); 
			$data['row_txtcatatan']=$this->mycombo->LoadCombo("tb_jenis_monitoring" ); 
			if ($this->input->post('cmdUpdate'))  {
            	$result=$this->M_melengkapi->Update();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('melengkapi');
			}elseif ($this->input->post('cmdPerusahaan'))  
			{
				redirect('perusahaan/edit/'.$this->input->post('cboperusahaan'));
        	}else{
            	$id      = $this->uri->segment(3);
            	$data['rowedit'] = $this->M_melengkapi->SelectByID($id);
            	$this->load->view('melengkapi/v_editmelengkapi',$data);
        	}
    	}
    
    	function delete()
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
        	$id = $this->uri->segment(3);
        	if(!empty($id)){
           	 	// proses delete data
            	$result=$this->M_melengkapi->Delete($id);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'hapus');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
        	}
        	redirect('melengkapi');
   	 	}

	
	}

?>