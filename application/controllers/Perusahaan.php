<?
	class Perusahaan extends CI_Controller
	{
		public $title;	// class variabel for variabel global
	
		public function __construct()
		{
        		parent::__construct(); // needed when adding a constructor to a controller
        		$this->load->model('M_perusahaan');
				 
				$this->title = array(
            	 				'menu' 		=> 'Master Data',
            	 				'submenu' 	=> 'Data Perusahaan', 
								'linkadd' 	=> 'perusahaan/add',
								'linklist' 	=> 'perusahaan',
								'FID'		=>	'B'
        						 );
	  
    	}    
	
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$data=$this->title;
				$data['status']="";	// untuk pesan error atau sukses
				$data['alldata']= $this->M_perusahaan->SelectAllData();
				
				$this->load->view('perusahaan/v_listperusahaan',$data);  
				
			}else
			{
				redirect (base_url()) ;
			} 	
		}
		
		public function add() 
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
			$data['row_cbojalan']=$this->mycombo->LoadCombo("tb_jalan"); 
			$data['row_cbokelurahan']=$this->mycombo->LoadCombo("tb_kelurahan"); 
			if ($this->input->post('cmdSimpan'))  {
            	$result =$this->M_perusahaan->Simpan();
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('perusahaan/add');
        	} else {
            	$this->load->view('perusahaan/v_addperusahaan',$data);
        	}
    	}
		
		function edit()
		{
        	$data=$this->title;
			$perusahaanid      = $this->uri->segment(3);
			$data['status']="";	// untuk pesan error atau sukses
			$data['row_cbojalan']=$this->mycombo->LoadCombo("tb_jalan"); 
			$data['row_cbokelurahan']=$this->mycombo->LoadCombo("tb_kelurahan");
			$data['row_cbokategory']=$this->mycombo->LoadCombo("tb_kategory");
			$data['row_cbomasalah']=$this->mycombo->LoadCombo("tb_klasifikasi_masalah");
			$data['row_filefoto']=$this->M_perusahaan->SelectFileFotoByID($perusahaanid);
			$data['row_history']=$this->M_perusahaan->SelectHistoryByID($perusahaanid);
			$data['row_arsip']=$this->M_perusahaan->SelectArsipByID($perusahaanid);
			$ID=$this->input->post('txtID');  
			if ($this->input->post('cmdUpdate'))  {
            	$result=$this->M_perusahaan->Update($ID);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('perusahaan/edit/'.$ID);
        	}elseif ($this->input->post('cmdUpdate2'))  {
            	$result=$this->M_perusahaan->UpdateNomorKotak($ID);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'sukses');
				}else{
					 $this->session->set_flashdata('status', 'gagal');
				}
				
            	redirect('perusahaan/edit/'.$ID);
			}else{
            	
            	$data['rowedit'] = $this->M_perusahaan->SelectByID($perusahaanid);
            	$this->load->view('perusahaan/v_editperusahaan',$data);
        	}
    	}
    
    	function delete()
		{
			$data=$this->title;
			$data['status']="";	// untuk pesan error atau sukses
        	$id = $this->uri->segment(3);
        	if(!empty($id)){
           	 	// proses delete data
            	$result=$this->M_perusahaan->Delete($id);
				if($result>0){	// berhasil
					$this->session->set_flashdata('status', 'hapus');
				}else{
					$this->session->set_flashdata('status', 'gagal');
				}
        	}
        	redirect('perusahaan');
   	 	}

		function hapusfile()
		{
			$id=$this->input->post('id');
			$folder=$this->input->post('folder');
			$namafile=$this->input->post('file');
			$prsid=$this->input->post('prsid');
			// hapus dari tabel
			$this->M_perusahaan->DeleteArsipFile($prsid,$id,$folder,$namafile);
			// hapus file dari server			 
		}
		function hapusfoto()
		{
			$id=$this->input->post('id');
			$folder=$this->input->post('folder');
			$namafile=$this->input->post('file');
			$prsid=$this->input->post('prsid');
			$monitid=$this->input->post('monitid');  
			//echo "monit id= ".$monitid . " prsid=" .$prsid;
			// hapus dari tabel
			$this->M_perusahaan->DeleteFotoFile($monitid,$id,$folder,$namafile);
			// hapus file dari server			 
		}
		
		function tampil_arsip()
		{
			$prs_id=$this->input->post('id'); 
			$data['row_arsip']=$this->M_perusahaan->SelectArsipByID($prs_id);
			//echo "DATDATDAT $prs_id";
			 $this->load->view('perusahaan/v_tabel_arsip',$data); 
		}
		
		function tampil_galery()
		{
			$prs_id=$this->input->post('id'); 
			$data['row_filefoto']=$this->M_perusahaan->SelectFileFotoByID($prs_id);
			// echo "DATDATDAT $prs_id";
			  $this->load->view('perusahaan/v_tabel_galery',$data); 	
		}
		function tampil_carousel()
		{
			$prs_id=$this->input->post('id'); 
			$data['row_filefoto']=$this->M_perusahaan->SelectFileFotoByID($prs_id);
			// echo "DATDATDAT $prs_id";
			  $this->load->view('perusahaan/v_carousel',$data); 	
		}
	}

?>