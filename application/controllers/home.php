<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$this->load->helper('form');
			$data = array (
				'page_title' => "Ops Smile Home", 
				'main_content' => 'home_view',
			);
		
			$this->load->view('template',$data); 

		} else {
			
			redirect('user');
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */