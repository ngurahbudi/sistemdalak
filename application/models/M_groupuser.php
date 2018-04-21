<?
	class M_groupuser extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_groupuser"; 
 
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
			$sql.=" where groupuser_id ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		function Simpan() 
		{
        	 
			$data = array(
					'groupuser_id' 	=> $this->input->post('txtID'),
					'groupuser' 	=> $this->input->post('txtgroupuser')
			);
        	$this->db->insert($this->namatabel,$data);
			return $this->db->affected_rows();
   	 	}
    
    	function Update() 
		{
        	$data = array(
					 
					'groupuser' => $this->input->post('txtgroupuser')
			);
        	
        	$this->db->where('groupuser_id',$this->input->post('txtID'));
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
			$this->db->where('groupuser_id',$id);
            $this->db->delete($this->namatabel);
			return $this->db->affected_rows();
		
		}
		 
 
	}


?>