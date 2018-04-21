<?
	class M_kecamatan extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_kecamatan"; 
 
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
			$sql.=" where kecamatan_id ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		function Simpan() 
		{
        	 
			$data = array(
					'kecamatan_id' 	=> $this->input->post('txtID'),
					'kecamatan' 	=> $this->input->post('txtkecamatan')
			);
        	$this->db->insert($this->namatabel,$data);
			return $this->db->affected_rows();
   	 	}
    
    	function Update() 
		{
        	$data = array(
					 
					'kecamatan' => $this->input->post('txtkecamatan')
			);
        	
        	$this->db->where('kecamatan_id',$this->input->post('txtID'));
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
			$this->db->where('kecamatan_id',$id);
            $this->db->delete($this->namatabel);
			return $this->db->affected_rows();
		
		}
		 
 
	}


?>