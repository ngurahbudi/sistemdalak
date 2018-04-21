<?
	class M_pemantauan extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_monitoring"; 
			
 
    	} 
		public function SelectAllData($where="") 
		{
			$sql = "SELECT a.jadwal_id,   a.jadwal_tgl, c.prs_id, c.prs_nama, c.prs_lokasidet, d.jalan_id, d.namajalan, f.kelurahan,
     				g.kecamatan, b.monit_id, b.monit_userupdate, b.monit_tglupdate,  b.klasmasalah_id,
	                b.targetwaktu, b.catatanlapangan,  h.jenismonitoring_id, h.jenismonitoring, b.catatanlapangan,
					c.prs_bidangusaha, c.prs_telpkantor, c.prs_noIPPMA, prs_noIPPRB, prs_noIPPRLS, prs_telpcontact, prs_telpkantor
					FROM
					tb_jadwal AS a
					Left Join ". $this->namatabel ." AS b ON b.jadwal_id = a.jadwal_id
					Inner Join tb_perusahaan AS c ON a.prs_id = c.prs_id
					Inner Join tb_jalan AS d ON c.jalan_id = d.jalan_id
					Inner Join tb_kelurahan AS f ON c.kelurahan_id = f.kelurahan_id
					Inner Join tb_kecamatan AS g ON f.kecamatan_id = g.kecamatan_id
					Inner Join tb_jenis_monitoring AS h ON a.jenismonitoring_id = h.jenismonitoring_id

					WHERE h.jenismonitoring_id='PM' " . $where  ;  
					 
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function SelectByID($id)
		{
			$sql = "SELECT a.jadwal_id,   a.jadwal_tgl, c.prs_id, c.prs_nama, c.prs_lokasidet, d.jalan_id, d.namajalan, f.kelurahan,
     				g.kecamatan, b.monit_id, b.monit_userupdate, b.monit_tglupdate, b.kategory_id,  b.klasmasalah_id,
	                b.targetwaktu, b.catatanlapangan,   h.jenismonitoring_id, h.jenismonitoring, b.catatanlapangan,
					c.prs_bidangusaha, c.prs_telpkantor, c.prs_noIPPMA, prs_noIPPRB, prs_noIPPRLS, prs_telpcontact, prs_telpkantor
					FROM
					tb_jadwal AS a
					Left Join ". $this->namatabel ." AS b ON b.jadwal_id = a.jadwal_id
					Inner Join tb_perusahaan AS c ON a.prs_id = c.prs_id
					Inner Join tb_jalan AS d ON c.jalan_id = d.jalan_id
					Inner Join tb_kelurahan AS f ON c.kelurahan_id = f.kelurahan_id
					Inner Join tb_kecamatan AS g ON f.kecamatan_id = g.kecamatan_id
					Inner Join tb_jenis_monitoring AS h ON a.jenismonitoring_id = h.jenismonitoring_id";
			 
			$sql.=" where a.jadwal_id ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		
		
		function Simpan() 
		{
        	$idnew=$this->M_pemantauan->CreateNewID('PM',4);  
  			
			$data = array(
					'monit_id' 			=> $idnew,
					'jadwal_id' 		=> $this->input->post('txtID'),
					'catatanlapangan' 	=> $this->input->post('txtcatatan'),
					'targetwaktu' 		=> null,
					'klasmasalah_id' 	=> $this->input->post('cboklasmasalah'),
					'kategory_id' 		=> $this->input->post('cbokategory'),
					'monit_tglupdate' 	=> date('Y-m-d'),
					'monit_userupdate'	=> $_SESSION['username']
			);
			$data2= array(
					 
					'klasmasalah_id' 	=> $this->input->post('cboklasmasalah'),
					'kategory_id' 		=> $this->input->post('cbokategory'),
					'sudah_PM' 			=> 1  
			);
			$this->db->trans_begin();
        	$this->db->insert($this->namatabel,$data); 
			$this->db->where('prs_id',$this->input->post('txtperusahaan'));
			$this->db->update("tb_perusahaan",$data2); // update di tabel perusahaan set klas masalah dan kategory perusahaan
			
			//upload file
			$uploadsukses=$this->M_pemantauan->upload_file($this->input->post('txtperusahaan'),$idnew,"PM");
			//=====
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				//Tulis pesan gagal
				return "0/".$uploadsukses;
			}
			else
			{
				$this->db->trans_commit();
				//Tulis pesan berhasil
				return "1/".$uploadsukses;
			}
			
   	 	}
    
    	function Update() 
		{
			 
        	$data = array(
					 
					'jadwal_id' 		=> $this->input->post('txtID'),
					'catatanlapangan' 	=> $this->input->post('txtcatatan'),
					'targetwaktu' 		=> null,
					'klasmasalah_id' 	=> $this->input->post('cboklasmasalah'),
					'kategory_id' 		=> $this->input->post('cbokategory'),
					'monit_tglupdate' 	=> date('Y-m-d'),
					'monit_userupdate'	=> $_SESSION['username']
			);
			
			$data2= array(
					 
					'klasmasalah_id' 	=> $this->input->post('cboklasmasalah'),
					'kategory_id' 		=> $this->input->post('cbokategory'),
					'sudah_PM'			=> 1
					 
			);

			$this->db->trans_begin();
			$this->db->where('monit_id',$this->input->post('txtIDmonit'));
        	$this->db->update($this->namatabel,$data);
			$this->db->where('prs_id',$this->input->post('txtperusahaan'));
			$this->db->update("tb_perusahaan",$data2); // update di tabel perusahaan set klas masalah dan kategory perusahaan
			
			//upload file
			$uploadsukses=$this->M_pemantauan->upload_file($this->input->post('txtperusahaan'),$this->input->post('txtIDmonit'),"PM");
			//=====
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				//Tulis pesan gagal
				return "0/".$uploadsukses;
			}
			else
			{
				$this->db->trans_commit();
				//Tulis pesan berhasil
				return "1/".$uploadsukses;
			} 
	
    	}
		
		function CekSudahSurvey($perusahaan,$monit_id)
		{
			$jenis="PM";
			$sql="SELECT count(monit_id) as jumlah FROM tb_monitoring a
					INNER JOIN tb_jadwal b on a.jadwal_id=b.jadwal_id
					WHERE b.jenismonitoring_id ='$jenis' and b.prs_id='$perusahaan'
					and a.monit_id <> '$monit_id'
			";
			$query=$this->db->query($sql);
			$hasil=$query->row_array();
			 
			return $hasil['jumlah'];  
			
		}
		
		function Delete($id,$prs_id)
		{
			$sudah=$this->M_pemantauan->CekSudahSurvey($prs_id,$id);
			$data= array(
					'sudah_PM'			=> $sudah 
			);
			
 			$this->db->trans_begin();
			$this->db->where('monit_id',$id);
            $this->db->delete($this->namatabel);
			
			$this->db->where('prs_id',$prs_id);
			$this->db->update("tb_perusahaan",$data); // update di tabel perusahaan set  
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				//Tulis pesan gagal
				return "0";
			}
			else
			{
				$this->db->trans_commit();
				//Tulis pesan berhasil
				return "1";
			} 
			 
		}
		
		
		function CreateNewID($prefix,$digit)
		{
			$sql="SELECT MAX(monit_id) as maksi FROM " . $this->namatabel;
			$sql.=" WHERE monit_id <>''  and   substr(monit_id,1,2) ='PM' ";
			 
			$query = $this->db->query($sql)->result_array();
			foreach ($query as $row) 
			{
				if(is_null($row['maksi']) or $row['maksi']=="")
				{ 	
					$number=$prefix.".". substr(date("Y"),-2,2) .substr("000001", -1 * $digit,$digit);  
				}else
				{
					$mulai=strlen($row['maksi']);
					$bantu=  substr($row['maksi'],-$digit,$digit) + 1  ;
					$number=$prefix.".". substr(date("Y"),-2,2) .  substr("000000" . $bantu,-$digit,$digit) ;  
				}
			}
			 
			return $number;
		}  
		 
 		function upload_file($prsid,$monitid,$kegiatan)
		{
			$ekstensi_diperbolehkan	= array('jpg','jpeg','gif','png','bmp' ); 
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
								$det=$this->M_pemantauan->getNewUrutan("id_file","tb_file_fotomonitoring", " and monit_id='$monitid'");
								$newfilename=basename($prstxt."-".$kegiatan."-". $det.".$x[1]");// otomatis rename file  
								if ( move_uploaded_file($tmp_name, $target_dir."/".$newfilename)) {
									// simpan ke tabel
									  $sql="INSERT INTO tb_file_fotomonitoring (monit_id,nama_file ) VALUES (
									  '$monitid' ,'$newfilename')";
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
		
//========================================	
	// fungsi auto generate urutan
//======================================== 
	function getNewUrutan($namafield,$namatabel, $str=""){
		 
		$sql="SELECT count($namafield) as maksi from $namatabel where monit_id <>'0'  $str  ";  
		$query=$this->db->query($sql);
		$res = $query->row_array();
 
		if(is_null($res['maksi']))
		{
			$num=1;  
		}else
		{
			$bantu= $res['maksi'] +1;
			$num= $bantu ;
		} 
		 
		return $num; 
	}	
		
 
}


?>