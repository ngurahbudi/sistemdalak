<?
	class M_kelurahan extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_kelurahan"; 
			
 
    	} 
		public function SelectAllData() 
		{
			$sql = "SELECT * FROM " . $this->namatabel . " a INNER JOIN tb_kecamatan b on a.kecamatan_id=b.kecamatan_id" ; 
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function SelectByID($id)
		{
			$sql="select * from  ". $this->namatabel;
			$sql.=" where kelurahan_id ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		
		function Simpan() 
		{
        	 
			$data = array(
					'kelurahan_id' 	=> $this->input->post('txtID'),
					'kecamatan_id' 	=> $this->input->post('cbokecamatan'),
					'kelurahan' 	=> $this->input->post('txtkelurahan')
			);
        	$this->db->insert($this->namatabel,$data);
			return $this->db->affected_rows();
   	 	}
    
    	function Update() 
		{
        	$data = array(
					 
					'kelurahan' => $this->input->post('txtkelurahan'),
					'kecamatan_id' => $this->input->post('cbokecamatan')
			);
        	
        	$this->db->where('kelurahan_id',$this->input->post('txtID'));
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
			$this->db->where('kelurahan_id',$id);
            $this->db->delete($this->namatabel);
			return $this->db->affected_rows();
		
		}
		 
		 
 
	}


?>