<?
	class m_login extends CI_Model{
		
		public function GetUserLogin()
		{
			$nuser=$this->input->post('txtusername');
			$npass=md5($this->input->post('txtpassword'));
			$sql="select * from tb_user a inner join tb_groupuser b on a.groupuser_id=b.groupuser_id";
			$sql.=" where userid='$nuser' and password='$npass' ";
		 
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		
		public function GetShortcut()
		{
			$sql="select count(prs_id) as jumlah from tb_perusahaan  ";
			$query=$this->db->query($sql)->row_array();
			(is_null($query['jumlah']) ?  $jml_perusahaan=0 : $jml_perusahaan=$query['jumlah']  );
			 
			$sql="SELECT
					b.jenismonitoring_id,
					Count(a.monit_id) AS jumlah
					FROM
					tb_monitoring AS a
					Inner Join tb_jadwal AS b ON b.jadwal_id = a.jadwal_id
					WHERE
					b.iscancel =  '0'
					GROUP BY
					b.jenismonitoring_id";
		
			$query=$this->db->query($sql);
			$result= $query->result_array();
			$jml_pemantauan=0;$jml_pembinaan=0;$jml_pengawasan=0;
			foreach($result as $row)
			{
				switch ($row['jenismonitoring_id'])
				{
					case	"PM"	:	$jml_pemantauan=$row['jumlah']; break;
					case	"PB"	:	$jml_pembinaan=$row['jumlah'];  break;
					case	"PS"	:	$jml_pengawasan=$row['jumlah']; break;
					default			:	$jml_pemantauan=0;$jml_pembinaan=0;$jml_pengawasan=0;break;
				
				}
				 
			}
			$data= array('prs'	=>	$jml_perusahaan,
						 'PM'	=>	$jml_pemantauan,
						 'PB'	=>	$jml_pembinaan,
						 'PS'	=>	$jml_pengawasan  
			);
			return $data;
			
			 
		}
		
	}

?>