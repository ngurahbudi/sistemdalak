<?
	class M_kategory extends CI_Model{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_klasifikasi_masalah"; 
 
    	} 
		 
		function GetListData()
		{
			$sql="select * from  ". $this->namatabel;
			$sql.=" where klasmasalah_id<>'' ";
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function LoadDataUpdate($id)
		{
			$sql="select * from  ". $this->namatabel;
			$sql.=" where klasmasalah_id='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
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
		function Simpan($id)
		{
			$data = array(
					'klasmasalah_id' => $id,
					'klasmasalah' => $this->input->post('txtKlasifikasi')
			);
			if ( ! $this->db->insert($this->namatabel,$data) )
			{
        		$error = $this->db->error(); // Has keys 'code' and 'message'
			}else
			{
				 $error = array(
				 	'code' 		=> "simpan"  
				 );
			} 
			return  $error['code'];
		}
		function Update($id)
		{
			$data = array(
					 
					'klasmasalah' => $this->input->post('txtKlasifikasi')
			);
			if ( ! $this->db->update($this->namatabel,$data) )
			{
        		$error = $this->db->error(); // Has keys 'code' and 'message'
			}else
			{
				 $error = array(
				 	'code' 		=> "simpan"  
				 );
			} 
			return  $error['code'];
		}
		
		
	}

?>