<?
	class M_kategory extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_klasifikasi_masalah"; 
 
    	} 
		public function SelectAllData() 
		{
			$sql = "SELECT * FROM " . $this->namatabel ; 
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function SelectByID($id)
		{
			$sql="select * from  ". $this->namatabel;
			$sql.=" where klasmasalah_id ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		function Simpan() 
		{
        	$idnew=$this->M_kategory->CreateNewID('KM',2);
			$data = array(
					'klasmasalah_id' => $idnew,
					'klasmasalah' => $this->input->post('txtKlasifikasi')
			);
        	$this->db->insert($this->namatabel,$data);
			return $this->db->affected_rows();
   	 	}
    
    	function Update() 
		{
        	$data = array(
					 
					'klasmasalah' => $this->input->post('txtKlasifikasi')
			);
        	
        	$this->db->where('klasmasalah_id',$this->input->post('txtID'));
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
			$this->db->where('klasmasalah_id',$id);
            $this->db->delete($this->namatabel);
			return $this->db->affected_rows();
		
		}
		function CreateNewID($prefix,$digit)
		{
			$sql="SELECT MAX(klasmasalah_id) as maksi FROM " . $this->namatabel;
			$sql.=" WHERE klasmasalah_id<>'' ";
			 
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
 
	}


?>