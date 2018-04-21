<?
	class M_laporan extends CI_Model{
	
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
		 
	
		 
	
	}
	

?>
