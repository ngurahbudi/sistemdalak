<?
	class M_melengkapi extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_melengkapi_berkas"; 
			
 
    	} 
		public function SelectAllData($where="") 
		{
			$sql = "SELECT * FROM " . $this->namatabel . " f INNER JOIN tb_perusahaan g on f.prs_id=g.prs_id 
					INNER JOIN tb_jalan b on g.jalan_id=b.jalan_id 
					inner join tb_kelurahan c on g.kelurahan_id=c.kelurahan_id inner join tb_kecamatan d on c.kecamatan_id=d.kecamatan_id  
					WHERE 1=1 " . $where   ; 
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function SelectByID($id)
		{
			$sql="select * from  ". $this->namatabel;
			$sql.=" where melengkapi_id ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		
		function Simpan() 
		{
        	$idnew=$this->M_melengkapi->CreateNewID('MP',4);  
			$tglturun=$this->mycombo->FormatYMD($this->input->post('txttglturun'));
			 
			$data = array(
					'melengkapi_id' 	=> $idnew,
					'prs_id' 		=> $this->input->post('cboperusahaan'),
					'melengkapi_tgl' 	=> $tglturun,
					'catatan' 	=> $this->input->post('txtcatatan'),
					'update_tgl' 	=> date('Y-m-d'),
					'update_user'	=> $_SESSION['username']
			);
			//upload file
			$uploadsukses=$this->M_melengkapi->upload_file($this->input->post('cboperusahaan'),$idnew,"MP");
			//=====
        	$this->db->insert($this->namatabel,$data);
			return $this->db->affected_rows()."/".$uploadsukses;
   	 	}
    
    	function Update() 
		{
			$tglturun=$this->mycombo->FormatYMD($this->input->post('txttglturun'));
        	$data = array(
					 
					'prs_id' 		=> $this->input->post('cboperusahaan'),
					'melengkapi_tgl' 	=> $tglturun,
					'catatan' 		=> $this->input->post('txtcatatan'),
					'update_tgl' 	=> date('Y-m-d'),
					'update_user'	=> $_SESSION['username']
			);
        	
        	$this->db->where('melengkapi_id',$this->input->post('txtID'));
			//upload file
			$uploadsukses=$this->M_melengkapi->upload_file($this->input->post('cboperusahaan'),$this->input->post('txtID'),"MP");
			//=====
        	if($this->db->update($this->namatabel,$data))
			{
				return "1/".$uploadsukses;
			}else
			{
				return "0/".$uploadsukses;
			}
	
    	}
		
		function Delete($id)
		{
			$this->db->where('melengkapi_id',$id);
            $this->db->delete($this->namatabel);
			return $this->db->affected_rows();
		
		}
		function CreateNewID($prefix,$digit)
		{
			$sql="SELECT MAX(melengkapi_id) as maksi FROM " . $this->namatabel;
			$sql.=" WHERE melengkapi_id <>'' ";
			 
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
								$det=$this->M_melengkapi->getNewUrutan("id_file","tb_file_fotomonitoring", " and monit_id='$monitid'");
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