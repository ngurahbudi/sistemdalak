<?php
	class Login extends CI_Controller{
		
		public function index(){
			 	$this->load->view('login/index');  	
		}
		//*** Login 
		public function ceklogin(){
			
			$pass=md5($this->input->post('txtpassword'));  
			$user=$this->input->post('txtusername'); 
			$this->load->model('m_login');
			$data = $this->m_login->GetUserLogin(); 
			if(count($data)>0)
			{
					// user has been logged in
					$data= array(
						'username' 		=> $user,
						'groupuser'		=> $data['groupuser'],
						'groupid'		=> $data['groupuser_id']
 
					);
					$this->session->set_userdata($data); 
					redirect(base_url().'dashboard/');
			}
			else
			{
				$this->session->set_flashdata('message', 'Username atau Password tidak ditemukan.');
				redirect(base_url().'login');
			}
		} 
		//*** logout
		public function LogOut()
		{
			$data= array(
						'username',
						'groupuser',
						'groupid'		 
					);
			$this->session->unset_userdata($data);
			redirect(base_url().'login'); 
		}
		
	}
 
?>