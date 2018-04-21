<?
	class M_lappemantauan extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_perusahaan"; 
 
    	} 
		public function SelectAllData($where="") 
		{
			$sql = "SELECT * FROM " . $this->namatabel . " a INNER JOIN tb_jalan b on a.jalan_id=b.jalan_id inner join tb_kelurahan c on a.kelurahan_id=c.kelurahan_id inner join tb_kecamatan d on c.kecamatan_id=d.kecamatan_id 
			INNER JOIN tb_jadwal h on a.prs_id=h.prs_id
			INNER JOIN tb_monitoring i on h.jadwal_id=i.jadwal_id
			LEFT JOIN tb_klasifikasi_masalah e on i.klasmasalah_id=e.klasmasalah_id
			LEFT JOIN tb_kategory f on a.kategory_id=f.kategory_id
			INNER JOIN tb_status_aktif g on a.aktif_id=g.aktif_id
			WHERE a.prs_id<>'0' and h.jenismonitoring_id='PM'  " . $where ;  
			$query=$this->db->query($sql);
			 
			return $query->result_array();
		}
		
		function SelectCustomColumn()
		{
			$sql="SELECT concat('a.',COLUMN_NAME) as COLUMN_NAME, COLUMN_COMMENT
  					FROM INFORMATION_SCHEMA.COLUMNS
  					WHERE table_name = 'tb_perusahaan' and COLUMN_NAME not in ( 'klasmasalah_id','kelurahan_id','kategory_id','jalan_id','klasmasalah_id','prs_nama','prs_lokasidet','prs_id') 
				    UNION 
					SELECT	concat('f.',COLUMN_NAME) as COLUMN_NAME, COLUMN_COMMENT
  					FROM INFORMATION_SCHEMA.COLUMNS
  					WHERE table_name = 'tb_kategory' and COLUMN_NAME not in (  'kategory_id' ) 
					UNION 
					SELECT	concat('e.',COLUMN_NAME) as COLUMN_NAME, COLUMN_COMMENT
  					FROM INFORMATION_SCHEMA.COLUMNS
  					WHERE table_name = 'tb_klasifikasi_masalah' and COLUMN_NAME not in (  'klasmasalah_id' ) 
					order by  COLUMN_COMMENT
					";
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		 
		public function export($data,$status_filter="" ) 
		{
			//error_reporting(E_ALL);
		
			include_once './assets/phpexcel/Classes/PHPExcel.php';
			$objPHPExcel = new PHPExcel();

			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0); 
			 
			$styleThinBlackBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
						),	
					 		
					),
					
				);
			$rowCount=3;
			
 			// Set fonts
			//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Candara');
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);	
			$objPHPExcel->getActiveSheet()->SetCellValue('A1' , "LAPORAN PEMANTAUAN");
			 
			if($status_filter<>""){
				$objPHPExcel->getActiveSheet()->SetCellValue('A2' , $status_filter);
				$rowCount++;
			}
			$rowHeader=$rowCount;
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowHeader.':K'.$rowHeader)->getFont()->setBold(true); 
			
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "NO");
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Nama");
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Lokasi");
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Tgl.Turun");
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "No Telp");
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "No IP");
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Investasi USD");
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "Bidang Usaha");
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, "Catatan");
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, "Klas.Masalah");
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, "Kategori");
			// set auto column width
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
			// set border olutline the header
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('H'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('I'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('J'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('K'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$i=0;
			$rowCount++;
			// fill data
			foreach($data as $value)
			{
				$i++;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $i); 
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value['prs_nama']); 
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$rowCount, $value['namajalan'].", ".$value['prs_lokasidet'].", ".$value['kelurahan'].",".$value['kecamatan']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $this->mycombo->FormatYMD($value['jadwal_tgl'])); 
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value['prs_telpkantor'], PHPExcel_Cell_DataType::TYPE_STRING ); 
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value['prs_noIPPMA']); 
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value['prs_nilaiInvestasiUSD']); 
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $value['prs_bidangusaha']); 
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $value['catatanlapangan']); 
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value['klasmasalah']); 
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $value['kategory']);
				$rowCount++; 
			} 
	
			// Set thin black border outline around column
			$borderindex = sprintf('A'.$rowHeader.':K%d',$rowCount-1  );
			$objPHPExcel->getActiveSheet()->getStyle($borderindex)->applyFromArray($styleThinBlackBorderOutline);
			// set page orientation landscape
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);	
	
	 
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
			$objWriter->save('./lapexcell/Lap-pemantauan.xlsx'); 
	
			$this->load->helper('download');
			force_download('./lapexcell/Lap-pemantauan.xlsx', NULL);
		}
		
//*** custom export 
 		public function export_custom($where="", $status_filter="") 
		{
			//error_reporting(E_ALL);
		    
			// cari query
			$sql="SELECT a.prs_id , a.prs_nama , b.namajalan , a.prs_lokasidet, c.kelurahan, d.kecamatan, ";
			$jumlah=0;
			if(!empty($_POST['ceklist'])) 
			{
    			$i=0;
				foreach($_POST['ceklist'] as $check) 
				{
            		// echo $check ."<BR>"; 
					$i++;
					//nama field tabel/ket kolom
					$field=explode("/",$check);
					$sql.=  $field[0]  . ", " ; 
					$namakolom[$i]=$field[1];
					$bantu=explode(".",$field[0]);
					$namafield[$i]=$bantu[1];
    			}
				$jumlah=count($_POST['ceklist']); 
			}
			$sql=substr($sql,0,strlen($sql)-2);		// bersihkan koma
			$sql.=" FROM tb_perusahaan a inner join tb_jalan b on a.jalan_id=b.jalan_id ";
			$sql.=" INNER join tb_kelurahan c on a.kelurahan_id=c.kelurahan_id ";
			$sql.=" INNER join tb_kecamatan d on c.kecamatan_id=d.kecamatan_id 
					LEFT JOIN tb_klasifikasi_masalah e on a.klasmasalah_id=e.klasmasalah_id
					LEFT JOIN tb_kategory f on a.kategory_id=f.kategory_id
					INNER JOIN tb_status_aktif g on a.aktif_id=g.aktif_id " ;
 
			$sql.=" WHERE a.prs_id<>'' " .$where;
			
			$query=$this->db->query($sql);
			$hasil=$query->result_array();

			include_once './assets/phpexcel/Classes/PHPExcel.php';
			$objPHPExcel = new PHPExcel();

			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0); 
			 
			$styleThinBlackBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
						),	
					 		
					),
					
				);
			$rowCount=3;
			   
			$CELL_KOLOM_NAME=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ' );
 	 
		 
			// Set fonts
			//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Candara');
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);	
			$objPHPExcel->getActiveSheet()->SetCellValue('A1' , "DAFTAR PERUSAHAAN");
			if($status_filter<>""){
				$objPHPExcel->getActiveSheet()->SetCellValue('A2' , $status_filter);
				$rowCount++;
			}
			$rowHeader=$rowCount;
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowHeader.':CZ'.$rowHeader)->getFont()->setBold(true); 
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "NO");
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Nama Perusahaan");
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Lokasi Perusahaan");
			$cellbantu=2;
			for($a=1;$a<=$jumlah;$a++)
			{
				$cellbantu++;
				//buat nama kolom
				$objPHPExcel->getActiveSheet()->SetCellValue($CELL_KOLOM_NAME[$cellbantu].$rowCount, $namakolom[$a]);
				// set auto column width
				$objPHPExcel->getActiveSheet()->getColumnDimension($CELL_KOLOM_NAME[$cellbantu])->setAutoSize(true);
				// set border olutline the header
				$objPHPExcel->getActiveSheet()->getStyle($CELL_KOLOM_NAME[$cellbantu].$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
		 	}
			// set auto column width
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			 
			// set border olutline the header
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$rowHeader )->applyFromArray($styleThinBlackBorderOutline);
			 
		
			$rowCount++;
			// fill data
			$i=0;
			
			foreach($hasil as $value)
			{
				$i++;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $i); 
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value['prs_nama']); 
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value['namajalan'].", ".$value['prs_lokasidet'].", ".$value['kelurahan'].",".$value['kecamatan']);			
				$cellbantu=2;
				for($a=1;$a<=$jumlah;$a++)
				{
					$cellbantu++;
					 
					$objPHPExcel->getActiveSheet()->SetCellValue($CELL_KOLOM_NAME[$cellbantu].$rowCount, $value[$namafield[$a]]); 
					 
				}
				 
				$rowCount++; 
			} 
	
			// Set thin black border outline around column
			$borderindex = sprintf('A'.$rowHeader.':'.$CELL_KOLOM_NAME[$cellbantu].'%d',$rowCount-1  );
			$objPHPExcel->getActiveSheet()->getStyle($borderindex)->applyFromArray($styleThinBlackBorderOutline);
			// set page orientation landscape
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);	
	
	 
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
			$objWriter->save('./lapexcell/Data Perusahaan.xlsx'); 
	
			$this->load->helper('download');
			
			force_download('./lapexcell/Data Perusahaan.xlsx', NULL);
			redirect (base_url()."laporan") ;
		}
 
	}


?>