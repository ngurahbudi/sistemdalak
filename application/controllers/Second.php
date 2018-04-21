<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Second extends CI_Controller{
		
		function index(){
			$data["judul"]="Data parsing";
			 $this->load->view('tampil/tampil',$data);
			 
		}
	
	
	}
 
?>