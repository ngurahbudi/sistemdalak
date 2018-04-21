<?
	class M_user extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_user"; 
			
 
    	} 
		public function SelectAllData() 
		{
			$sql = "SELECT * FROM " . $this->namatabel . " a INNER JOIN tb_groupuser b on a.groupuser_id=b.groupuser_id" ; 
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function SelectByID($id)
		{
			$sql="select * from  ". $this->namatabel;
			$sql.=" where userid ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		
		function Simpan() 
		{
        	 
			$data = array(
					'userid' 	=> $this->input->post('txtID'),
					'usernama' 	=> $this->input->post('txtuser'),
				    'password' 	=> md5($this->input->post('txtpass')),
					'groupuser_id' 	=> $this->input->post('cbogroup') 
					
			);
        	$this->db->insert($this->namatabel,$data);
			return $this->db->affected_rows();
   	 	}
    
    	function Update() 
		{
        	$data = array(
					 
					'usernama' => $this->input->post('txtuser'),
					'groupuser_id' => $this->input->post('cbogroup')
			);
        	
        	$this->db->where('userid',$this->input->post('txtID'));
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
			$this->db->where('userid',$id);
            $this->db->delete($this->namatabel);
			return $this->db->affected_rows();
		
		}
		 
		 
 
	}


?>