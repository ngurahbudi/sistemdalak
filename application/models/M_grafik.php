<?
	class M_grafik extends CI_model
	{
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_perusahaan"; 
 
    	} 
		
		function getDataGrafik()
		{
			 
			$sql = "SELECT a.klasmasalah , case when isnull (kelas.jumlah )  then 0 else kelas.jumlah end as jumlah
					FROM   tb_klasifikasi_masalah a 
					left join
					(
					select klasmasalah_id,count(prs_id) as jumlah
					from tb_perusahaan group by klasmasalah_id		
					) as kelas on a.klasmasalah_id=kelas.klasmasalah_id"     ; 
			$query=$this->db->query($sql);
			$hasil=$query->result_array();
			
			foreach($hasil as $row)
			{
				$label[]= $row['klasmasalah'];
				$value[]=$row['jumlah'];  
			}
 			$abjad=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n');
			$chart_data = ''; 
			// add data to grafik
			$ykey="";
			$ylabel=""; 
			$chart_data .= "{ y: 'Data Perusahaan', ";
			for($i=0;$i< count($value);$i++)
			{
				$ykey .= "'".$abjad[$i]."',";
				$chart_data .= $abjad[$i] .":" . $value[$i] ."," ;
				$ylabel .="'".$label[$i]."',";
				
			}
			$ykey = substr($ykey, 0, -1);
			$chart_data = substr($chart_data, 0, -1);
			$ylabel = substr($ylabel, 0, -1);
			$chart_data .= "} "; 
 
			// echo $ylabel; die();
			 return $ykey ."/". $chart_data ."/" . $ylabel;
		}
		
		
		
	}
?>