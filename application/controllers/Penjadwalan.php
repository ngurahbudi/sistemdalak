<?
	class Penjadwalan extends CI_Controller
	{
		public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_penjadwalan');
				 
				$this->title = array(
            	 				'menu' 		=> 'Penjadwalan',
            	 				'submenu' 	=> 'Kegiatan Penjadwalan', 
								'linkadd' 	=> 'penjadwalan/add',
								'linklist' 	=> 'penjadwalan',
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
					$where=" AND jadwal_tgl >='". $filtertgl ."' and jadwal_tgl <='". $filtertgl2 ."' ";
					if($this->input->post('cbokegiatan')<> "all" )
					{
					  	$where .=  " and jenismonitoring_id='". $this->input->post('cbokegiatan') ."' ";
					}
					$data['row_filter']= array( 'jenismonitoring_id' 	=> $this->input->post('cbokegiatan')  
											   );
					$filterdata = array(  
						'tgljadwal1' 				=> $filtertgl ,
						'tgljadwal2' 				=> $filtertgl2 
				   	);
					$this->session->set_userdata($filterdata);
				}else
				{
					 
					$data['row_filter']= array( 'jenismonitoring_id' 	=> 'all', 
											     
										       );
					// jika belum ada session maka buat session baru
					if(!$this->session->has_userdata('tgljadwal1') )
					{
						$where=" AND jadwal_tgl='". date('Y-m-d') . "' ";
						$filterdata =array(  
											     'tgljadwal1' 			=> date('Y-m-d'),
												 'tgljadwal2' 			=> date('Y-m-d') 
										       );
						$this->session->set_userdata($filterdata);
					}else
					{
						$where=" AND jadwal_tgl >='". $this->session->tgljadwal1 ."' and jadwal_tgl <='". $this->session->tgljadwal2 ."' ";
					}							   
											   
				}
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_penjadwalan->SelectAllData($where);
				$data['row_cbokegiatan']=$this->mycombo->LoadCombo("tb_jenis_monitoring" ); 							
				$this->load->view('penjadwalan/v_listpenjadwalan',$data);  
				
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
			$data['row_cbokegiatan']=$this->mycombo->LoadCombo("tb_jenis_monitoring" ); 
			if ($this->input->post('cmdSimpan'))  {
            	$result =$this->M_penjadwalan->Simpan();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('penjadwalan/add');
        	} else {
            	$this->load->view('penjadwalan/v_addpenjadwalan',$data);
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
			$data['row_cbokegiatan']=$this->mycombo->LoadCombo("tb_jenis_monitoring" ); 
			if ($this->input->post('cmdUpdate'))  {
            	$result=$this->M_penjadwalan->Update();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('penjadwalan');
        	}else{
            	$id      = $this->uri->segment(3);
            	$data['rowedit'] = $this->M_penjadwalan->SelectByID($id);
            	$this->load->view('penjadwalan/v_editpenjadwalan',$data);
        	}
    	}
    
    	function delete()
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
        	$id = $this->uri->segment(3);
        	if(!empty($id)){
           	 	// proses delete data
            	$result=$this->M_penjadwalan->Delete($id);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'hapus');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
        	}
        	redirect('penjadwalan');
   	 	}

	
	}

?>