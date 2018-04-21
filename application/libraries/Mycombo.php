<?
	class MyCombo
	{
		
		protected $CI;
		function __construct() {
			$this->CI = &get_instance(); //Untuk Memanggil function load, dll dari CI. ex: $this->load, $this->model, dll
		}
		 
		public function LoadCombo($tabel,$where="" )
		{
			 
			$qry="SELECT * FROM $tabel WHERE 1=1 ". $where ;
			$query=$this->CI->db->query($qry)->result_array();
			 
			return $query;
			
		}
		public function TglSekarang()
		{
			
			$tgl=  date("d-m-Y") ;
			return $tgl;
		}
		
		public function FormatYMD($tanggal)
		{
			//menjadi format yyyy-mm-dd
			
			if($tanggal=="00-00-0000" or empty($tanggal)  ) 
			{
				$tgl=null;  
			}else
			{
				$datex = $tanggal;
				$date = explode("-",$datex);
				$date = array($date[2], $date[1], $date[0]);
				//$tgl = implode("-", $date);
				if($date[2]<>""){ $tgl = implode("-", $date); }else{ $tgl=""; }
			}
			return $tgl;
		}
	
		public function FormatDMY($tanggal)
		{
		//menjadi format dd-mm-yyyy
		
			if($tanggal=="0000-00-00" or empty($tanggal)  ) 
			{
				$tgl=null;  
			}else
			{
				$datex = $tanggal;
				$date = explode("-",$datex);
				$date = array($date[2], $date[1], $date[0]);
				if($date[2]<>""){ $tgl = implode("-", $date); }else{ $tgl=""; }
			}
				return $tgl;
		}
		
		public function NamaHari($tanggal)
		{
			
			$dayList = array(
				'Sun' => 'Minggu',
				'Mon' => 'Senin',
				'Tue' => 'Selasa',
				'Wed' => 'Rabu',
				'Thu' => 'Kamis',
				'Fri' => 'Jumat',
				'Sat' => 'Sabtu'
			);
			$day = date('D', strtotime($tanggal));
			return $dayList[$day];
		}
	
	}



?>