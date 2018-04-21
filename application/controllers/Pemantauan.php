<?
	class Pemantauan extends CI_Controller
	{
		public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_pemantauan');
				 
				$this->title = array(
            	 				'menu' 		=> 'Pemantauan',
            	 				'submenu' 	=> 'Kegiatan Pemantauan', 
								'linkadd' 	=> 'pemantauan/add',
								'linklist' 	=> 'pemantauan',
								'FID'		=>	'O' 
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
				 
				   $filterdata = array(  
						'tglturun' 				=> $filtertgl ,
						'tglturun2' 			=> $filtertgl2 
				   );
					$this->session->set_userdata($filterdata);
				}else
				{
 
					// jika belum ada session maka buat session baru
					 
					if(!$this->session->has_userdata('tglturun') )
					{
						$where=" AND jadwal_tgl='". date('Y-m-d') . "' ";
						$filterdata =array(  
											     'tglturun' 			=> date('Y-m-d'),
												 'tglturun2' 			=> date('Y-m-d') 
										       );
						$this->session->set_userdata($filterdata);
					}else
					{
						$where=" AND jadwal_tgl >='". $this->session->tglturun ."' and jadwal_tgl <='". $this->session->tglturun2 ."' ";
					}
				}
				 
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_pemantauan->SelectAllData($where);
				$data['row_cbokegiatan']=$this->mycombo->LoadCombo("tb_jenis_monitoring" ); 							
				$this->load->view('pemantauan/v_listpemantauan',$data);  
				
			}else
			{
				redirect (base_url()) ;
			} 	
		}
		
	/* 	public function add() 
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			$qry="tb_perusahaan a inner join tb_jalan b on a.jalan_id=b.jalan_id 
				  inner join tb_kelurahan c on a.kelurahan_id=c.kelurahan_id 
			      inner join tb_kecamatan d on c.kecamatan_id=d.kecamatan_id ";
			$data['row_cboperusahaan']=$this->mycombo->LoadCombo($qry ," and aktif_id='1' "); 
			$data['row_cbokegiatan']=$this->mycombo->LoadCombo("tb_jenis_monitoring" ); 
			if ($this->input->post('cmdSimpan'))  {
            	$result =$this->M_pemantauan->Simpan();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('pemantauan/add');
        	} else {
            	$this->load->view('pemantauan/v_addpemantauan',$data);
        	}
    	} */
		
		function edit()
		{
        	$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			$qry="tb_perusahaan a inner join tb_jalan b on a.jalan_id=b.jalan_id 
				  inner join tb_kelurahan c on a.kelurahan_id=c.kelurahan_id 
			      inner join tb_kecamatan d on c.kecamatan_id=d.kecamatan_id ";
			$data['row_cbokategory']=$this->mycombo->LoadCombo("tb_kategory"); 
			$data['row_cboklasmasalah']=$this->mycombo->LoadCombo("tb_klasifikasi_masalah" ); 
			if ($this->input->post('cmdUpdate'))  {
				switch($this->input->post('txtIDmonit'))
				{
					case ""		:
					case "new"	: $result=$this->M_pemantauan->Simpan(); break;
					default		: $result=$this->M_pemantauan->Update(); break;
				}
            	$bantu=explode("/",$result);
				 
				if($bantu[0]==1){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				//
				switch ($bantu[1])
				{
					case	"0"	:  $this->session->set_flashdata('error', 'Gagal Upload File !'); break;
					case	"1"	:  $this->session->set_flashdata('error', 'OK'); break;
					case	"2"	:  $this->session->set_flashdata('error', 'Ukuran File upload terlalu besar ! '); break;
					case	"3"	:  $this->session->set_flashdata('error', 'Belum ada File upload yang dipilih ! '); break;
					case	"4"	:  $this->session->set_flashdata('error', 'Ekstensi File yang diupload hanya (jpg,jpeg,gif,png,bmp,pdf) '); break;
					default		:  $this->session->set_flashdata('error', ' ');  break;
				} 
				 
            	redirect('pemantauan');
        	}elseif ($this->input->post('cmdPerusahaan'))  
			{
				redirect('perusahaan/edit/'.$this->input->post('txtperusahaan'));
			}else{
            	$idjadwal      = $this->uri->segment(3);
				 
            	$data['rowedit'] = $this->M_pemantauan->SelectByID($idjadwal);
            	$this->load->view('pemantauan/v_editpemantauan',$data);
        	}
    	}
    
    	function delete()
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
        	$id = $this->uri->segment(4) or $id=0;
			$prs_id = $this->uri->segment(3);
        	if(!empty($id)){
           	 	// proses delete data
            	$result=$this->M_pemantauan->Delete($id,$prs_id);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'hapus');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
        	}
        	redirect('pemantauan');
   	 	}

	
	}

?>