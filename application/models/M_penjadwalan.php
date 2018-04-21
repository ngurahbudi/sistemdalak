<?
	class M_penjadwalan extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_jadwal"; 
			
 
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
			$sql.=" where jadwal_id ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		
		function Simpan() 
		{
        	$idnew=$this->M_penjadwalan->CreateNewID('JD',4);  
			$tglturun=$this->mycombo->FormatYMD($this->input->post('txttglturun'));
			 
			$data = array(
					'jadwal_id' 	=> $idnew,
					'prs_id' 		=> $this->input->post('cboperusahaan'),
					'jenismonitoring_id' 	=> $this->input->post('cbokegiatan'),
					'update_tgl' 	=> date('Y-m-d'),
					'jadwal_tgl' 	=> $tglturun,
					'update_user'	=> $_SESSION['username']
			);
        	$this->db->insert($this->namatabel,$data);
			return $this->db->affected_rows();
   	 	}
    
    	function Update() 
		{
			$tglturun=$this->mycombo->FormatYMD($this->input->post('txttglturun'));
        	$data = array(
					 
					'prs_id' 		=> $this->input->post('cboperusahaan'),
					'jenismonitoring_id' 	=> $this->input->post('cbokegiatan'),
					'update_tgl' 	=> date('Y-m-d'),
					'jadwal_tgl' 	=> $tglturun,
					'update_user'	=> $_SESSION['username']
			);
        	
        	$this->db->where('jadwal_id',$this->input->post('txtID'));
        	if($this->db->update($this->namatabel,$data))
			{
				return 1;
			}else
			{
				return 0;
			}
	
    	}
		
		function Delete($id)
		{
			$this->db->where('jadwal_id',$id);
            $this->db->delete($this->namatabel);
			return $this->db->affected_rows();
		
		}
		function CreateNewID($prefix,$digit)
		{
			$sql="SELECT MAX(jadwal_id) as maksi FROM " . $this->namatabel;
			$sql.=" WHERE jadwal_id <>'' ";
			 
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
		 
 
	}


?>