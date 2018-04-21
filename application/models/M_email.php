<?
	class M_email extends CI_model
	{
		public $namatabel;
		
		public function __construct()
		{
        	parent::__construct(); // needed when adding a constructor to a controller
        	$this->namatabel = "tb_sent_email"; 
 
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
			$sql.=" where sent_id ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		function SelectAllTemplate() 
		{
			$sql = "SELECT * FROM tb_template_email "  ; 
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function SelectTemplateByID($id)
		{
			$sql="select * from tb_template_email " ;
			$sql.=" where template_id ='". $id  ."' ";
			$query=$this->db->query($sql);
			return $query->row_array();
		}
		function SelectKategory() 
		{
			$sql = "SELECT * FROM tb_kategory "  ; 
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		function Simpan() 
		{
        	 
			$data = array(
					'sent_id' 	=> $this->input->post('txtID'),
					'email' 	=> $this->input->post('txtpesan')
			);
        	$this->db->insert($this->namatabel,$data);
			return $this->db->affected_rows();
   	 	}
    	function SimpanTemplate() 
		{
        	 
			$data = array(
					'template_nama' 	=> $this->input->post('txtnama'),
					'template_content' 	=> $this->input->post('txtpesan')
			);
        	$this->db->insert("tb_template_email",$data);
			return $this->db->affected_rows();
   	 	}
		function UpdateTemplate() 
		{
        	$data = array(
					'template_nama' => $this->input->post('txtnama'),
					'template_content' => $this->input->post('txtpesan') 
			);
        	
        	$this->db->where('template_id',$this->input->post('txtid'));
        	if($this->db->update("tb_template_email",$data))
			{
				return 1;
			}else
			{
				return 0;
			}
	
    	}
		function DeleteTemplate($id)
		{
			$this->db->where('template_id',$id);
            $this->db->delete("tb_template_email");
			return $this->db->affected_rows();
		
		}
    	function Update() 
		{
        	$data = array(
					'email' => $this->input->post('txtpesan')
			);
        	
        	$this->db->where('sent_id',$this->input->post('txtID'));
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
			$this->db->where('sent_id',$id);
            $this->db->delete($this->namatabel);
			return $this->db->affected_rows();
		
		}
		 
 		function SendMail() 
		{
			//$ci = get_instance();
			/* $config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'your_host',
    'smtp_port' => your_port,
    'smtp_user' => 'your_email',
    'smtp_pass' => 'your_password',
    'smtp_crypto' => 'security', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
); */		
		/* 	$config['smtp_crypto'] = "";
			$config['protocol'] = "smtp";
			$config['smtp_host'] = "ssl://smtp.gmail.com";
			$config['smtp_port'] = "465";
			$config['smtp_user'] = EMAIL;
			$config['smtp_pass'] = PASSEMAIL;
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n"; */
			
			$config = array(
				'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => '465',
				'smtp_user' => EMAIL,
				'smtp_pass' => PASSEMAIL,
				//'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
				'mailtype' => 'html', //plaintext 'text' mails or 'html'
				'smtp_timeout' => '4', //in seconds
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);
			
			$this->load->library('email');
			
			 //$this->email->initialize($config);
	 
			$this->email->from($config['smtp_user'], 'Admin bidang DALAK Dinas Penanaman Modal dan PTSP Kota Denpasar');
			$list = array('prasadhajaya@gmail.com');
			$this->email->to($list);
			$this->email->subject('Contoh Email');
			$this->email->message('Harap Anda Melakukan pelaporan LKPM secara Online dengan alamat http://www.lkpmonline.com');
			if ($this->email->send()) {
				return 1; die("OK");
			} else {
				show_error($this->email->print_debugger());
				die('ga mau');
				return 0;
			}
		}
		
	}


?>