<?
	class M_perusahaan extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_perusahaan"; 
 
    	} 
		public function SelectAllData() 
		{
			$sql = "SELECT * FROM " . $this->namatabel . " a INNER JOIN tb_jalan b on a.jalan_id=b.jalan_id inner join tb_kelurahan c on a.kelurahan_id=c.kelurahan_id inner join tb_kecamatan d on c.kecamatan_id=d.kecamatan_id " ;  
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function SelectByID($id)
		{
			$sql="select * from  ". $this->namatabel;
			$sql.=" INNER JOIN tb_key_api where prs_id  ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		function SelectFileFotoByID($id)
		{
			$sql="SELECT
					tb_file_fotomonitoring.id_file,
					tb_file_fotomonitoring.monit_id,
					tb_file_fotomonitoring.nama_file,
					tb_jadwal.jadwal_tgl,tb_jadwal.prs_id,
					tb_jenis_monitoring.jenismonitoring
					FROM
					tb_file_fotomonitoring
					Inner Join tb_monitoring ON tb_file_fotomonitoring.monit_id = tb_monitoring.monit_id
					Inner Join tb_jadwal ON tb_monitoring.jadwal_id = tb_jadwal.jadwal_id
					Inner Join tb_jenis_monitoring ON tb_jadwal.jenismonitoring_id = tb_jenis_monitoring.jenismonitoring_id 
					WHERE  prs_id  ='". $id  ."'
					UNION
					SELECT
					tb_file_fotomonitoring.id_file,
					tb_file_fotomonitoring.monit_id,
					tb_file_fotomonitoring.nama_file,
					tb_melengkapi_berkas.melengkapi_tgl,
					tb_melengkapi_berkas.prs_id,
					'Melengkapi Berkas'
					FROM
					tb_file_fotomonitoring
					Inner Join tb_melengkapi_berkas ON tb_file_fotomonitoring.monit_id = tb_melengkapi_berkas.melengkapi_id " ;
			$sql.=" WHERE  prs_id  ='". $id  ."' order by id_file ";
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function SelectHistoryByID($id)
		{
			$sql="SELECT
					tb_monitoring.monit_id,
					tb_jadwal.jadwal_tgl as tgl,
					tb_jenis_monitoring.jenismonitoring_id,
					tb_jenis_monitoring.jenismonitoring,
					tb_perusahaan.prs_nama,
					tb_monitoring.catatanlapangan,
					tb_monitoring.monit_tglupdate as tglupdate
					FROM
					tb_monitoring
					Inner Join tb_jadwal ON tb_monitoring.jadwal_id = tb_jadwal.jadwal_id
					Inner Join tb_jenis_monitoring ON tb_jadwal.jenismonitoring_id = tb_jenis_monitoring.jenismonitoring_id
					Inner Join tb_perusahaan ON tb_jadwal.prs_id = tb_perusahaan.prs_id
					WHERE tb_jadwal.prs_id ='". $id  ."'
					 
					UNION
					SELECT
					tb_melengkapi_berkas.melengkapi_id,
					tb_melengkapi_berkas.melengkapi_tgl as tgl,
					'berkas',
					'Melengkapi Berkas',
					tb_perusahaan.prs_nama,
					tb_melengkapi_berkas.catatan,
					tb_melengkapi_berkas.update_tgl as tglupdate
					FROM
					tb_melengkapi_berkas
					Inner Join tb_perusahaan ON tb_melengkapi_berkas.prs_id = tb_perusahaan.prs_id" ;				  
			$sql.=" WHERE tb_perusahaan.prs_id ='". $id  ."' order by tgl, tglupdate   ";
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function SelectArsipByID($id)
		{
			$sql="SELECT
					tb_perusahaan.prs_id,
					tb_perusahaan.prs_nama,
					tb_file_arsip.arsip_id,
					tb_file_arsip.keterangan,
					tb_file_arsip.nama_arsip
					FROM
					tb_file_arsip
					Inner Join tb_perusahaan ON tb_file_arsip.prs_id = tb_perusahaan.prs_id" ;				  
			$sql.=" WHERE  tb_perusahaan.prs_id ='". $id  ."'   ";
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function Simpan() 
		{
        	$idnew=$this->M_perusahaan->CreateNewID('PS',4); 
			$data = array(
					'prs_id' 	=> $idnew,
					'jalan_id' 			=> $this->input->post('cbojalan'),
					'prs_nama' 			=> $this->input->post('txtperusahaan'),
					'prs_lokasidet' 	=> $this->input->post('txtlokasidet'),
					'kelurahan_id' 		=> $this->input->post('cbokelurahan'),
					'prs_telpkantor' 	=> $this->input->post('txttelpkantor'),
					'prs_telpcontact' 	=> $this->input->post('txtnohp'),
					'prs_namacontact' 	=> $this->input->post('txtnamakontak'),
					'prs_email' 		=> $this->input->post('txtemail') 
			);
        	$this->db->insert($this->namatabel,$data);
			return $this->db->affected_rows();
   	 	}
    	
		function UpdateNomorKotak($prs_id)
		{
			$data=array(
					'arsip_nokotak'	=>	$this->input->post('txtnomorkotak')
			);
			$this->db->where('prs_id',$prs_id);
			if($this->db->update($this->namatabel,$data))
			{
				return 1;
			}else
			{
				return 0;
			}
		
		}
	
    	function Update($idnya) 
		{
			$nomortab=$this->input->post('tabnomor');
			switch ($nomortab)
			{
				case	"tab1" : 
								$data = array(
										'prs_id' 	=> $idnya,
										'jalan_id' 			=> $this->input->post('cbojalan'),
										'prs_nama' 			=> $this->input->post('txtperusahaan'),
										'prs_lokasidet' 	=> $this->input->post('txtlokasidet'),
										'kelurahan_id' 		=> $this->input->post('cbokelurahan'),
										'prs_telpkantor' 	=> $this->input->post('txttelpkantor'),
										'prs_telpcontact' 	=> $this->input->post('txtnohp'),
										'prs_namacontact' 	=> $this->input->post('txtnamakontak'),
										'prs_email' 		=> $this->input->post('txtemail') 
										);
								break;
				case	"tab2"		:
								$tglakta=$this->mycombo->FormatYMD($this->input->post('txttglakta'));
								$tglham =$this->mycombo->FormatYMD($this->input->post('txttglham'));
								$data = array( 
										'prs_bidangusaha' 	=> $this->input->post('txtbidangusaha'),
										'prs_noakta' 		=> $this->input->post('txtnoakta'),
										'prs_tglakta' 		=> $tglakta,
										'prs_noHAM' 		=> $this->input->post('txtnoham'),
										'prs_tglHAM' 		=> $tglham, 
 										'prs_adaNPWP' 		=> $this->input->post('cekNPWP'), 
										'prs_adaSHM' 		=> $this->input->post('cekSHM'), 
										'prs_adaIMB' 		=> $this->input->post('cekIMB'),
										'prs_adasewatanah' 	=> $this->input->post('cekSewaTanah'),
										'prs_adasewagedung' => $this->input->post('cekSewaGedung'),
										'prs_adaUKLUPL'	 	=> $this->input->post('cekUKL'),
										'prs_adaLKPM'	 	=> $this->input->post('cekLKPM'),
										'prs_adaKITAS'	 	=> $this->input->post('cekKITAS'), 
										'LKPM_terakhir'	 	=> $this->input->post('txtlkpmterakhir') 
										);    
								break;
				case	"tab3"		:
								$data = array( 
										'prs_nodaftarPMA' 	=> $this->input->post('txtnodaftarpma'),
										'prs_noSITU' 		=> $this->input->post('txtnositu'),
										'prs_noHO' 			=> $this->input->post('txtnoho'),
										'prs_noTDP' 		=> $this->input->post('txtnotdp'),
									 	'prs_noIPPMA' 		=> $this->input->post('txtnoippma'),
										'prs_tahunberlakuIPPMA' 	=> $this->input->post('txttahunippma'),
										'prs_noIPPRB' 		=> $this->input->post('txtijinperubahan'),
										'prs_noIPPRLS' 		=> $this->input->post('txtijinperluasan'),
										'prs_noIjinUsaha' 	=> $this->input->post('txtijinusaha'),
										
										
										);    
								break;
 				case	"tab4"		:
								$data = array( 
										'kategory_id' 	=> $this->input->post('cbokategory'),
										'klasmasalah_id' 	=> $this->input->post('cbomasalah'),
										'prs_nilaiInvestasiRP' 	=> $this->input->post('txtnilairp'),
										'prs_nilaiInvestasiUSD' => $this->input->post('txtnilaiusd'),
										'prs_jumlahWNI_laki' 	=> $this->input->post('txtwnilaki'),
									 	'prs_jumlahWNI_perempuan' 		=> $this->input->post('txtwniperempuan'),
										'prs_jumlahWNA_laki' 	=> $this->input->post('txtwnalaki'),
										'prs_jumlahWNA_perempuan' 		=> $this->input->post('txtwnaperempuan'),
										'prs_map_latitude' 		=> $this->input->post('txtlat'),
										'prs_map_longitude' 	=> $this->input->post('txtlong') 
										
										);    
								break;	
				case	"tab7"		:	
									//upload file
									$uploadsukses=$this->M_perusahaan->upload_file($this->input->post('txtID'), $this->input->post('txtketerangan') );
									//=====	 						
			
			}
        	
        	if($nomortab==="tab7")
			{	
				if($uploadsukses==1)
				{
					return 1;
				}else
				{
					return 0;
				}
			}else{
				$this->db->where('prs_id',$idnya);
				if($this->db->update($this->namatabel,$data))
				{
					return 1;
				}else
				{
					return 0;
				}
			}
	
    	}
		
		function Delete($id)
		{
			//$this->db->where('prs_id',$id);
            //$this->db->delete($this->namatabel);
			// dalam hal ini perusahaann cuma di nonaktifkan
			$data = array( 
							'aktif_id' 	=> 0  			
					);    
			$this->db->where('prs_id',$id);
        	if($this->db->update($this->namatabel,$data))
			{
				return 1;
			}else
			{
				return 0;
			}
		
		}
		 
		function CreateNewID($prefix,$digit)
		{
			$sql="SELECT MAX(prs_id) as maksi FROM " . $this->namatabel;
			$sql.=" WHERE prs_id <>'' ";
			 
			$query = $this->db->query($sql)->result_array();
			foreach ($query as $row) 
			{
				if(is_null($row['maksi']) or $row['maksi']=="")
				{ 	
					$number=$prefix.".".substr("000001", -1 * $digit,$digit);  
				}else
				{
					$mulai=strlen($row['maksi']);
					$bantu=  substr($row['maksi'],-$digit,$digit) +1  ;
					$number=$prefix.".".  substr("000000" . $bantu,-$digit,$digit) ;  
				}
			}
			
			return $number;
		} 
 	
 		function upload_file($prsid, $keterangan)
		{
			$ekstensi_diperbolehkan	= array('jpg','jpeg','gif','png','bmp','xls','xlsx','pdf','doc','docx' ); 
			$nama = $_FILES['txtfile']['name'];
			//$target_dir = "./upload/"; 
			$prstxt=str_replace(".","-",$prsid); 
			$target_dir= "./upload/".$prstxt;
			if (!is_dir($target_dir)) {
				mkdir($target_dir, 0777, true);
			}

			foreach ($_FILES["txtfile"]["error"] as $key => $error) 
			{	 
			    if ($error == 0) {
						$tmp_name = $_FILES["txtfile"]["tmp_name"][$key];
						$name = $_FILES["txtfile"]["name"][$key];
						$x = explode('.', $name);
						$ukuran	= $_FILES['txtfile']['size'][$key];
						$ekstensi = strtolower(end($x));
						if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
						{ 
							if($ukuran < 5120070)
							{	
							  // proses upload ke server
								 
								$newfilename=basename($prstxt."-arsip-$keterangan.$x[1]");// otomatis rename file  
								if ( move_uploaded_file($tmp_name, $target_dir."/".$newfilename)) {
									// simpan ke tabel
									  $sql="INSERT INTO tb_file_arsip (prs_id,keterangan,nama_arsip ) VALUES (
									  '$prsid' ,'$keterangan','$newfilename')";
									  $query=$this->db->query($sql);
									$status = 1; // sukses
								} else {
									$status = 0; // gagal 
								}
							}else{
								$status= 2;                  // 'Ukuran File terlalu besar !';
							}
						}elseif($nama=="")
						{
							$status= 3;   					// 'Belum ada File yang dipilih !';
						}else{
							$status= 4;						// 'Ekstensi File yang diimport hanya Excell (jpg,jpeg,gif,png,bmp,pdf)';
						}  	
				} 
			} 
			 return $status;  
			// echo $i; 
			// die('='.$errornya);
		
		}
		
 		function DeleteArsipFile($prs_id,$id_file,$folder,$namafile)
		{
			$this->db->where('prs_id',$prs_id);
			$this->db->where('arsip_id',$id_file);
 			 
        	if($this->db->delete("tb_file_arsip"))
			{
				// remove from server
				$target_dir= "./upload/".$folder."/".$namafile;
				unlink($target_dir);
				
				return 1;
			}else
			{
				return 0;
			}
		
		}
 		
		function DeleteFotoFile($monit_id,$id_file,$folder,$namafile)
		{
			$this->db->where('monit_id',$monit_id);
			$this->db->where('id_file',$id_file);
 			 
        	if($this->db->delete("tb_file_fotomonitoring"))
			{
				// remove from server
				$target_dir= "./upload/".$folder."/".$namafile;
				//unlink($target_dir);
				
				return 1;
			}else
			{
				return 0;
			}
		
		}
 
	}


?>