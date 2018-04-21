<?php
	class Dashboard extends CI_Controller
	{
		public function index()
		{	// accpet hanya ketika session terbentuk
			if(isset($this->session->username))
			{
			 	$this->load->model('M_login');
				$data['menu']=array('FID'	=>	'A');
				$data['shortcut']= $this->M_login->GetShortcut();
				$this->load->view('dashboard/v_dashboard',$data);  
			}else
			{
				redirect (base_url()) ;
			} 	
		}

	}




?>